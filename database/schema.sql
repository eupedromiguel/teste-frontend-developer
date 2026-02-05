-- =============================================
-- TechFlow Solutions - Landing Page
-- Esquema do Banco de Dados
-- =============================================
--
-- Este arquivo contém a estrutura do banco de dados para a landing page.
-- Execute este script para criar o banco de dados e as tabelas.
--
-- Versão: 1.0
-- Data: 2026-02-03
-- =============================================

-- Criar banco de dados se não existir
CREATE DATABASE IF NOT EXISTS techflow_landing
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- Usar o banco de dados
USE techflow_landing;

-- =============================================
-- Tabela: contacts
-- Descrição: Armazena envios do formulário de contato
-- =============================================

-- Remover tabela se existir (para instalação limpa)
DROP TABLE IF EXISTS contacts;

-- Criar tabela contacts
CREATE TABLE contacts (
    -- Chave primária
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    -- Informações de contato
    name VARCHAR(100) NOT NULL COMMENT 'Nome completo do contato',
    email VARCHAR(100) NOT NULL COMMENT 'Endereço de e-mail do contato',
    phone VARCHAR(20) NOT NULL COMMENT 'Número de telefone do contato',
    message TEXT NOT NULL COMMENT 'Mensagem do contato',

    -- Status e metadados
    status ENUM('new', 'contacted', 'converted', 'archived') DEFAULT 'new' COMMENT 'Status do lead',
    ip_address VARCHAR(45) NULL COMMENT 'Endereço IP do remetente',
    user_agent VARCHAR(255) NULL COMMENT 'User agent do navegador',

    -- Timestamps
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Timestamp de criação do registro',
    updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Timestamp da última atualização do registro',

    -- Índices para melhor desempenho
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Envios do formulário de contato';

-- =============================================
-- Inserir dados de exemplo (opcional - para testes)
-- =============================================

-- Descomente as linhas abaixo para inserir dados de exemplo para testes

-- INSERT INTO contacts (name, email, phone, message, status, created_at) VALUES
-- ('João Silva', 'joao.silva@example.com', '(48) 99999-8888', 'Gostaria de saber mais sobre os serviços de consultoria.', 'new', NOW()),
-- ('Maria Santos', 'maria.santos@example.com', '(11) 98888-7777', 'Preciso de ajuda para implementar transformação digital na minha empresa.', 'contacted', NOW() - INTERVAL 1 DAY),
-- ('Pedro Oliveira', 'pedro.oliveira@example.com', '(21) 97777-6666', 'Interessado em um projeto piloto de otimização de processos.', 'new', NOW() - INTERVAL 2 DAY);

-- =============================================
-- Views (opcional - para relatórios)
-- =============================================

-- View para contatos recentes (últimos 30 dias)
CREATE OR REPLACE VIEW recent_contacts AS
SELECT
    id,
    name,
    email,
    phone,
    LEFT(message, 100) AS message_preview,
    status,
    created_at
FROM contacts
WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)
ORDER BY created_at DESC;

-- View para estatísticas de contato por status
CREATE OR REPLACE VIEW contact_stats AS
SELECT
    status,
    COUNT(*) AS total,
    DATE(created_at) AS submission_date
FROM contacts
GROUP BY status, DATE(created_at)
ORDER BY submission_date DESC, status;

-- =============================================
-- Stored Procedures (opcional - para operações comuns)
-- =============================================

-- Procedimento para atualizar status do contato
DELIMITER //

CREATE PROCEDURE update_contact_status(
    IN contact_id INT UNSIGNED,
    IN new_status VARCHAR(20)
)
BEGIN
    UPDATE contacts
    SET status = new_status,
        updated_at = NOW()
    WHERE id = contact_id;
END //

DELIMITER ;

-- =============================================
-- Triggers (opcional - para trilha de auditoria)
-- =============================================

-- Trigger para registrar mudanças de status (se necessário)
-- Isso pode ser expandido para criar uma tabela de auditoria

-- =============================================
-- Grants (opcional - criar usuário dedicado)
-- =============================================

-- Descomente e modifique as linhas abaixo para criar um usuário dedicado ao banco de dados
-- Isso é recomendado para ambientes de produção

-- CREATE USER IF NOT EXISTS 'techflow_user'@'localhost' IDENTIFIED BY 'your_secure_password_here';
-- GRANT SELECT, INSERT, UPDATE ON techflow_landing.* TO 'techflow_user'@'localhost';
-- FLUSH PRIVILEGES;

-- =============================================
-- Queries de verificação
-- =============================================

-- Mostrar todas as tabelas
-- SHOW TABLES;

-- Descrever estrutura da tabela contacts
-- DESCRIBE contacts;

-- Contar total de contatos
-- SELECT COUNT(*) AS total_contacts FROM contacts;

-- =============================================
-- Queries de limpeza (usar com cautela)
-- =============================================

-- Deletar todos os contatos (usar apenas para testes)
-- DELETE FROM contacts;

-- Resetar contador de auto-incremento
-- ALTER TABLE contacts AUTO_INCREMENT = 1;

-- =============================================
-- Fim do esquema
-- =============================================

-- Exibir mensagem de sucesso
SELECT 'Esquema do banco de dados criado com sucesso!' AS message;
