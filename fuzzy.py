import numpy as np
import skfuzzy as fuzz
import matplotlib.pyplot as plt

# Domain variabel input/output
x_debit = np.arange(0, 101, 1)         # Debit organik dan anorganik (0-100%)
x_output = np.arange(0, 181, 1)        # Sudut servo (0°-180°)

# Fungsi keanggotaan Debit
debit_kosong = fuzz.trimf(x_debit, [0, 0, 30])
debit_sedang = fuzz.trimf(x_debit, [20, 50, 80])
debit_penuh = fuzz.trimf(x_debit, [70, 100, 100])

# Fungsi keanggotaan Output Servo
servo_organik = fuzz.trimf(x_output, [0, 30, 60])
servo_diam = fuzz.trimf(x_output, [60, 90, 120])
servo_anorganik = fuzz.trimf(x_output, [120, 150, 180])

# --- Visualisasi Fungsi Keanggotaan (Tetap sama) ---
plt.figure(figsize=(10, 5))
plt.plot(x_debit, debit_kosong, 'b', label='Kosong')
plt.plot(x_debit, debit_sedang, 'g', label='Sedang')
plt.plot(x_debit, debit_penuh, 'r', label='Penuh')
plt.title('Fungsi Keanggotaan Debit Sampah')
plt.xlabel('Debit (%)')
plt.ylabel('Derajat Keanggotaan')
plt.legend()
plt.grid(True)
plt.show()

plt.figure(figsize=(10, 5))
plt.plot(x_output, servo_organik, 'orange', label='Organik (30°)')
plt.plot(x_output, servo_anorganik, 'cyan', label='Anorganik (150°)')
plt.plot(x_output, servo_diam, 'purple', label='Diam (90°)')
plt.title('Fungsi Keanggotaan Output Servo')
plt.xlabel('Sudut Servo (°)')
plt.ylabel('Derajat Keanggotaan')
plt.legend()
plt.grid(True)
plt.show()
# --- End Visualisasi ---

# -------------------------------
# Contoh Input: Uji Fuzzy (DISESUAIKAN UNTUK MENGHASILKAN 90 DERAJAT)
# Skenario: Sensor Kapasitif HIGH, Sensor IR HIGH (memicu Rule 5)
# -------------------------------
capasitive_input = 1      # 1 = HIGH
ir_sensor_input = 1       # 1 = HIGH
debit_org_input = 15      # misal 15% (Kosong/Sedang)
debit_anorg_input = 25    # misal 25% (Kosong/Sedang)

print(f"--- Input Aktual ---")
print(f"Sensor Kapasitif (0=LOW, 1=HIGH): {capasitive_input}")
print(f"Sensor IR (0=LOW, 1=HIGH): {ir_sensor_input}")
print(f"Debit Organik (%): {debit_org_input}")
print(f"Debit Anorganik (%): {debit_anorg_input}")
print(f"---------------------\n")

# Fuzzifikasi Input Debit
μ_kosong_org = fuzz.interp_membership(x_debit, debit_kosong, debit_org_input)
μ_sedang_org = fuzz.interp_membership(x_debit, debit_sedang, debit_org_input)
μ_penuh_org = fuzz.interp_membership(x_debit, debit_penuh, debit_org_input)

μ_kosong_anorg = fuzz.interp_membership(x_debit, debit_kosong, debit_anorg_input)
μ_sedang_anorg = fuzz.interp_membership(x_debit, debit_sedang, debit_anorg_input)
μ_penuh_anorg = fuzz.interp_membership(x_debit, debit_penuh, debit_anorg_input)

print(f"--- Fuzzifikasi Input Debit ---")
print(f"Debit Organik ({debit_org_input}%):")
print(f"  μ_kosong_org: {μ_kosong_org:.2f}")
print(f"  μ_sedang_org: {μ_sedang_org:.2f}")
print(f"  μ_penuh_org: {μ_penuh_org:.2f}")
print(f"Debit Anorganik ({debit_anorg_input}%):")
print(f"  μ_kosong_anorg: {μ_kosong_anorg:.2f}")
print(f"  μ_sedang_anorg: {μ_sedang_anorg:.2f}")
print(f"  μ_penuh_anorg: {μ_penuh_anorg:.2f}")
print(f"--------------------------------\n")


# -------------------------------
# Rule Evaluation
# -------------------------------
print(f"--- Evaluasi Aturan Fuzzy ---")

# Rule 1: IF (SC is LOW / TidakAdaSampah) AND (SI is LOW / TidakAdaObjek) AND (PO is NOT Penuh) THEN (AS is Organik)
kondisi_sc_low = 1 - capasitive_input
kondisi_si_low = 1 - ir_sensor_input
kondisi_po_not_penuh = max(μ_kosong_org, μ_sedang_org)
α1 = min(kondisi_sc_low, kondisi_si_low, kondisi_po_not_penuh)
print(f"Rule 1 (Organik): min(SC_LOW({kondisi_sc_low}), SI_LOW({kondisi_si_low}), PO_NOT_Penuh({kondisi_po_not_penuh:.2f})) = {α1:.2f}")

