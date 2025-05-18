import numpy as np
import pandas as pd
import tensorflow as tf
from sklearn.preprocessing import MinMaxScaler
from sklearn.cluster import KMeans
from tensorflow.keras.layers import Dense, LeakyReLU, Dropout
from tensorflow.keras.optimizers import Adam
from tensorflow.keras.callbacks import EarlyStopping
import kerastuner as kt
import requests
from datetime import timedelta

# 1. Ambil data dari API
url = "http://localhost:8000/api/ann/show"
resp = requests.get(url)
data = resp.json()['data']

# 2. Konversi ke DataFrame & urutkan
df = pd.DataFrame(data)
df['created_at'] = pd.to_datetime(df['created_at'])
df = df.sort_values('created_at').reset_index(drop=True)

# 3. Buat kolom total_debit
df['total_debit'] = df['debit_organik'] + df['debit_anorganik']

# 4. Ambil data terbaru (data terakhir)
latest_data = df.iloc[-1]
latest_date = latest_data['created_at']

# **Cetak data terbaru yang diambil**
print("Data Terbaru:")
print(f"ID: {latest_data['id']}")
print(f"Debit Organik: {latest_data['debit_organik']}")
print(f"Debit Anorganik: {latest_data['debit_anorganik']}")
print(f"Tanggal: {latest_data['created_at']}")

# 5. Outlier removal (IQR)
Q1 = df['total_debit'].quantile(0.25)
Q3 = df['total_debit'].quantile(0.75)
IQR = Q3 - Q1
lower, upper = Q1 - 1.5*IQR, Q3 + 1.5*IQR
df = df[(df['total_debit'] >= lower) & (df['total_debit'] <= upper)].reset_index(drop=True)

# 6. Buat fitur tanggal & lag
df['day_of_year']  = df['created_at'].dt.dayofyear
df['week_of_year'] = df['created_at'].dt.isocalendar().week
df['month']        = df['created_at'].dt.month
df['weekday']      = df['created_at'].dt.weekday
df['lag_1']  = df['total_debit'].shift(1)
df['lag_2']  = df['total_debit'].shift(2)
df['lag_3']  = df['total_debit'].shift(3)
df['roll_7'] = df['total_debit'].rolling(7).mean()
df = df.dropna().reset_index(drop=True)

# 7. Definisikan X, y
feature_cols = ['debit_organik','debit_anorganik','day_of_year','week_of_year','month','weekday','lag_1','lag_2','lag_3','roll_7']
X = df[feature_cols].values
y = df['total_debit'].values.reshape(-1,1)

# 8. Normalisasi
scaler_X = MinMaxScaler()
scaler_y = MinMaxScaler()
X_scaled = scaler_X.fit_transform(X)
y_scaled = scaler_y.fit_transform(y)

# 9. Split data
split = int(len(X_scaled) * 0.8)
X_train, X_val = X_scaled[:split], X_scaled[split:]
y_train, y_val = y_scaled[:split], y_scaled[split:]

# 10. Bangun model dengan Keras Tuner
def build_model(hp):
    model = tf.keras.Sequential()
    for i in range(hp.Int('n_layers', 2, 4)):
        units = hp.Int(f'units_{i}', 32, 256, step=32)
        model.add(Dense(units))
        model.add(LeakyReLU(0.1))
        model.add(Dropout(hp.Float(f'drop_{i}', 0.0, 0.5, step=0.1)))
    model.add(Dense(1))
    model.compile(
        optimizer=Adam(hp.Choice('lr', [1e-2, 1e-3, 1e-4])),
        loss='mean_squared_error',
        metrics=['mae']
    )
    return model

# 11. Tentukan tuner
tuner = kt.RandomSearch(
    build_model,
    objective='val_mae',
    max_trials=20,
    executions_per_trial=1,
    directory='tuner',
    project_name='debit_ann'
)

# 12. Pencarian hyperparameter terbaik
tuner.search(
    X_train, y_train,
    validation_data=(X_val, y_val),
    epochs=200,
    batch_size=16,
    callbacks=[EarlyStopping(monitor='val_loss', patience=20, restore_best_weights=True)]
)

