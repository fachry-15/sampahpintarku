import numpy as np
import pandas as pd
import tensorflow as tf
from sklearn.preprocessing import MinMaxScaler
from sklearn.cluster import KMeans
from tensorflow.keras.layers import Dense, LeakyReLU, Dropout
from tensorflow.keras.optimizers import Adam
from tensorflow.keras.callbacks import EarlyStopping
import keras_tuner as kt
import requests
from datetime import timedelta
import matplotlib.pyplot as plt
import seaborn as sns

# 1. Ambil data dari API
url = "http://localhost:8000/api/ann/show"
try:
    resp = requests.get(url)
    resp.raise_for_status() # Akan memunculkan HTTPError untuk status kode 4xx/5xx
    data = resp.json()['data']
    if not data:
        print("API mengembalikan data kosong. Tidak dapat melanjutkan.")
        exit()
except requests.exceptions.ConnectionError:
    print(f"Error: Tidak dapat terhubung ke API di {url}. Pastikan API berjalan.")
    exit()
except requests.exceptions.HTTPError as e:
    print(f"Error HTTP: {e}. Status code: {e.response.status_code}")
    print(f"Response body: {e.response.text}")
    exit()
except Exception as e:
    print(f"Terjadi kesalahan saat mengambil data dari API: {e}")
    exit()


# 2. Konversi ke DataFrame & urutkan
df = pd.DataFrame(data)
df['created_at'] = pd.to_datetime(df['created_at'])
df = df.sort_values('created_at').reset_index(drop=True)

# 3. Buat kolom total_debit
df['total_debit'] = df['debit_organik'] + df['debit_anorganik']

# 4. Ambil data terbaru (data terakhir)
if df.empty:
    print("DataFrame kosong setelah pemrosesan awal. Tidak dapat melanjutkan.")
    exit()
latest_data = df.iloc[-1]
latest_date = latest_data['created_at']

# **Cetak data terbaru yang diambil**
print("\n--- Tahap 1: Pengambilan dan Pra-pemrosesan Data ---")
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
initial_rows = len(df)
df = df[(df['total_debit'] >= lower) & (df['total_debit'] <= upper)].reset_index(drop=True)

print(f"\n--- Tahap 2: Outlier Removal (Metode IQR) ---")
print(f"Q1 (25%): {Q1:.2f}")
print(f"Q3 (75%): {Q3:.2f}")
print(f"IQR (Q3 - Q1): {IQR:.2f}")
print(f"Batas Bawah (Q1 - 1.5*IQR): {lower:.2f}")
print(f"Batas Atas (Q3 + 1.5*IQR): {upper:.2f}")
print(f"Jumlah baris sebelum outlier removal: {initial_rows}")
print(f"Jumlah baris setelah outlier removal: {len(df)}")


# Memeriksa apakah DataFrame kosong setelah outlier removal
if df.empty:
    print("DataFrame kosong setelah penghapusan outlier. Tidak dapat melanjutkan.")
    exit()

# 6. Buat fitur tanggal & lag
df['day_of_year'] = df['created_at'].dt.dayofyear
df['week_of_year'] = df['created_at'].dt.isocalendar().week.astype(int) # Konversi ke int
df['month'] = df['created_at'].dt.month
df['weekday'] = df['created_at'].dt.weekday
df['lag_1'] = df['total_debit'].shift(1)
df['lag_2'] = df['total_debit'].shift(2)
df['lag_3'] = df['total_debit'].shift(3)
df['roll_7'] = df['total_debit'].rolling(7).mean()
initial_rows_after_features = len(df)
df = df.dropna().reset_index(drop=True)

print(f"\n--- Tahap 3: Pembuatan Fitur Tambahan ---")
print(f"Fitur berbasis waktu: day_of_year, week_of_year, month, weekday ditambahkan.")
print(f"Fitur lag (lag_1, lag_2, lag_3) dan rolling mean (roll_7) ditambahkan.")
print(f"Jumlah baris sebelum dropna (karena lag/roll): {initial_rows_after_features}")
print(f"Jumlah baris setelah dropna: {len(df)}")

# Memeriksa apakah DataFrame kosong setelah membuat fitur lag
if df.empty:
    print("DataFrame kosong setelah membuat fitur lag. Tidak dapat melanjutkan.")
    exit()
if len(df) < 3: # Minimal 3 baris untuk lag_3
    print("Data tidak cukup untuk membuat fitur lag. Pastikan ada setidaknya 3 entri data.")
    exit()