# Rule 2: IF (SC is HIGH / AdaSampah) AND (SI is LOW / TidakAdaObjek) AND (PA is NOT Penuh) THEN (AS is Anorganik)
kondisi_sc_high = capasitive_input
kondisi_pa_not_penuh = max(μ_kosong_anorg, μ_sedang_anorg)
α2 = min(kondisi_sc_high, kondisi_si_low, kondisi_pa_not_penuh)
print(f"Rule 2 (Anorganik): min(SC_HIGH({kondisi_sc_high}), SI_LOW({kondisi_si_low}), PA_NOT_Penuh({kondisi_pa_not_penuh:.2f})) = {α2:.2f}")

# Rule 3: IF (SC is LOW / TidakAdaSampah) AND (SI is LOW / TidakAdaObjek) AND (PO is Penuh) THEN (AS is Diam/JanganGerak)
α3 = min(kondisi_sc_low, kondisi_si_low, μ_penuh_org)
print(f"Rule 3 (Organik Penuh -> Diam): min(SC_LOW({kondisi_sc_low}), SI_LOW({kondisi_si_low}), PO_Penuh({μ_penuh_org:.2f})) = {α3:.2f}")

# Rule 4: IF (SC is HIGH / AdaSampah) AND (SI is LOW / TidakAdaObjek) AND (PA is Penuh) THEN (AS is Diam/JanganGerak)
α4 = min(kondisi_sc_high, kondisi_si_low, μ_penuh_anorg)
print(f"Rule 4 (Anorganik Penuh -> Diam): min(SC_HIGH({kondisi_sc_high}), SI_LOW({kondisi_si_low}), PA_Penuh({μ_penuh_anorg:.2f})) = {α4:.2f}")

# Rule 5: Default atau Kondisi Lainnya -> Diam
# Ini mencakup skenario (SC_HIGH dan SI_HIGH) atau (SC_LOW dan SI_HIGH)
α5_kondisi_lainnya = max(
    min(capasitive_input, ir_sensor_input), # SC_HIGH and SI_HIGH
    min(1 - capasitive_input, ir_sensor_input) # SC_LOW and SI_HIGH
)
α5 = α5_kondisi_lainnya
print(f"Rule 5 (Kondisi Lainnya -> Diam): α5_kondisi_lainnya({α5_kondisi_lainnya:.2f}) = {α5:.2f}")

print(f"-----------------------------\n")

# Output untuk setiap rule
rule1_output = np.fmin(α1, servo_organik)
rule2_output = np.fmin(α2, servo_anorganik)
rule3_output = np.fmin(α3, servo_diam)
rule4_output = np.fmin(α4, servo_diam)
rule5_output = np.fmin(α5, servo_diam)

# Gabungan semua output
aggregated = np.fmax(rule1_output,
                     np.fmax(rule2_output,
                     np.fmax(rule3_output,
                     np.fmax(rule4_output, rule5_output))))

print(f"--- Agregasi Output Fuzzy ---")
print(f"Menggabungkan hasil dari semua Rule ({len([r for r in [rule1_output, rule2_output, rule3_output, rule4_output, rule5_output] if np.sum(r) > 0])} rule aktif) menggunakan operasi MAX.")
print(f"Nilai maksimum dari fungsi keanggotaan teragregasi: {np.max(aggregated):.2f}")
print(f"Penjumlahan total dari fungsi keanggotaan teragregasi: {np.sum(aggregated):.2f}")
print(f"------------------------------\n")

# Defuzzifikasi
print(f"--- Defuzzifikasi ---")
print(f"Metode Defuzzifikasi yang digunakan: Centroid (Pusat Gravitasi)")

if np.sum(aggregated) == 0:
    servo_result = 90
    servo_activation = fuzz.interp_membership(x_output, servo_diam, servo_result)
    print(f"Kondisi: Tidak ada area yang diagregasi (sum(aggregated) == 0).")
    print(f"Rumus: servo_result = 90 (Default ke posisi diam).")
else:
    print(f"Rumus: servo_result = Σ(x * μ_aggregated(x)) / Σ(μ_aggregated(x))")
    print(f"  Di mana x adalah nilai sudut servo, dan μ_aggregated(x) adalah derajat keanggotaan teragregasi.")

    numerator = np.sum(x_output * aggregated)
    denominator = np.sum(aggregated)

    print(f"  Numerator (Σ(x * μ(x))): {numerator:.2f}")
    print(f"  Denominator (Σ(μ(x))): {denominator:.2f}")
    
    servo_result = fuzz.defuzz(x_output, aggregated, 'centroid')
    servo_activation = fuzz.interp_membership(x_output, aggregated, servo_result)
    print(f"  Hasil Centroid (Numerator / Denominator): {servo_result:.2f}")

print(f"---------------------\n")

# -------------------------------
# Visualisasi Output Fuzzy
# -------------------------------
plt.figure(figsize=(10, 5))
plt.plot(x_output, servo_organik, 'orange', linestyle='--', label='Organik')
plt.plot(x_output, servo_anorganik, 'cyan', linestyle='--', label='Anorganik')
plt.plot(x_output, servo_diam, 'purple', linestyle='--', label='Diam')
plt.fill_between(x_output, np.zeros_like(x_output), aggregated, facecolor='gray', alpha=0.5, label='Agregasi Fuzzy')
plt.plot([servo_result, servo_result], [0, servo_activation], 'k', linewidth=2, label='Defuzzifikasi Centroid')
plt.title('Output Servo Fuzzy Inference')
plt.xlabel('Sudut Servo (°)')
plt.ylabel('Aktivasi')
plt.legend()
plt.grid(True)
plt.show()

print(f"Hasil defuzzifikasi (sudut servo akhir): {servo_result:.2f}°")