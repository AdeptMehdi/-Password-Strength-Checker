<?php

// Load application configuration
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../app/models/PasswordModel.php';

// Debug info
if (DEBUG_MODE) {
    error_log('Request method: ' . $_SERVER['REQUEST_METHOD']);
    error_log('POST data: ' . print_r($_POST, true));
}

// Process request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    $password = trim($_POST['password']);
    
    $model = new PasswordModel($password);
    
    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode([
        'strength' => $model->getStrength(),
        'label' => $model->getStrengthLabel(),
        'color' => $model->getStrengthColor(),
        'feedback' => $model->getFeedback()
    ]);
    exit;
} else {
    // Return error if not a POST request
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Invalid request method or missing password parameter']);
    exit;
} 