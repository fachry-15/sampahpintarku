#!/usr/bin/env python3
import numpy as np
import pandas as pd
import tensorflow as tf
from tensorflow.keras.models import load_model
from sklearn.preprocessing import MinMaxScaler
import requests
from datetime import timedelta

# ——— Config —————————————————————————————————————
API_URL       = "http://localhost:8000/api/ann"   # Data histori penuh
MODEL_PATH    = "model.h5"
CAPACITY_L    = 100.0    # kapasitas 100 L = 100%
THRESHOLD_P   = 0.8      # 80%
LOOKBACK_DAYS = 7
MAX_FORECAST  = 14
# ————————————————————————————————————————————————

# 1. Load model
model = load_model(MODEL_PATH)

# 2. Fetch data historis
resp = requests.get(API_URL)
hist = resp.json().get("data", [])
if not hist:
    raise RuntimeError("Gagal ambil data histori dari API!")

df = pd.DataFrame(hist)
df['created_at']  = pd.to_datetime(df['created_at'])
# perbaiki penggunaan dayofyear
df['day_of_year'] = df['created_at'].dt.dayofyear
df['total_debit'] = df['debit_organik'] + df['debit_anorganik']

# 3. Fit MinMaxScaler langsung dari numpy array
X_all = df[['debit_organik','debit_anorganik','day_of_year']].values
scaler = MinMaxScaler().fit(X_all)

# 4. Hitung rata-rata kenaikan liter per hari (linier)
recent     = df['total_debit'].iloc[-(LOOKBACK_DAYS+1):].values
daily_diff = np.diff(recent)
avg_inc    = daily_diff.mean()

# 5. Titik awal simulasi (hari terakhir)
last     = df.iloc[-1]
base_dt  = last['created_at']
org0     = last['debit_organik']
anorg0   = last['debit_anorganik']
total0   = last['total_debit']
ratio_org = org0 / total0 if total0 else 0.5

pickup_date = None

print(f"Rata-rata kenaikan liter/hari: {avg_inc:.2f} L\n")

# 6. Simulasi prediksi hingga MAX_FORECAST hari ke depan
for i in range(0, MAX_FORECAST+1):
    sim_date = base_dt + timedelta(days=i)
    sim_day  = sim_date.dayofyear    # gunakan dayofyear, bukan day_of_year

    # Proyeksi total liter naik secara linier
    sim_total = total0 + avg_inc * i
    sim_org   = sim_total * ratio_org
    sim_anorg = sim_total * (1 - ratio_org)

    # Normalisasi & prediksi liter
    X_sim   = np.array([[sim_org, sim_anorg, sim_day]])
    Xn      = scaler.transform(X_sim)
    p_liter = model.predict(Xn, verbose=0)[0, 0]
    p_pct   = p_liter / CAPACITY_L

    print(f"{sim_date.date()} → {p_liter:.2f} L ({p_pct*100:.1f}%)")

    if p_pct >= THRESHOLD_P:
        pickup_date = sim_date.date()
        break

# 7. Tampilkan hasil akhir
if pickup_date:
    print(f"\n⚡ Prediksi pertama ≥{THRESHOLD_P*100:.0f}% pada: {pickup_date}")
else:
    print(f"\n✅ Fullness <{THRESHOLD_P*100:.0f}% untuk {MAX_FORECAST} hari ke depan.")
