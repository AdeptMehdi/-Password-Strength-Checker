<?php

// Application settings
define('APP_NAME', 'بررسی قدرت رمز عبور');
define('APP_URL', '/password-checker/public/');
define('DEBUG_MODE', true);

// Display errors for development
if (DEBUG_MODE) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} 