# 7. Definisikan X, y
feature_cols = ['debit_organik','debit_anorganik','day_of_year','week_of_year','month','weekday','lag_1','lag_2','lag_3','roll_7']
X = df[feature_cols].values
y = df['total_debit'].values.reshape(-1,1)

# 8. Normalisasi
scaler_X = MinMaxScaler()
scaler_y = MinMaxScaler()

# ====================================================================
# MENAMPILKAN RUMUS NORMALISASI UNTUK FITUR (X)
# ====================================================================
X_min_vals = X.min(axis=0)
X_max_vals = X.max(axis=0)
X_scaled = scaler_X.fit_transform(X)

print(f"\n--- Tahap 4: Normalisasi Data (MinMaxScaler) ---")
print(f"Fitur X dinormalisasi.")
print("Rumus Normalisasi: X_scaled = (X - X_min) / (X_max - X_min)")
print("\nContoh Perhitungan Normalisasi untuk baris pertama data X:")
for i, col in enumerate(feature_cols):
    original_val = X[0, i]
    min_val = X_min_vals[i]
    max_val = X_max_vals[i]
    if (max_val - min_val) != 0: # Hindari pembagian dengan nol jika min == max
        scaled_val = (original_val - min_val) / (max_val - min_val)
    else:
        scaled_val = 0.0 # Atau 1.0, tergantung definisi jika min == max
    
    print(f"  Fitur '{col}':")
    print(f"    Nilai Asli (X): {original_val:.4f}")
    print(f"    X_min: {min_val:.4f}")
    print(f"    X_max: {max_val:.4f}")
    print(f"    Perhitungan: ({original_val:.4f} - {min_val:.4f}) / ({max_val:.4f} - {min_val:.4f}) = {scaled_val:.4f}")
    print(f"    Nilai Skala: {X_scaled[0, i]:.4f}")

# ====================================================================
# MENAMPILKAN RUMUS NORMALISASI UNTUK TARGET (y)
# ====================================================================
y_min_val = y.min(axis=0)[0]
y_max_val = y.max(axis=0)[0]
y_scaled = scaler_y.fit_transform(y)

print(f"\nContoh Perhitungan Normalisasi untuk baris pertama data y (total_debit):")
original_y_val = y[0, 0]
if (y_max_val - y_min_val) != 0:
    scaled_y_val = (original_y_val - y_min_val) / (y_max_val - y_min_val)
else:
    scaled_y_val = 0.0
print(f"  Nilai Asli (y): {original_y_val:.4f}")
print(f"  y_min: {y_min_val:.4f}")
print(f"  y_max: {y_max_val:.4f}")
print(f"  Perhitungan: ({original_y_val:.4f} - {y_min_val:.4f}) / ({y_max_val:.4f} - {y_min_val:.4f}) = {scaled_y_val:.4f}")
print(f"  Nilai Skala: {y_scaled[0, 0]:.4f}")


if X_scaled.size > 0:
    print(f"\nContoh nilai X_scaled (baris pertama, semua fitur): {X_scaled[0]}")
if y_scaled.size > 0:
    print(f"Contoh nilai y_scaled (baris pertama): {y_scaled[0]}")


# 9. Split data
split = int(len(X_scaled) * 0.8)
if split == 0 or split == len(X_scaled):
    print("Data tidak cukup untuk pembagian train/validation yang valid. Diperlukan lebih banyak data.")
    exit()
X_train, X_val = X_scaled[:split], X_scaled[split:]
y_train, y_val = y_scaled[:split], y_scaled[split:]

print(f"\n--- Tahap 5: Pembagian Data (Train/Validation Split) ---")
print(f"Total sampel data: {len(X_scaled)}")
print(f"Jumlah sampel training (80%): {len(X_train)}")
print(f"Jumlah sampel validation (20%): {len(X_val)}")


