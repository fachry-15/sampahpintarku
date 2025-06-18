import numpy as np
import skfuzzy as fuzz
import matplotlib.pyplot as plt

# Input/output variable domains
x_debit = np.arange(0, 101, 1)         # Organic and inorganic bin level (0-100%)
x_output = np.arange(0, 181, 1)        # Servo angle (0°-180°)

# Membership functions for Bin Level
debit_empty = fuzz.trimf(x_debit, [0, 0, 30])
debit_medium = fuzz.trimf(x_debit, [20, 50, 80])
debit_full = fuzz.trimf(x_debit, [70, 100, 100])

# Membership functions for Servo Output
servo_organic = fuzz.trimf(x_output, [0, 30, 60])
servo_idle = fuzz.trimf(x_output, [60, 90, 120])
servo_inorganic = fuzz.trimf(x_output, [120, 150, 180])

# --- Membership Function Visualization ---
plt.figure(figsize=(10, 5))
plt.plot(x_debit, debit_empty, 'b', label='Empty')
plt.plot(x_debit, debit_medium, 'g', label='Medium')
plt.plot(x_debit, debit_full, 'r', label='Full')
plt.title('Bin Level Membership Functions')
plt.xlabel('Bin Level (%)')
plt.ylabel('Membership Degree')
plt.legend()
plt.grid(True)
plt.show()

plt.figure(figsize=(10, 5))
plt.plot(x_output, servo_organic, 'orange', label='Organic (30°)')
plt.plot(x_output, servo_inorganic, 'cyan', label='Inorganic (150°)')
plt.plot(x_output, servo_idle, 'purple', label='Idle (90°)')
plt.title('Servo Output Membership Functions')
plt.xlabel('Servo Angle (°)')
plt.ylabel('Membership Degree')
plt.legend()
plt.grid(True)
plt.show()
# --- End Visualization ---

# -------------------------------
# Example Input: Fuzzy Test (SET TO PRODUCE 90 DEGREES)
# Scenario: Capacitive Sensor HIGH, IR Sensor HIGH (triggers Rule 5)
# -------------------------------
capasitive_input = 1      # 1 = HIGH
ir_sensor_input = 1       # 1 = HIGH
debit_org_input = 15      # e.g. 15% (Empty/Medium)
debit_anorg_input = 25    # e.g. 25% (Empty/Medium)

print(f"--- Actual Input ---")
print(f"Capacitive Sensor (0=LOW, 1=HIGH): {capasitive_input}")
print(f"IR Sensor (0=LOW, 1=HIGH): {ir_sensor_input}")
print(f"Organic Bin Level (%): {debit_org_input}")
print(f"Inorganic Bin Level (%): {debit_anorg_input}")
print(f"---------------------\n")

# Fuzzification of Bin Level Input
μ_empty_org = fuzz.interp_membership(x_debit, debit_empty, debit_org_input)
μ_medium_org = fuzz.interp_membership(x_debit, debit_medium, debit_org_input)
μ_full_org = fuzz.interp_membership(x_debit, debit_full, debit_org_input)

μ_empty_anorg = fuzz.interp_membership(x_debit, debit_empty, debit_anorg_input)
μ_medium_anorg = fuzz.interp_membership(x_debit, debit_medium, debit_anorg_input)
μ_full_anorg = fuzz.interp_membership(x_debit, debit_full, debit_anorg_input)

print(f"--- Fuzzification of Bin Level Input ---")
print(f"Organic Bin Level ({debit_org_input}%):")
print(f"  μ_empty_org: {μ_empty_org:.2f}")
print(f"  μ_medium_org: {μ_medium_org:.2f}")
print(f"  μ_full_org: {μ_full_org:.2f}")
print(f"Inorganic Bin Level ({debit_anorg_input}%):")
print(f"  μ_empty_anorg: {μ_empty_anorg:.2f}")
print(f"  μ_medium_anorg: {μ_medium_anorg:.2f}")
print(f"  μ_full_anorg: {μ_full_anorg:.2f}")
print(f"--------------------------------\n")


# -------------------------------
# Rule Evaluation
# -------------------------------
print(f"--- Fuzzy Rule Evaluation ---")

# Rule 1: IF (Capacitive Sensor is LOW / NoWaste) AND (IR Sensor is LOW / NoObject) AND (Organic Bin is NOT Full) THEN (Servo is Organic)
cond_sc_low = 1 - capasitive_input
cond_si_low = 1 - ir_sensor_input
cond_po_not_full = max(μ_empty_org, μ_medium_org)
α1 = min(cond_sc_low, cond_si_low, cond_po_not_full)
print(f"Rule 1 (Organic): min(SC_LOW({cond_sc_low}), SI_LOW({cond_si_low}), PO_NOT_Full({cond_po_not_full:.2f})) = {α1:.2f}")

