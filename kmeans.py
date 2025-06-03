import pandas as pd
import numpy as np
from sklearn.preprocessing import MinMaxScaler
from sklearn.cluster import KMeans
import requests
import matplotlib.pyplot as plt
import seaborn as sns # Untuk visualisasi yang lebih baik

# ----------------------------------------------------
# 1. Ambil data dari API
# ----------------------------------------------------
print("--- Langkah 1: Pengambilan Data dari API ---")
url = "http://localhost:8000/api/ann/show"
try:
    resp = requests.get(url)
    resp.raise_for_status() # Akan memicu error jika status code bukan 200
    data = resp.json()['data']
    print(f"Data berhasil diambil. Jumlah observasi awal: {len(data)}")
except requests.exceptions.RequestException as e:
    print(f"Error saat mengambil data dari API: {e}")
    print("Membuat data dummy untuk demonstrasi.")
    # Data dummy jika API tidak bisa diakses
    data = []
    for i in range(100):
        debit_o = np.random.randint(0, 100)
        debit_a = np.random.randint(0, 100)
        created_at = pd.to_datetime('2024-01-01') + pd.Timedelta(days=i, minutes=np.random.randint(0,1440))
        data.append({'debit_organik': debit_o, 'debit_anorganik': debit_a, 'created_at': created_at.isoformat()})
    print(f"Data dummy dibuat. Jumlah observasi dummy: {len(data)}")

# ----------------------------------------------------
# 2. Konversi ke DataFrame & urutkan
# ----------------------------------------------------
print("\n--- Langkah 2: Konversi ke DataFrame & Pengurutan ---")
df = pd.DataFrame(data)
df['created_at'] = pd.to_datetime(df['created_at'])
df = df.sort_values('created_at').reset_index(drop=True)
print("DataFrame berhasil dibuat dan diurutkan berdasarkan 'created_at'.")
print("Contoh 5 baris pertama:\n", df.head())

# ----------------------------------------------------
# 3. Buat kolom total_debit
# ----------------------------------------------------
print("\n--- Langkah 3: Pembuatan Kolom 'total_debit' ---")
# Rumus: total_debit_i = debit_organik_i + debit_anorganik_i
df['total_debit'] = df['debit_organik'] + df['debit_anorganik']
print("Kolom 'total_debit' berhasil ditambahkan.")
print("Contoh 5 baris pertama dengan 'total_debit':\n", df[['debit_organik', 'debit_anorganik', 'total_debit']].head())

# ----------------------------------------------------
# 4. Outlier removal (IQR)
# ----------------------------------------------------
print("\n--- Langkah 4: Penghapusan Outlier (IQR) ---")
# Rumus:
# Q1 = Percentile(total_debit, 25)
# Q3 = Percentile(total_debit, 75)
# IQR = Q3 - Q1
# Lower Bound = Q1 - 1.5 * IQR
# Upper Bound = Q3 + 1.5 * IQR
# Filter Data: LB <= total_debit_i <= UB

Q1 = df['total_debit'].quantile(0.25)
Q3 = df['total_debit'].quantile(0.75)
IQR = Q3 - Q1
lower_bound = Q1 - 1.5 * IQR
upper_bound = Q3 + 1.5 * IQR

initial_rows = len(df)
df = df[(df['total_debit'] >= lower_bound) & (df['total_debit'] <= upper_bound)].reset_index(drop=True)
removed_rows = initial_rows - len(df)

print(f"Q1: {Q1:.2f}, Q3: {Q3:.2f}, IQR: {IQR:.2f}")
print(f"Batas Bawah (Lower Bound): {lower_bound:.2f}")
print(f"Batas Atas (Upper Bound): {upper_bound:.2f}")
print(f"{removed_rows} outlier dihapus. Jumlah observasi setelah outlier removal: {len(df)}")
if removed_rows > 0:
    print("Data setelah outlier removal:\n", df['total_debit'].describe())

# ----------------------------------------------------
# 5. Buat fitur tanggal & lag
# ----------------------------------------------------
print("\n--- Langkah 5: Pembuatan Fitur Waktu dan Lag ---")
df['day_of_year'] = df['created_at'].dt.dayofyear
df['week_of_year'] = df['created_at'].dt.isocalendar().week.astype(int) # Pastikan int
df['month'] = df['created_at'].dt.month
df['weekday'] = df['created_at'].dt.weekday

# Rumus Lag: lag_n_i = total_debit_{i-n}
df['lag_1'] = df['total_debit'].shift(1)
df['lag_2'] = df['total_debit'].shift(2)
df['lag_3'] = df['total_debit'].shift(3)

# Rumus Rolling Mean: roll_k_i = (1/k) * sum(total_debit_{i-j}) for j from 0 to k-1
df['roll_7'] = df['total_debit'].rolling(7).mean()

initial_rows_after_features = len(df)
df = df.dropna().reset_index(drop=True)
removed_nan_rows = initial_rows_after_features - len(df)

print("Fitur waktu dan lag berhasil dibuat.")
print(f"{removed_nan_rows} baris dengan NaN dihapus (akibat shift/rolling).")
print("Contoh 5 baris pertama dengan fitur baru:\n", df[['created_at', 'total_debit', 'day_of_year', 'lag_1', 'roll_7']].head())