# 10. Bangun model dengan Keras Tuner
def build_model(hp):
    model = tf.keras.Sequential()
    
    # Keras Tuner akan menentukan jumlah dan ukuran hidden layer
    n_layers = hp.Int('n_layers', 2, 4)
    print(f"\n  -> Membangun Model dengan {n_layers} Lapisan Tersembunyi:")
    
    for i in range(n_layers):
        units = hp.Int(f'units_{i}', 32, 256, step=32)
        model.add(Dense(units))
        model.add(LeakyReLU(0.1))
        drop_rate = hp.Float(f'drop_{i}', 0.0, 0.5, step=0.1)
        model.add(Dropout(drop_rate))
        print(f"    Lapisan Tersembunyi {i+1}: {units} neuron, LeakyReLU, Dropout {drop_rate}")
        
    model.add(Dense(1)) # Output Layer
    print("    Lapisan Output: 1 neuron (linear activation for regression)")

    optimizer_lr = hp.Choice('lr', [1e-2, 1e-3, 1e-4])
    model.compile(
        optimizer=Adam(optimizer_lr),
        loss='mean_squared_error',
        metrics=['mae']
    )
    print(f"  -> Model dikompilasi dengan Learning Rate Adam: {optimizer_lr}")
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
print("\n--- Tahap 6: Pelatihan Model ANN (dengan Keras Tuner) ---")
print("Mulai pencarian hyperparameter terbaik...")
# Verbose diatur ke 0 untuk pencarian tuner agar tidak terlalu banyak output
tuner.search(
    X_train, y_train,
    validation_data=(X_val, y_val),
    epochs=200,
    batch_size=16,
    callbacks=[EarlyStopping(monitor='val_loss', patience=20, restore_best_weights=True)],
    verbose=0 
)
print("Pencarian hyperparameter selesai.")

# 13. Dapatkan model terbaik
best_model = tuner.get_best_models(1)[0]
print("\nRingkasan Model Terbaik (Output dari Keras Tuner):")
best_model.summary()

# 14. Evaluasi model terbaik
loss, mae = best_model.evaluate(X_val, y_val, verbose=0)
print(f"\n--- Tahap 7: Evaluasi Model ANN ---")
print(f"Model terbaik pada data validasi (Scaled): Loss (MSE) = {loss:.4f}, MAE = {mae:.4f}")

# 15. Prediksi dan transformasi kembali
pred = best_model.predict(X_val, verbose=0)

# ====================================================================
# MENAMPILKAN RUMUS INVERSE NORMALISASI
# ====================================================================
y_val_orig = scaler_y.inverse_transform(y_val)
pred_orig = scaler_y.inverse_transform(pred)

print(f"\n--- Tahap 8: Prediksi dan Inverse Normalisasi ---")
print(f"Rumus Inverse Normalisasi: Y_original = Y_scaled * (Y_max - Y_min) + Y_min")
print(f"Nilai y_min_global (dari scaler_y): {scaler_y.data_min_[0]:.4f}")
print(f"Nilai y_max_global (dari scaler_y): {scaler_y.data_max_[0]:.4f}")
print(f"Rentang (Y_max - Y_min): {scaler_y.data_range_[0]:.4f}")

print("\nContoh Perhitungan Inverse Normalisasi untuk nilai pertama:")
scaled_pred_val_0 = pred[0][0]
original_pred_val_0 = scaled_pred_val_0 * scaler_y.data_range_[0] + scaler_y.data_min_[0]
print(f"  Prediksi Scaled (Y_scaled): {scaled_pred_val_0:.6f}")
print(f"  Perhitungan: {scaled_pred_val_0:.6f} * {scaler_y.data_range_[0]:.4f} + {scaler_y.data_min_[0]:.4f} = {original_pred_val_0:.6f}")
print(f"  Prediksi Original (Y_original): {pred_orig[0][0]:.6f}")
print(f"  Nilai Aktual Original (Y_actual): {y_val_orig[0][0]:.6f}")

mae_orig = np.mean(np.abs(pred_orig - y_val_orig))
mse_orig = np.mean((pred_orig - y_val_orig)**2)

print(f"\nValidasi (Original Scale) → MAE: {mae_orig:.6f}, MSE: {mse_orig:.6f}")
print(f"Rumus MAE: (1/N) * SUM(|Actual - Predicted|)")
print(f"Rumus MSE: (1/N) * SUM((Actual - Predicted)^2)")


# 16. Klasifikasi menggunakan K-Means Clustering untuk klasifikasi otomatis kondisi sampah
kmeans = KMeans(n_clusters=3, random_state=42, n_init='auto') # n_init='auto' disarankan untuk menghindari warning
df['cluster'] = kmeans.fit_predict(df[['total_debit']])

# Menyusun label untuk kategori berdasarkan rata-rata nilai total_debit
cluster_means = df.groupby('cluster')['total_debit'].mean().sort_values()
cluster_map = {cluster_means.index[0]: 'Jauh', cluster_means.index[1]: 'Sedang', cluster_means.index[2]: 'Hampir Penuh'}
df['condition'] = df['cluster'].map(cluster_map)

