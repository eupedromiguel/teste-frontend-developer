-- =============================================
-- TechFlow Solutions - Configuração Rápida
-- Execute este arquivo no phpMyAdmin
-- =============================================

-- Criar banco de dados
CREATE DATABASE IF NOT EXISTS techflow_landing
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- Usar o banco
USE techflow_landing;

-- Criar tabela de contatos
CREATE TABLE IF NOT EXISTS contacts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL COMMENT 'Nome completo',
    email VARCHAR(100) NOT NULL COMMENT 'E-mail',
    phone VARCHAR(20) NOT NULL COMMENT 'Telefone',
    message TEXT NOT NULL COMMENT 'Mensagem',
    status ENUM('new', 'contacted', 'converted', 'archived') DEFAULT 'new',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Mensagem de sucesso
SELECT 'Banco de dados configurado com sucesso!' AS mensagem;
