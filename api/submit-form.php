<?php
/**
 * Form Submission API
 * TechFlow Solutions - Landing Page
 *
 * This file handles the contact form submission.
 * It validates input, sanitizes data, and stores it in the database.
 */

// Set response headers
header('Content-Type: application/json; charset=utf-8');

// Enable error reporting for development (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Include database configuration
require_once __DIR__ . '/../config/database.php';

/**
 * Send JSON response
 *
 * @param bool $success Success status
 * @param string $message Response message
 * @param array $data Additional data (optional)
 * @return void
 */
function sendResponse($success, $message, $data = []) {
    http_response_code($success ? 200 : 400);

    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ], JSON_UNESCAPED_UNICODE);

    exit;
}

/**
 * Validate email format
 *
 * @param string $email Email address
 * @return bool True if valid, false otherwise
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Validate phone format (Brazilian format)
 *
 * @param string $phone Phone number
 * @return bool True if valid, false otherwise
 */
function validatePhone($phone) {
    // Remove all non-numeric characters
    $phoneNumbers = preg_replace('/\D/', '', $phone);

    // Check if phone has 10 or 11 digits (Brazilian format)
    return strlen($phoneNumbers) >= 10 && strlen($phoneNumbers) <= 11;
}

/**
 * Sanitize input data
 *
 * @param string $data Input data
 * @return string Sanitized data
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendResponse(false, 'Método de requisição inválido.');
}

// Get and sanitize form data
$name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
$email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
$phone = isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : '';
$message = isset($_POST['message']) ? sanitizeInput($_POST['message']) : '';

// Validation errors array
$errors = [];

// Validate name
if (empty($name)) {
    $errors[] = 'Nome é obrigatório.';
} elseif (strlen($name) < 3) {
    $errors[] = 'Nome deve ter pelo menos 3 caracteres.';
} elseif (strlen($name) > 100) {
    $errors[] = 'Nome deve ter no máximo 100 caracteres.';
}

// Validate email
if (empty($email)) {
    $errors[] = 'E-mail é obrigatório.';
} elseif (!validateEmail($email)) {
    $errors[] = 'E-mail inválido.';
} elseif (strlen($email) > 100) {
    $errors[] = 'E-mail deve ter no máximo 100 caracteres.';
}

// Validate phone
if (empty($phone)) {
    $errors[] = 'Telefone é obrigatório.';
} elseif (!validatePhone($phone)) {
    $errors[] = 'Telefone inválido. Use o formato: (XX) XXXXX-XXXX';
}

// Validate message
if (empty($message)) {
    $errors[] = 'Mensagem é obrigatória.';
} elseif (strlen($message) < 10) {
    $errors[] = 'Mensagem deve ter pelo menos 10 caracteres.';
} elseif (strlen($message) > 1000) {
    $errors[] = 'Mensagem deve ter no máximo 1000 caracteres.';
}

// If there are validation errors, send error response
if (!empty($errors)) {
    sendResponse(false, implode(' ', $errors));
}

// Get database connection
$pdo = getDatabaseConnection();

if ($pdo === null) {
    error_log("Failed to connect to database");
    sendResponse(false, 'Erro ao conectar com o banco de dados. Tente novamente mais tarde.');
}

try {
    // Prepare SQL statement
    $sql = "INSERT INTO contacts (name, email, phone, message, created_at)
            VALUES (:name, :email, :phone, :message, NOW())";

    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);

    // Execute statement
    $stmt->execute();

    // Get inserted ID
    $insertedId = $pdo->lastInsertId();

    // Log success
    error_log("Contact form submitted successfully - ID: {$insertedId}");

    // Send success response
    sendResponse(true, 'Mensagem enviada com sucesso! Entraremos em contato em breve.', [
        'id' => $insertedId
    ]);

} catch (PDOException $e) {
    // Log error
    error_log("Database error: " . $e->getMessage());

    // Send error response
    sendResponse(false, 'Erro ao salvar os dados. Tente novamente mais tarde.');
}
