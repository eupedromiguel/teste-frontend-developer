<?php

define('DB_HOST', 'localhost');        
define('DB_NAME', 'techflow_landing'); 
define('DB_USER', 'root');             
define('DB_PASS', '');                 
define('DB_CHARSET', 'utf8mb4');       

/**
 * Criar conexão com banco de dados
 *
 * @return PDO|null Conexão com banco de dados ou null em caso de falha
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
        error_log("Falha na conexão com banco de dados: " . $e->getMessage());
        return null;
    }
}

/**
 * Testar conexão com banco de dados
 *
 * @return bool True se conexão bem-sucedida, false caso contrário
 */
function testDatabaseConnection() {
    $pdo = getDatabaseConnection();
    return $pdo !== null;
}
