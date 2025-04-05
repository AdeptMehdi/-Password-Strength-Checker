<?php

// Load application configuration
require_once __DIR__ . '/../config/config.php';

// Autoload controllers
require_once __DIR__ . '/../app/controllers/PasswordController.php';

// Simple router
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Initialize controller
$controller = new PasswordController();

// Debug info if needed
if (DEBUG_MODE && isset($_POST)) {
    error_log('POST data: ' . print_r($_POST, true));
}

// Route to appropriate method
switch ($action) {
    case 'check-password':
        $controller->checkPassword();
        break;
    case 'index':
    default:
        // Set content for layout
        $content = __DIR__ . '/../app/views/password-checker.php';
        // Render layout with content
        include __DIR__ . '/../app/views/layout.php';
        break;
} 