plt.savefig('training_validation_metrics.png')
plt.show()
print("Grafik 'training_validation_metrics.png' telah dibuat.")

# --- 10. Evaluasi Model pada Data Validasi ---
print("\n--- 10. Evaluasi Model pada Data Validasi ---")
val_loss, val_mae = best_model.evaluate(X_val, y_val, verbose=0)
print(f"Validation Loss (MSE): {val_loss:.4f}")
print(f"Validation MAE: {val_mae:.4f}")

# --- 11. Prediksi dan Visualisasi Hasil ---
print("\n--- 11. Prediksi dan Visualisasi Hasil ---")
y_val_pred_scaled = best_model.predict(X_val)
y_val_pred = scaler_y.inverse_transform(y_val_pred_scaled)
y_val_actual = scaler_y.inverse_transform(y_val)

plt.figure(figsize=(12, 6))
plt.plot(df['created_at'].iloc[split:], y_val_actual, label='Actual Total Debit', color='blue')
plt.plot(df['created_at'].iloc[split:], y_val_pred, label='Predicted Total Debit', color='orange')
plt.title('Actual vs Predicted Total Debit (Validation Set)')
plt.xlabel('Tanggal')
plt.ylabel('Total Debit (Liter/Unit)')
plt.legend()
plt.grid(True)
plt.tight_layout()
plt.savefig('actual_vs_predicted_total_debit.png')
plt.show()
print("Grafik 'actual_vs_predicted_total_debit.png' telah dibuat.")

# --- 12. Simulasi Prediksi Hari Berikutnya ---
print("\n--- 12. Simulasi Prediksi Hari Berikutnya ---")
# Ambil data terakhir dari DataFrame setelah dropna (fitur sudah lengkap)
last_row = df.iloc[-1].copy()
# Siapkan fitur untuk prediksi hari berikutnya
next_date = last_row['created_at'] + timedelta(days=1)
next_features = np.array([[
    last_row['debit_organik'],
    last_row['debit_anorganik'],
    next_date.dayofyear,
    next_date.isocalendar().week,
    next_date.month,
    next_date.weekday(),
    last_row['total_debit'],
    last_row['lag_1'],
    last_row['lag_2'],
    last_row['roll_7']
]])
next_features_scaled = scaler_X.transform(next_features)
next_pred_scaled = best_model.predict(next_features_scaled)
next_pred = scaler_y.inverse_transform(next_pred_scaled)[0][0]
print(f"Prediksi total_debit untuk tanggal {next_date.date()}: {next_pred:.2f}")
