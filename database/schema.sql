-- =============================================
-- TechFlow Solutions - Landing Page
-- Database Schema
-- =============================================
--
-- This file contains the database structure for the landing page.
-- Execute this script to create the database and tables.
--
-- Version: 1.0
-- Date: 2026-02-03
-- =============================================

-- Create database if it doesn't exist
CREATE DATABASE IF NOT EXISTS techflow_landing
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- Use the database
USE techflow_landing;

-- =============================================
-- Table: contacts
-- Description: Stores contact form submissions
-- =============================================

-- Drop table if exists (for fresh installation)
DROP TABLE IF EXISTS contacts;

-- Create contacts table
CREATE TABLE contacts (
    -- Primary key
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    -- Contact information
    name VARCHAR(100) NOT NULL COMMENT 'Contact full name',
    email VARCHAR(100) NOT NULL COMMENT 'Contact email address',
    phone VARCHAR(20) NOT NULL COMMENT 'Contact phone number',
    message TEXT NOT NULL COMMENT 'Contact message',

    -- Status and metadata
    status ENUM('new', 'contacted', 'converted', 'archived') DEFAULT 'new' COMMENT 'Lead status',
    ip_address VARCHAR(45) NULL COMMENT 'IP address of the submitter',
    user_agent VARCHAR(255) NULL COMMENT 'Browser user agent',

    -- Timestamps
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Record creation timestamp',
    updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Record last update timestamp',

    -- Indexes for better performance
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Contact form submissions';

-- =============================================
-- Insert sample data (optional - for testing)
-- =============================================

-- Uncomment the lines below to insert sample data for testing

-- INSERT INTO contacts (name, email, phone, message, status, created_at) VALUES
-- ('João Silva', 'joao.silva@example.com', '(48) 99999-8888', 'Gostaria de saber mais sobre os serviços de consultoria.', 'new', NOW()),
-- ('Maria Santos', 'maria.santos@example.com', '(11) 98888-7777', 'Preciso de ajuda para implementar transformação digital na minha empresa.', 'contacted', NOW() - INTERVAL 1 DAY),
-- ('Pedro Oliveira', 'pedro.oliveira@example.com', '(21) 97777-6666', 'Interessado em um projeto piloto de otimização de processos.', 'new', NOW() - INTERVAL 2 DAY);

-- =============================================
-- Views (optional - for reporting)
-- =============================================

-- View for recent contacts (last 30 days)
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

-- View for contact statistics by status
CREATE OR REPLACE VIEW contact_stats AS
SELECT
    status,
    COUNT(*) AS total,
    DATE(created_at) AS submission_date
FROM contacts
GROUP BY status, DATE(created_at)
ORDER BY submission_date DESC, status;

-- =============================================
-- Stored Procedures (optional - for common operations)
-- =============================================

-- Procedure to update contact status
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
-- Triggers (optional - for audit trail)
-- =============================================

-- Trigger to log status changes (if needed)
-- This can be expanded to create an audit table

-- =============================================
-- Grants (optional - create dedicated user)
-- =============================================

-- Uncomment and modify the lines below to create a dedicated database user
-- This is recommended for production environments

-- CREATE USER IF NOT EXISTS 'techflow_user'@'localhost' IDENTIFIED BY 'your_secure_password_here';
-- GRANT SELECT, INSERT, UPDATE ON techflow_landing.* TO 'techflow_user'@'localhost';
-- FLUSH PRIVILEGES;

-- =============================================
-- Verification queries
-- =============================================

-- Show all tables
-- SHOW TABLES;

-- Describe contacts table structure
-- DESCRIBE contacts;

-- Count total contacts
-- SELECT COUNT(*) AS total_contacts FROM contacts;

-- =============================================
-- Cleanup queries (use with caution)
-- =============================================

-- Delete all contacts (use for testing only)
-- DELETE FROM contacts;

-- Reset auto-increment counter
-- ALTER TABLE contacts AUTO_INCREMENT = 1;

-- =============================================
-- End of schema
-- =============================================

-- Display success message
SELECT 'Database schema created successfully!' AS message;