# 13. Dapatkan model terbaik
best_model = tuner.get_best_models(1)[0]
best_model.summary()

# 14. Evaluasi model terbaik
loss, mae = best_model.evaluate(X_val, y_val)
print(f"Best model on validation data: Loss = {loss:.4f}, MAE = {mae:.4f}")

# 15. Prediksi dan transformasi kembali
pred = best_model.predict(X_val)
y_val_orig = scaler_y.inverse_transform(y_val)
pred_orig = scaler_y.inverse_transform(pred)

mae_orig = np.mean(np.abs(pred_orig - y_val_orig))
mse_orig = np.mean((pred_orig - y_val_orig)**2)

print(f"Prediksi pertama (asli): {pred_orig[0][0]:.6f}")
print(f"Nilai aktual   (asli): {y_val_orig[0][0]:.6f}")
print(f"Validation (asli) → MAE: {mae_orig:.6f}, MSE: {mse_orig:.6f}")

# 16. Klasifikasi menggunakan K-Means Clustering untuk klasifikasi otomatis kondisi sampah
kmeans = KMeans(n_clusters=3, random_state=42)
df['cluster'] = kmeans.fit_predict(df[['total_debit']])

# Menyusun label untuk kategori berdasarkan rata-rata nilai total_debit
cluster_means = df.groupby('cluster')['total_debit'].mean().sort_values()
cluster_map = {cluster_means.index[0]: 'Jauh', cluster_means.index[1]: 'Sedang', cluster_means.index[2]: 'Hampir Penuh'}
df['condition'] = df['cluster'].map(cluster_map)

# 17. Prediksi berikutnya dan estimasi waktu untuk mencapai 80% ambang batas
latest_features = {
    'debit_organik': latest_data['debit_organik'],
    'debit_anorganik': latest_data['debit_anorganik'],
    'day_of_year': latest_data['created_at'].dayofyear,
    'week_of_year': latest_data['created_at'].isocalendar().week,
    'month': latest_data['created_at'].month,
    'weekday': latest_data['created_at'].weekday(),
    'lag_1': df.iloc[-1]['total_debit'],
    'lag_2': df.iloc[-2]['total_debit'],
    'lag_3': df.iloc[-3]['total_debit'],
    'roll_7': df['total_debit'].tail(7).mean()
}

latest_df = pd.DataFrame([latest_features])
latest_scaled = scaler_X.transform(latest_df)

# Prediksi
future_scaled_pred = best_model.predict(latest_scaled)
future_pred = scaler_y.inverse_transform(future_scaled_pred)[0][0]

# Hitung kenaikan harian debit yang positif
df['daily_change'] = df['total_debit'].diff().shift(-1)
df['daily_change'] = df['daily_change'][df['daily_change'] > 0]

if df['daily_change'].isnull().all():
    df['daily_change'] = abs(df['total_debit'].diff().shift(-1))

avg_daily_change = df['daily_change'].mean()
if avg_daily_change <= 0:
    avg_daily_change = abs(avg_daily_change)

# Estimasi waktu untuk mencapai target debit 80%
current_debit = future_pred
target_debit = 80

days_to_target = (target_debit - current_debit) / avg_daily_change
days_to_target = max(0, days_to_target)

# Pembulatan waktu (ke angka bulat terdekat)
rounded_days = round(days_to_target)

# Tentukan tanggal prediksi pengambilan berdasarkan pembulatan
pred_pickup_date = latest_date + timedelta(days=rounded_days)

# Convert pred_pickup_date to the required format (YYYY-MM-DD HH:MM:SS)
formatted_pred_pickup_date = pred_pickup_date.strftime('%Y-%m-%d %H:%M:%S')

# 18. Send the predicted pickup date via POST API
url = "http://localhost:8000/api/ann"
payload = {
    "waktu_pengambilan": formatted_pred_pickup_date
}

# Send the POST request
response = requests.post(url, json=payload)

# Print the response from the API
if response.status_code == 201:
    print("Data successfully posted!")
    print(response.json())  # If needed, print the response body
else:
    print(f"Failed to post data: {response.status_code}")
    print(response.text)  # Print the error message if available
