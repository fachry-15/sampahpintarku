import pandas as pd
import numpy as np
import requests
from datetime import timedelta

# 1. Ambil data dari API
url = "http://localhost:8000/api/ann/show"
resp = requests.get(url)
data = resp.json()['data']

# 2. Konversi data ke DataFrame dan pastikan kolom 'created_at' dalam format datetime
df = pd.DataFrame(data)
df['created_at'] = pd.to_datetime(df['created_at'])

# Urutkan berdasarkan waktu dan reset index
df = df.sort_values('created_at').reset_index(drop=True)

# ---
## 3. Buat kolom total_debit (jumlah dari debit organik dan anorganik)
df['total_debit'] = df['debit_organik'] + df['debit_anorganik']
print("### Langkah 3: Perhitungan 'total_debit'\n")
print("Rumus: total_debit = debit_organik + debit_anorganik")
print("\nHasil kolom 'total_debit':")
print(df[['created_at', 'debit_organik', 'debit_anorganik', 'total_debit']].head())

# ---
## 4. Menambahkan fitur waktu: bulan, minggu dalam tahun, hari dalam minggu
df['month'] = df['created_at'].dt.month
df['weekday'] = df['created_at'].dt.weekday
df['week_of_year'] = df['created_at'].dt.isocalendar().week
print("\n### Langkah 4: Penambahan Fitur Waktu\n")
print("Rumus: ")
print("- month = created_at.dt.month")
print("- weekday = created_at.dt.weekday")
print("- week_of_year = created_at.dt.isocalendar().week")
print("\nHasil kolom fitur waktu:")
print(df[['created_at', 'month', 'weekday', 'week_of_year']].head())

# ---
## 5. Menambahkan fitur lag (nilai debit pada minggu sebelumnya)
df['lag_1'] = df['total_debit'].shift(1)  # Lag 1 minggu sebelumnya
df['lag_2'] = df['total_debit'].shift(2)  # Lag 2 minggu sebelumnya
df['lag_3'] = df['total_debit'].shift(3)  # Lag 3 minggu sebelumnya
df['lag_4'] = df['total_debit'].shift(4)  # Lag 4 minggu sebelumnya
print("\n### Langkah 5: Penambahan Fitur Lag\n")
print("Rumus: ")
print("- lag_1 = total_debit.shift(1)")
print("- lag_2 = total_debit.shift(2)")
print("- lag_3 = total_debit.shift(3)")
print("- lag_4 = total_debit.shift(4)")
print("\nHasil kolom fitur lag (sebelum dropna):")
print(df[['created_at', 'total_debit', 'lag_1', 'lag_2', 'lag_3', 'lag_4']].head(7)) # Tampilkan lebih banyak baris untuk melihat NaN

# ---
## 6. Drop NaN yang muncul setelah menggunakan shift
df = df.dropna().reset_index(drop=True)
print("\n### Langkah 6: Drop NaN\n")
print("Operasi: df = df.dropna().reset_index(drop=True)")
print("\nDataFrame setelah baris dengan nilai NaN di kolom lag dihilangkan:")
print(df[['created_at', 'total_debit', 'lag_1', 'lag_2', 'lag_3', 'lag_4']].head())

# ---
## 7. Print data dengan kolom tambahan yang telah dihitung
print("\n### Langkah 7: Data Setelah Transformasi Awal\n")
print("Ringkasan Data yang digunakan untuk perhitungan selanjutnya:")
print(df[['created_at', 'total_debit', 'month', 'weekday', 'week_of_year', 'lag_1', 'lag_2', 'lag_3', 'lag_4']].head())

# ---
## 8. Menghitung perubahan debit harian (daily change)
initial_daily_change = df['total_debit'].diff().shift(-1)
df['daily_change'] = initial_daily_change # Perubahan debit harian (minggu ke-1 ke minggu ke-2)
print("\n### Langkah 8: Perhitungan 'daily_change' (Tahap Awal)\n")
print("Rumus Awal: daily_change = total_debit.diff().shift(-1)")
print("\nHasil 'daily_change' awal:")
print(df[['created_at', 'total_debit', 'daily_change']].head())

# ---
## 8.1 Ambil hanya perubahan yang positif
df['daily_change'] = df['daily_change'][df['daily_change'] > 0]
print("\n### Langkah 8.1: Filter 'daily_change' Positif\n")
print("Kondisi: daily_change > 0")
print("\nHasil 'daily_change' setelah memfilter nilai positif:")
print(df[['created_at', 'total_debit', 'daily_change']].head())