# ----------------------------------------------------
# 6. Definisikan X untuk K-Means
# ----------------------------------------------------
print("\n--- Langkah 6: Definisi Matriks Fitur (X) ---")
feature_cols = ['debit_organik','debit_anorganik','day_of_year','week_of_year','month','weekday','lag_1','lag_2','lag_3','roll_7']
X = df[feature_cols].values
print(f"Matriks fitur X dibuat dengan {X.shape[0]} observasi dan {X.shape[1]} fitur.")
print("Contoh 3 baris pertama matriks X:\n", X[:3])

# ----------------------------------------------------
# 7. Normalisasi data (MinMaxScaler)
# ----------------------------------------------------
print("\n--- Langkah 7: Normalisasi Data (Min-Max Scaling) ---")
# Rumus: x'_ij = (x_ij - min(x_j)) / (max(x_j) - min(x_j))
scaler_X = MinMaxScaler()
X_scaled = scaler_X.fit_transform(X)
print("Data berhasil dinormalisasi ke rentang [0, 1].")
print("Contoh 3 baris pertama matriks X_scaled:\n", X_scaled[:3])

# ----------------------------------------------------
# 8. K-Means Clustering
# ----------------------------------------------------
print("\n--- Langkah 8: K-Means Clustering ---")
k = 3 # Jumlah cluster
print(f"Memulai K-Means Clustering dengan k = {k} cluster.")

kmeans = KMeans(n_clusters=k, random_state=42, n_init=10) # n_init=10 untuk menjalankan algoritma 10 kali
df['cluster'] = kmeans.fit_predict(X_scaled)
print("K-Means clustering selesai. Label cluster ditambahkan ke DataFrame.")
print("Contoh 5 baris pertama dengan label cluster:\n", df[['total_debit', 'cluster']].head())

# Menampilkan Centroid Akhir (dalam skala yang dinormalisasi)
print("\nPosisi Centroid Akhir (dalam skala normalisasi):")
for i, centroid in enumerate(kmeans.cluster_centers_):
    print(f"  Cluster {i}: {centroid}")

# Visualisasi Cluster (Menggunakan 2 fitur untuk memudahkan visualisasi)
plt.figure(figsize=(10, 7))
sns.scatterplot(x='total_debit', y='roll_7', hue='cluster', data=df, palette='viridis', s=100, alpha=0.7)
plt.title('Visualisasi Cluster K-Means (total_debit vs roll_7)')
plt.xlabel('Total Debit')
plt.ylabel('Rata-rata Rolling 7 Hari')
plt.legend(title='Cluster')
plt.grid(True)
plt.show()

# ----------------------------------------------------
# 9. Menyusun label untuk kategori berdasarkan rata-rata nilai total_debit
# ----------------------------------------------------
print("\n--- Langkah 9: Penugasan Label Kategori ke Cluster ---")
# Hitung rata-rata total_debit untuk setiap cluster
# Rumus: MeanTotalDebit_j = (1/|C_j|) * sum(total_debit_i for i in C_j)
cluster_means = df.groupby('cluster')['total_debit'].mean().sort_values()
print("Rata-rata 'total_debit' per cluster (sebelum mapping):\n", cluster_means)

# Buat mapping dari ID cluster ke label yang bermakna
# Cluster dengan rata-rata terendah -> 'Jauh'
# Cluster dengan rata-rata menengah -> 'Sedang'
# Cluster dengan rata-rata tertinggi -> 'Hampir Penuh'
cluster_map = {cluster_means.index[0]: 'Jauh', 
               cluster_means.index[1]: 'Sedang', 
               cluster_means.index[2]: 'Hampir Penuh'}
df['condition'] = df['cluster'].map(cluster_map)
print("Label kategori ('Jauh', 'Sedang', 'Hampir Penuh') berhasil ditugaskan ke cluster.")
print("Contoh 5 baris pertama dengan 'condition':\n", df[['total_debit', 'cluster', 'condition']].head())

# ----------------------------------------------------
# 10. Menampilkan Rentang Nilai (Range) dan Kategorinya
# ----------------------------------------------------
print("\n--- Langkah 10: Analisis Rentang Nilai dan Kategori Cluster ---")
# Rumus:
# MinTotalDebit_j = min(total_debit_i for i in C_j)
# MaxTotalDebit_j = max(total_debit_i for i in C_j)
# MeanTotalDebit_j (sudah dihitung di langkah 9)
cluster_range = df.groupby('cluster')['total_debit'].agg(['min', 'max', 'mean']).sort_values(by='mean')

# Menampilkan rentang dan kategori berdasarkan cluster yang sudah diurutkan
for cluster_id in cluster_range.index:
    condition_label = df[df['cluster'] == cluster_id]['condition'].iloc[0] # Ambil label kondisi dari salah satu baris di cluster
    print(f"Cluster {cluster_id} - Kategori: {condition_label}:")
    print(f"  Rentang Total Debit: {cluster_range.loc[cluster_id, 'min']:.2f} - {cluster_range.loc[cluster_id, 'max']:.2f}")
    print(f"  Rata-Rata Total Debit: {cluster_range.loc[cluster_id, 'mean']:.2f}\n")

print("--- Proses K-Means Clustering Selesai ---")