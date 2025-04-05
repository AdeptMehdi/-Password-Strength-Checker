<?php
// Standalone test file for password strength checker

// Include the PasswordModel
require_once __DIR__ . '/../app/models/PasswordModel.php';

// Test password
$testPassword = "Test123!";

// Create model instance
$model = new PasswordModel($testPassword);

// Output results for debugging
echo "<h1>Password Strength Test</h1>";
echo "<p>Password: " . htmlspecialchars($testPassword) . "</p>";
echo "<p>Strength: " . $model->getStrength() . "</p>";
echo "<p>Label: " . $model->getStrengthLabel() . "</p>";
echo "<p>Color: " . $model->getStrengthColor() . "</p>";
echo "<h2>Feedback:</h2>";
echo "<ul>";
foreach ($model->getFeedback() as $feedback) {
    echo "<li>" . htmlspecialchars($feedback) . "</li>";
}
echo "</ul>";

// Output raw JSON for AJAX testing
echo "<h2>JSON Response (for AJAX testing):</h2>";
echo "<pre>";
echo htmlspecialchars(json_encode([
    'strength' => $model->getStrength(),
    'label' => $model->getStrengthLabel(),
    'color' => $model->getStrengthColor(),
    'feedback' => $model->getFeedback()
]));
echo "</pre>"; 