# ---
## 8.2 Jika tidak ada perubahan positif, gunakan perubahan absolut
if df['daily_change'].isnull().all():
    df['daily_change'] = abs(initial_daily_change) # Menggunakan initial_daily_change yang belum difilter
    print("\n### Langkah 8.2: Penyesuaian 'daily_change' (Jika Semua Negatif/Nol)\n")
    print("Kondisi: Jika semua 'daily_change' kosong (NaN), gunakan nilai absolut dari perubahan awal.")
    print("Rumus: daily_change = abs(total_debit.diff().shift(-1))")
    print("\nHasil 'daily_change' setelah penyesuaian (jika dilakukan):")
    print(df[['created_at', 'total_debit', 'daily_change']].head())
else:
    print("\n### Langkah 8.2: Penyesuaian 'daily_change' (Tidak Perlu)\n")
    print("Tidak ada penyesuaian 'daily_change' karena sudah ada nilai positif.")

# ---
## 9. Hitung rata-rata perubahan debit harian
avg_daily_change = df['daily_change'].mean()
print(f"\n### Langkah 9: Rata-rata Perubahan Debit Harian\n")
print("Rumus: avg_daily_change = daily_change.mean()")
print(f"Hasil: avg_daily_change = {avg_daily_change:.2f}")

# ---
## 10. Tentukan nilai target debit (misalnya, 80% dari total debit pada minggu mendatang)
current_debit = df['total_debit'].iloc[-1]
target_debit = 0.8 * current_debit
print(f"\n### Langkah 10: Penentuan Target Debit\n")
print(f"Rumus: target_debit = 0.8 * current_debit")
print(f"Nilai 'current_debit' (debit terakhir): {current_debit:.2f}")
print(f"Hasil: target_debit = {target_debit:.2f}")

# ---
## 11. Estimasi waktu untuk mencapai target debit 80% dari nilai debit terakhir
# Pastikan avg_daily_change tidak nol untuk menghindari ZeroDivisionError
if avg_daily_change == 0:
    days_to_target = float('inf') # Set to infinity if no change
    print(f"\n### Langkah 11: Estimasi Waktu ke Target (Perubahan Harian Nol)\n")
    print(f"Karena rata-rata perubahan debit harian adalah nol, target tidak dapat dicapai. days_to_target = {days_to_target}")
else:
    days_to_target = (target_debit - current_debit) / avg_daily_change
    days_to_target = max(0, days_to_target)
    print(f"\n### Langkah 11: Estimasi Waktu ke Target\n")
    print(f"Rumus: days_to_target = (target_debit - current_debit) / avg_daily_change")
    print(f"Hasil: days_to_target = {days_to_target:.2f} hari")

# ---
## 12. Pembulatan waktu ke angka bulat terdekat
rounded_days = round(days_to_target)
print(f"\n### Langkah 12: Pembulatan Waktu\n")
print(f"Rumus: rounded_days = round(days_to_target)")
print(f"Hasil: rounded_days = {rounded_days} hari")

# ---
## 13. Tentukan tanggal prediksi pengambilan berdasarkan pembulatan hari
latest_date = df['created_at'].iloc[-1]
pred_pickup_date = latest_date + timedelta(days=rounded_days)
print(f"\n### Langkah 13: Prediksi Tanggal Pengambilan\n")
print(f"Rumus: pred_pickup_date = latest_date + timedelta(days=rounded_days)")
print(f"Tanggal terbaru dalam data: {latest_date}")
print(f"Hasil: pred_pickup_date = {pred_pickup_date}")

# ---
## 14. Format tanggal untuk pengambilan
formatted_pred_pickup_date = pred_pickup_date.strftime('%Y-%m-%d %H:%M:%S')
print(f"\n### Langkah 14: Format Tanggal Prediksi\n")
print(f"Rumus: formatted_pred_pickup_date = pred_pickup_date.strftime('%Y-%m-%d %H:%M:%S')")
print(f"Hasil: formatted_pred_pickup_date = {formatted_pred_pickup_date}")

# ---
## 15. Print hasil estimasi waktu pengambilan
print(f"\n### Langkah 15: Hasil Akhir Prediksi\n")
print(f"Prediksi waktu pengambilan untuk mencapai 80% target debit: {formatted_pred_pickup_date}")