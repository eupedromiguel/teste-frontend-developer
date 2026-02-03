<?php
/**
 * Database Configuration
 * TechFlow Solutions - Landing Page
 *
 * This file contains database connection settings.
 * Update these values according to your environment.
 */

// Database configuration constants
define('DB_HOST', 'localhost');        // Database host
define('DB_NAME', 'techflow_landing'); // Database name
define('DB_USER', 'root');             // Database username
define('DB_PASS', '');                 // Database password
define('DB_CHARSET', 'utf8mb4');       // Database charset

/**
 * Create database connection
 *
 * @return PDO|null Database connection or null on failure
 */
function getDatabaseConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

        return $pdo;
    } catch (PDOException $e) {
        error_log("Database connection failed: " . $e->getMessage());
        return null;
    }
}

/**
 * Test database connection
 *
 * @return bool True if connection successful, false otherwise
 */
function testDatabaseConnection() {
    $pdo = getDatabaseConnection();
    return $pdo !== null;
}
