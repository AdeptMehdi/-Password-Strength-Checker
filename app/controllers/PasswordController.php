<?php

require_once __DIR__ . '/../models/PasswordModel.php';

class PasswordController {
    private $model;
    
    public function __construct() {
        $this->model = new PasswordModel();
    }
    
    public function index() {
        // Default view for the password checker
        include __DIR__ . '/../views/password-checker.php';
    }
    
    public function checkPassword() {
        // Process AJAX request
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
            $password = trim($_POST['password']);
            
            $this->model->setPassword($password);
            
            // Return JSON response
            header('Content-Type: application/json');
            echo json_encode([
                'strength' => $this->model->getStrength(),
                'label' => $this->model->getStrengthLabel(),
                'color' => $this->model->getStrengthColor(),
                'feedback' => $this->model->getFeedback()
            ]);
            exit;
        }
        
        // Redirect to index if not a POST request
        header('Location: /');
        exit;
    }
} 