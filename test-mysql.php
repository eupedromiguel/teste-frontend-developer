<?php
/**
 * Teste de Conexão MySQL
 * Este arquivo testa a conexão com o MySQL
 */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste MySQL - TechFlow</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #2563eb 0%, #0ea5e9 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            margin: 0;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            color: #1e293b;
            margin-bottom: 30px;
        }
        .test-item {
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            border-left: 4px solid #64748b;
        }
        .success {
            background: #d1fae5;
            border-left-color: #10b981;
            color: #065f46;
        }
        .error {
            background: #fee2e2;
            border-left-color: #dc2626;
            color: #991b1b;
        }
        .info {
            background: #dbeafe;
            border-left-color: #3b82f6;
            color: #1e40af;
        }
        code {
            background: #f1f5f9;
            padding: 2px 8px;
            border-radius: 4px;
            font-family: monospace;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #2563eb 0%, #0ea5e9 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 20px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Teste de Conexão MySQL</h1>

        <?php
        echo '<div class="test-item info">';
        echo '<strong>PHP Version:</strong> ' . phpversion();
        echo '</div>';

        // Teste 1: Extensão PDO
        if (extension_loaded('pdo_mysql')) {
            echo '<div class="test-item success">';
            echo '✅ Extensão PDO MySQL está instalada';
            echo '</div>';
        } else {
            echo '<div class="test-item error">';
            echo '❌ Extensão PDO MySQL NÃO está instalada';
            echo '</div>';
            exit;
        }

        // Teste 2: Conexão com MySQL
        try {
            $conn = new PDO("mysql:host=localhost", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            echo '<div class="test-item success">';
            echo '✅ Conectado ao MySQL com sucesso!';
            echo '</div>';

            // Teste 3: Listar bancos de dados
            $stmt = $conn->query("SHOW DATABASES");
            $databases = $stmt->fetchAll(PDO::FETCH_COLUMN);

            echo '<div class="test-item success">';
            echo '✅ Total de bancos de dados: ' . count($databases);
            echo '</div>';

            // Verificar se o banco techflow_landing existe
            if (in_array('techflow_landing', $databases)) {
                echo '<div class="test-item success">';
                echo '✅ Banco de dados <code>techflow_landing</code> JÁ EXISTE!';
                echo '</div>';

                // Conectar ao banco e contar registros
                $conn->exec("USE techflow_landing");
                $result = $conn->query("SELECT COUNT(*) as total FROM contacts");
                $row = $result->fetch(PDO::FETCH_ASSOC);

                echo '<div class="test-item success">';
                echo '✅ Total de contatos: ' . $row['total'];
                echo '</div>';

                echo '<div class="test-item info">';
                echo '<strong>📌 O banco já está instalado!</strong><br>';
                echo 'Você pode acessar a landing page diretamente.';
                echo '</div>';
            } else {
                echo '<div class="test-item info">';
                echo '⚠️ Banco de dados <code>techflow_landing</code> ainda não existe.';
                echo '</div>';

                echo '<div class="test-item info">';
                echo '<strong>📌 Próximo passo:</strong><br>';
                echo 'Use o instalador para criar o banco de dados.';
                echo '</div>';
            }

            echo '<a href="install.php" class="btn">🚀 Ir para o Instalador</a> ';
            echo '<a href="index.php" class="btn">📄 Ir para Landing Page</a>';

        } catch(PDOException $e) {
            echo '<div class="test-item error">';
            echo '❌ Erro ao conectar com MySQL:<br>';
            echo '<code>' . htmlspecialchars($e->getMessage()) . '</code>';
            echo '</div>';

            echo '<div class="test-item info">';
            echo '<strong>Possíveis soluções:</strong><br>';
            echo '1. Verifique se o MySQL está rodando no WAMP<br>';
            echo '2. Clique no ícone do WAMP → MySQL → Service → Start/Resume<br>';
            echo '3. Reinicie o WAMP';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>