print(f"\n--- Tahap 9: Klasifikasi Kondisi Sampah (K-Means Clustering) ---")
print(f"K-Means dengan 3 klaster diterapkan pada 'total_debit'.")
print(f"Rata-rata debit per klaster: {cluster_means.to_dict()}")
print(f"Label kondisi: {cluster_map}")
if not df.empty:
    print(f"Contoh kondisi pada baris pertama: {df.iloc[0]['condition']}")


# 17. Prediksi berikutnya dan estimasi waktu untuk mencapai 80% ambang batas
# Pastikan df memiliki cukup data untuk fitur lag terbaru
if len(df) < 3:
    print("Tidak cukup data di DataFrame untuk menghitung fitur lag terbaru. Membutuhkan minimal 3 baris.")
    exit()

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

# ====================================================================
# MENAMPILKAN RUMUS NORMALISASI UNTUK FITUR TERBARU
# ====================================================================
latest_scaled = scaler_X.transform(latest_df)

print(f"\n--- Tahap 10: Prediksi Debit Mendatang & Estimasi Waktu Pengambilan ---")
print(f"Fitur terbaru untuk prediksi: {latest_features}")
print("\nContoh Perhitungan Normalisasi untuk Fitur Terbaru (baris pertama fitur 'debit_organik'):")
# Ambil nilai debit_organik dari latest_features
original_debit_organik_latest = latest_features['debit_organik']
# Dapatkan indeks 'debit_organik' dalam feature_cols
idx_debit_organik = feature_cols.index('debit_organik')
min_val_debit_organik = scaler_X.data_min_[idx_debit_organik]
max_val_debit_organik = scaler_X.data_max_[idx_debit_organik]

if (max_val_debit_organik - min_val_debit_organik) != 0:
    scaled_debit_organik_latest = (original_debit_organik_latest - min_val_debit_organik) / (max_val_debit_organik - min_val_debit_organik)
else:
    scaled_debit_organik_latest = 0.0 # Atau 1.0 jika min == max

print(f"  Nilai Asli debit_organik terbaru: {original_debit_organik_latest:.4f}")
print(f"  X_min (debit_organik): {min_val_debit_organik:.4f}")
print(f"  X_max (debit_organik): {max_val_debit_organik:.4f}")
print(f"  Perhitungan: ({original_debit_organik_latest:.4f} - {min_val_debit_organik:.4f}) / ({max_val_debit_organik:.4f} - {min_val_debit_organik:.4f}) = {scaled_debit_organik_latest:.4f}")
print(f"  Nilai Skala (dari scaler.transform): {latest_scaled[0, idx_debit_organik]:.4f}")


print(f"\nNilai fitur terbaru (setelah normalisasi): {latest_scaled[0]}")

# Prediksi
future_scaled_pred = best_model.predict(latest_scaled, verbose=0)

# ====================================================================
# MENAMPILKAN RUMUS INVERSE NORMALISASI UNTUK PREDIKSI MASA DEPAN
# ====================================================================
future_pred = scaler_y.inverse_transform(future_scaled_pred)[0][0]

print(f"\nPrediksi debit sampah untuk hari berikutnya (scaled): {future_scaled_pred[0][0]:.6f}")
print(f"Rumus Inverse Normalisasi Prediksi: Y_original = Y_scaled * (Y_max - Y_min) + Y_min")
print(f"  Y_scaled (prediksi): {future_scaled_pred[0][0]:.6f}")
print(f"  Y_max (dari scaler_y): {scaler_y.data_max_[0]:.4f}")
print(f"  Y_min (dari scaler_y): {scaler_y.data_min_[0]:.4f}")
print(f"  Perhitungan: {future_scaled_pred[0][0]:.6f} * ({scaler_y.data_max_[0]:.4f} - {scaler_y.data_min_[0]:.4f}) + {scaler_y.data_min_[0]:.4f} = {future_pred:.2f}")
print(f"Prediksi debit sampah untuk hari berikutnya (Original Scale): {future_pred:.2f}")


# Hitung kenaikan harian debit yang positif
df['daily_change'] = df['total_debit'].diff().shift(-1)
# Hanya pertimbangkan perubahan positif (kenaikan debit)
df_positive_change = df['daily_change'][df['daily_change'] > 0]

if df_positive_change.empty:
    # Jika tidak ada perubahan positif, gunakan rata-rata absolut perubahan harian
    avg_daily_change = df['total_debit'].diff().abs().mean()
    print("Tidak ada kenaikan debit positif yang terdeteksi dalam data historis.")
    print(f"Menggunakan rata-rata ABSOLUT perubahan harian: {avg_daily_change:.2f}")
