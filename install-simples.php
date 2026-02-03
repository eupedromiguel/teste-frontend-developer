<?php
/**
 * Instalador Simples - Sem JavaScript
 * Versão simplificada para diagnóstico
 */

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'techflow_landing');

$message = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['install'])) {
    try {
        // Conectar ao MySQL
        $conn = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Criar banco
        $conn->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

        // Usar banco
        $conn->exec("USE " . DB_NAME);

        // Criar tabela
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

        // Adicionar dados de exemplo
        if (isset($_POST['sample_data'])) {
            $samples = [
                ['João Silva', 'joao.silva@example.com', '(48) 99999-8888', 'Gostaria de saber mais sobre consultoria.', 'new'],
                ['Maria Santos', 'maria.santos@example.com', '(11) 98888-7777', 'Preciso de ajuda com transformação digital.', 'contacted'],
                ['Pedro Oliveira', 'pedro.oliveira@example.com', '(21) 97777-6666', 'Interessado em projeto piloto.', 'new'],
                ['Ana Costa', 'ana.costa@example.com', '(47) 96666-5555', 'Quero modernizar sistemas.', 'new']
            ];

            $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, message, status) VALUES (?, ?, ?, ?, ?)");
            foreach ($samples as $data) {
                $stmt->execute($data);
            }
        }

        $success = true;
        $message = "Banco de dados instalado com sucesso!";

    } catch(PDOException $e) {
        $message = "ERRO: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalador Simples</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2563eb;
            margin-bottom: 20px;
        }
        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 15px 0;
            font-size: 16px;
        }
        input[type="checkbox"] {
            margin-right: 10px;
        }
        button {
            background: #2563eb;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }
        button:hover {
            background: #1e40af;
        }
        .btn-secondary {
            background: #64748b;
            margin-top: 10px;
        }
        .btn-secondary:hover {
            background: #475569;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>⚡ Instalador Simples</h1>

        <?php if ($message): ?>
            <div class="<?php echo $success ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <p><strong>✅ Instalação concluída!</strong></p>
            <p>O banco de dados foi criado com sucesso.</p>
            <a href="index.php"><button>🚀 Acessar Landing Page</button></a>
            <a href="test-mysql.php"><button class="btn-secondary">🔍 Verificar Instalação</button></a>
        <?php else: ?>
            <p>Esta é uma versão simplificada do instalador para diagnóstico.</p>

            <form method="POST">
                <label>
                    <input type="checkbox" name="sample_data" checked>
                    Adicionar 4 contatos de exemplo
                </label>

                <button type="submit" name="install">
                    🚀 Instalar Agora
                </button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>
