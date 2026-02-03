<?php
/**
 * Debug - Instalador com Diagnóstico Completo
 */

// Mostrar todos os erros
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'techflow_landing');

$debug = [];
$debug[] = "PHP está funcionando: SIM";
$debug[] = "REQUEST_METHOD: " . $_SERVER['REQUEST_METHOD'];
$debug[] = "POST data: " . print_r($_POST, true);

$installed = false;
$error = null;

// Verificar se é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $debug[] = "Formulário foi submetido via POST";

    if (isset($_POST['install'])) {
        $debug[] = "Botão 'install' foi clicado";

        try {
            // Tentar conectar
            $debug[] = "Tentando conectar ao MySQL...";
            $conn = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $debug[] = "✅ Conectado ao MySQL!";

            // Criar banco
            $debug[] = "Criando banco de dados...";
            $conn->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            $debug[] = "✅ Banco criado!";

            // Usar banco
            $conn->exec("USE " . DB_NAME);
            $debug[] = "✅ Usando banco " . DB_NAME;

            // Criar tabela
            $debug[] = "Criando tabela contacts...";
            $sql = "CREATE TABLE IF NOT EXISTS contacts (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                phone VARCHAR(20) NOT NULL,
                message TEXT NOT NULL,
                status ENUM('new', 'contacted', 'converted', 'archived') DEFAULT 'new',
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
                INDEX idx_email (email),
                INDEX idx_created_at (created_at)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

            $conn->exec($sql);
            $debug[] = "✅ Tabela criada!";

            // Inserir dados de exemplo
            $debug[] = "Inserindo dados de exemplo...";
            $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, message, status) VALUES (?, ?, ?, ?, ?)");

            $samples = [
                ['João Silva', 'joao.silva@example.com', '(48) 99999-8888', 'Teste 1', 'new'],
                ['Maria Santos', 'maria.santos@example.com', '(11) 98888-7777', 'Teste 2', 'contacted'],
            ];

            foreach ($samples as $data) {
                $stmt->execute($data);
            }
            $debug[] = "✅ Dados inseridos!";

            $installed = true;

        } catch(PDOException $e) {
            $error = $e->getMessage();
            $debug[] = "❌ ERRO: " . $error;
        }
    } else {
        $debug[] = "⚠️ Botão 'install' NÃO foi encontrado no POST";
    }
} else {
    $debug[] = "Aguardando submissão do formulário...";
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug - Instalador</title>
    <style>
        body {
            font-family: monospace;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #1e1e1e;
            color: #d4d4d4;
        }
        h1 {
            color: #4ec9b0;
        }
        .debug {
            background: #252526;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 3px solid #007acc;
        }
        .debug-item {
            padding: 5px 0;
            border-bottom: 1px solid #333;
        }
        .success {
            background: #1a3e1a;
            border-left-color: #4ec9b0;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .error {
            background: #3e1a1a;
            border-left: 3px solid #f44747;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        button {
            background: #007acc;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 3px;
            font-size: 16px;
            cursor: pointer;
            font-family: monospace;
        }
        button:hover {
            background: #005a9e;
        }
        .form-box {
            background: #252526;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        a {
            color: #4ec9b0;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>🔍 Debug - Instalador MySQL</h1>

    <div class="debug">
        <strong>Log de Execução:</strong>
        <?php foreach ($debug as $item): ?>
            <div class="debug-item"><?php echo htmlspecialchars($item); ?></div>
        <?php endforeach; ?>
    </div>

    <?php if ($installed): ?>
        <div class="success">
            <h2>✅ SUCESSO!</h2>
            <p>Banco de dados instalado com sucesso!</p>
            <p><a href="index.php">→ Acessar Landing Page</a></p>
            <p><a href="test-mysql.php">→ Verificar Instalação</a></p>
        </div>
    <?php elseif ($error): ?>
        <div class="error">
            <h2>❌ ERRO</h2>
            <p><?php echo htmlspecialchars($error); ?></p>
        </div>
    <?php endif; ?>

    <?php if (!$installed): ?>
        <div class="form-box">
            <form method="POST" action="">
                <p>Clique no botão abaixo para instalar o banco de dados:</p>
                <button type="submit" name="install" value="1">
                    🚀 INSTALAR BANCO DE DADOS
                </button>
            </form>
        </div>
    <?php endif; ?>

    <div class="debug">
        <strong>Informações do Sistema:</strong>
        <div class="debug-item">PHP Version: <?php echo phpversion(); ?></div>
        <div class="debug-item">PDO MySQL: <?php echo extension_loaded('pdo_mysql') ? 'Instalado' : 'NÃO instalado'; ?></div>
        <div class="debug-item">Timestamp: <?php echo date('Y-m-d H:i:s'); ?></div>
    </div>
</body>
</html>