else:
    avg_daily_change = df_positive_change.mean()
    print(f"Rata-rata kenaikan debit harian (hanya perubahan positif): {avg_daily_change:.2f}")


if avg_daily_change <= 0 or pd.isna(avg_daily_change):
    print("Rata-rata perubahan harian tidak valid atau nol (atau NaN). Tidak dapat mengestimasi waktu pengambilan yang akurat.")
    rounded_days = 9999 # Nilai placeholder untuk menunjukkan tidak ada estimasi valid
    pred_pickup_date = latest_date + timedelta(days=rounded_days) # Placeholder date
else:
    # Estimasi waktu untuk mencapai target debit 80% (misal 120 unit sebagai ambang batas 80%)
    current_debit = future_pred
    target_debit = 120 # Asumsi 80% dari kapasitas penuh

    days_to_target = (target_debit - current_debit) / avg_daily_change
    days_to_target = max(0, days_to_target)
    rounded_days = round(days_to_target)
    pred_pickup_date = latest_date + timedelta(days=rounded_days)

    print(f"Debit sampah saat ini (prediksi): {current_debit:.2f}")
    print(f"Target debit (80% penuh): {target_debit:.2f}")
    print(f"Perhitungan Hari ke Target: (Target - Current) / Avg_Change = ({target_debit:.2f} - {current_debit:.2f}) / {avg_daily_change:.2f} = {days_to_target:.2f} hari")
    print(f"Estimasi waktu untuk mencapai {target_debit} unit: sekitar {rounded_days} hari.")
    print(f"Tanggal prediksi pengambilan (Tanggal Terakhir + Hari Estimasi): {latest_date.strftime('%Y-%m-%d')} + {rounded_days} hari = {pred_pickup_date.strftime('%Y-%m-%d')}")

# Convert pred_pickup_date to the required format (YYYY-MM-DD HH:MM:SS)
formatted_pred_pickup_date = pred_pickup_date.strftime('%Y-%m-%d %H:%M:%S')

# 18. Kirim tanggal pengambilan yang diprediksi melalui POST API
print("\n--- Tahap 11: Pengiriman Data Prediksi ke API ---")
url_post = "http://localhost:8000/api/ann"
payload = {
    "waktu_pengambilan": formatted_pred_pickup_date
}
print(f"Mengirimkan payload: {payload}")

try:
    response = requests.post(url_post, json=payload)
    response.raise_for_status() # Akan memunculkan HTTPError untuk status kode 4xx/5xx

    if response.status_code == 201:
        print("Data berhasil dikirim!")
        print(f"Response API: {response.json()}")
    else:
        print(f"Gagal mengirim data: Status {response.status_code}")
        print(f"Response error: {response.text}")
except requests.exceptions.ConnectionError:
    print(f"Error: Tidak dapat terhubung ke API POST di {url_post}. Pastikan API berjalan.")
except requests.exceptions.HTTPError as e:
    print(f"Error HTTP saat mengirim data: {e}. Status code: {e.response.status_code}")
    print(f"Response body: {e.response.text}")
except Exception as e:
    print(f"Terjadi kesalahan tak terduga saat mengirim data: {e}")

# --- Visualisasi ---
print("\n--- Tahap 12: Visualisasi Hasil ---")
# Visualisasi 1: Total Debit dari Waktu ke Waktu
plt.figure(figsize=(12, 6))
sns.lineplot(x='created_at', y='total_debit', data=df)
plt.title('Total Debit dari Waktu ke Waktu')
plt.xlabel('Tanggal')
plt.ylabel('Total Debit')
plt.grid(True)
plt.show()

# Visualisasi 2: Nilai Aktual vs. Prediksi Model ANN
plt.figure(figsize=(12, 6))
plt.plot(y_val_orig, label='Aktual')
plt.plot(pred_orig, label='Prediksi')
plt.title('Nilai Aktual vs. Prediksi Model ANN pada Data Validasi')
plt.xlabel('Indeks Data Validasi')
plt.ylabel('Total Debit')
plt.legend()
plt.grid(True)
plt.show()

# Visualisasi 3: K-Means Cluster Berdasarkan Total Debit
plt.figure(figsize=(10, 7))
sns.scatterplot(x='created_at', y='total_debit', hue='condition', data=df, palette='viridis', s=100)
plt.title('K-Means Cluster Berdasarkan Total Debit (Kondisi Sampah)')
plt.xlabel('Tanggal')
plt.ylabel('Total Debit')
plt.grid(True)
plt.show()

print("\nVisualisasi telah ditambahkan pada alur kerja ANN Anda.")
print("\n--- Proses Selesai ---")