# Rule 2: IF (Capacitive Sensor is HIGH / WasteDetected) AND (IR Sensor is LOW / NoObject) AND (Inorganic Bin is NOT Full) THEN (Servo is Inorganic)
cond_sc_high = capasitive_input
cond_pa_not_full = max(μ_empty_anorg, μ_medium_anorg)
α2 = min(cond_sc_high, cond_si_low, cond_pa_not_full)
print(f"Rule 2 (Inorganic): min(SC_HIGH({cond_sc_high}), SI_LOW({cond_si_low}), PA_NOT_Full({cond_pa_not_full:.2f})) = {α2:.2f}")

# Rule 3: IF (Capacitive Sensor is LOW / NoWaste) AND (IR Sensor is LOW / NoObject) AND (Organic Bin is Full) THEN (Servo is Idle/DoNotMove)
α3 = min(cond_sc_low, cond_si_low, μ_full_org)
print(f"Rule 3 (Organic Full -> Idle): min(SC_LOW({cond_sc_low}), SI_LOW({cond_si_low}), PO_Full({μ_full_org:.2f})) = {α3:.2f}")

# Rule 4: IF (Capacitive Sensor is HIGH / WasteDetected) AND (IR Sensor is LOW / NoObject) AND (Inorganic Bin is Full) THEN (Servo is Idle/DoNotMove)
α4 = min(cond_sc_high, cond_si_low, μ_full_anorg)
print(f"Rule 4 (Inorganic Full -> Idle): min(SC_HIGH({cond_sc_high}), SI_LOW({cond_si_low}), PA_Full({μ_full_anorg:.2f})) = {α4:.2f}")

# Rule 5: Default or Other Conditions -> Idle
# This includes scenarios (SC_HIGH and SI_HIGH) or (SC_LOW and SI_HIGH)
α5_other_conditions = max(
    min(capasitive_input, ir_sensor_input), # SC_HIGH and SI_HIGH
    min(1 - capasitive_input, ir_sensor_input) # SC_LOW and SI_HIGH
)
α5 = α5_other_conditions
print(f"Rule 5 (Other Conditions -> Idle): α5_other_conditions({α5_other_conditions:.2f}) = {α5:.2f}")

print(f"-----------------------------\n")

# Output for each rule
rule1_output = np.fmin(α1, servo_organic)
rule2_output = np.fmin(α2, servo_inorganic)
rule3_output = np.fmin(α3, servo_idle)
rule4_output = np.fmin(α4, servo_idle)
rule5_output = np.fmin(α5, servo_idle)

# Aggregate all outputs
aggregated = np.fmax(rule1_output,
                     np.fmax(rule2_output,
                     np.fmax(rule3_output,
                     np.fmax(rule4_output, rule5_output))))

print(f"--- Fuzzy Output Aggregation ---")
print(f"Combining results from all rules ({len([r for r in [rule1_output, rule2_output, rule3_output, rule4_output, rule5_output] if np.sum(r) > 0])} active rules) using MAX operation.")
print(f"Maximum value of aggregated membership function: {np.max(aggregated):.2f}")
print(f"Total sum of aggregated membership function: {np.sum(aggregated):.2f}")
print(f"------------------------------\n")

# Defuzzification
print(f"--- Defuzzification ---")
print(f"Defuzzification method used: Centroid (Center of Gravity)")

if np.sum(aggregated) == 0:
    servo_result = 90
    servo_activation = fuzz.interp_membership(x_output, servo_idle, servo_result)
    print(f"Condition: No aggregated area (sum(aggregated) == 0).")
    print(f"Formula: servo_result = 90 (Default to idle position).")
else:
    print(f"Formula: servo_result = Σ(x * μ_aggregated(x)) / Σ(μ_aggregated(x))")
    print(f"  Where x is the servo angle value, and μ_aggregated(x) is the aggregated membership degree.")

    numerator = np.sum(x_output * aggregated)
    denominator = np.sum(aggregated)

    print(f"  Numerator (Σ(x * μ(x))): {numerator:.2f}")
    print(f"  Denominator (Σ(μ(x))): {denominator:.2f}")
    
    servo_result = fuzz.defuzz(x_output, aggregated, 'centroid')
    servo_activation = fuzz.interp_membership(x_output, aggregated, servo_result)
    print(f"  Centroid Result (Numerator / Denominator): {servo_result:.2f}")

print(f"---------------------\n")

# -------------------------------
# Fuzzy Output Visualization
# -------------------------------
plt.figure(figsize=(10, 5))
plt.plot(x_output, servo_organic, 'orange', linestyle='--', label='Organic')
plt.plot(x_output, servo_inorganic, 'cyan', linestyle='--', label='Inorganic')
plt.plot(x_output, servo_idle, 'purple', linestyle='--', label='Idle')
plt.fill_between(x_output, np.zeros_like(x_output), aggregated, facecolor='gray', alpha=0.5, label='Fuzzy Aggregation')
plt.plot([servo_result, servo_result], [0, servo_activation], 'k', linewidth=2, label='Defuzzification Centroid')
plt.title('Fuzzy Inference Servo Output')
plt.xlabel('Servo Angle (°)')
plt.ylabel('Activation')
plt.legend()
plt.grid(True)
plt.show()

print(f"Defuzzification result (final servo angle): {servo_result:.2f}°")