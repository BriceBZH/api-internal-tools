<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251127131950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE access_requests (id INT AUTO_INCREMENT NOT NULL, business_justification LONGTEXT NOT NULL, status VARCHAR(255) DEFAULT NULL, requested_at DATETIME DEFAULT NULL, processed_at DATETIME DEFAULT NULL, processing_notes LONGTEXT DEFAULT NULL, user_id_id INT NOT NULL, tool_id INT NOT NULL, processed_by_id INT DEFAULT NULL, INDEX IDX_169017609D86650F (user_id_id), INDEX IDX_169017608F7B22CC (tool_id), INDEX IDX_169017602FFD4FD3 (processed_by_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, color_hex VARCHAR(7) DEFAULT NULL, created_at DATETIME DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE cost_tracking (id INT AUTO_INCREMENT NOT NULL, month_year DATETIME NOT NULL, total_monthly_cost NUMERIC(10, 2) NOT NULL, active_users_count INT NOT NULL, created_at DATETIME DEFAULT NULL, tool_id INT NOT NULL, INDEX IDX_1E5C21A98F7B22CC (tool_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE tools (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, vendor VARCHAR(100) DEFAULT NULL, website_url VARCHAR(255) DEFAULT NULL, monthly_cost NUMERIC(10, 2) NOT NULL, active_users_count INT NOT NULL, owner_department VARCHAR(255) NOT NULL, status VARCHAR(255) DEFAULT NULL, createad_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, category_id INT NOT NULL, INDEX IDX_EAFADE7712469DE2 (category_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE usage_logs (id INT AUTO_INCREMENT NOT NULL, session_date DATETIME NOT NULL, usage_minutes INT DEFAULT NULL, actions_count INT DEFAULT NULL, created_at DATETIME DEFAULT NULL, user_id_id INT NOT NULL, tool_id INT NOT NULL, INDEX IDX_5B25D4479D86650F (user_id_id), INDEX IDX_5B25D4478F7B22CC (tool_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE user_tool_access (id INT AUTO_INCREMENT NOT NULL, granted_at DATETIME DEFAULT NULL, revoked_at DATETIME DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, user_id_id INT NOT NULL, tool_id INT NOT NULL, granted_by_id INT NOT NULL, revoked_by_id INT DEFAULT NULL, INDEX IDX_CA23EEDD9D86650F (user_id_id), INDEX IDX_CA23EEDD8F7B22CC (tool_id), INDEX IDX_CA23EEDD3151C11F (granted_by_id), INDEX IDX_CA23EEDDFB8FE773 (revoked_by_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(150) NOT NULL, department VARCHAR(255) NOT NULL, role VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, hire_date DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE access_requests ADD CONSTRAINT FK_169017609D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE access_requests ADD CONSTRAINT FK_169017608F7B22CC FOREIGN KEY (tool_id) REFERENCES tools (id)');
        $this->addSql('ALTER TABLE access_requests ADD CONSTRAINT FK_169017602FFD4FD3 FOREIGN KEY (processed_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE cost_tracking ADD CONSTRAINT FK_1E5C21A98F7B22CC FOREIGN KEY (tool_id) REFERENCES tools (id)');
        $this->addSql('ALTER TABLE tools ADD CONSTRAINT FK_EAFADE7712469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE usage_logs ADD CONSTRAINT FK_5B25D4479D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE usage_logs ADD CONSTRAINT FK_5B25D4478F7B22CC FOREIGN KEY (tool_id) REFERENCES tools (id)');
        $this->addSql('ALTER TABLE user_tool_access ADD CONSTRAINT FK_CA23EEDD9D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_tool_access ADD CONSTRAINT FK_CA23EEDD8F7B22CC FOREIGN KEY (tool_id) REFERENCES tools (id)');
        $this->addSql('ALTER TABLE user_tool_access ADD CONSTRAINT FK_CA23EEDD3151C11F FOREIGN KEY (granted_by_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_tool_access ADD CONSTRAINT FK_CA23EEDDFB8FE773 FOREIGN KEY (revoked_by_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE access_requests DROP FOREIGN KEY FK_169017609D86650F');
        $this->addSql('ALTER TABLE access_requests DROP FOREIGN KEY FK_169017608F7B22CC');
        $this->addSql('ALTER TABLE access_requests DROP FOREIGN KEY FK_169017602FFD4FD3');
        $this->addSql('ALTER TABLE cost_tracking DROP FOREIGN KEY FK_1E5C21A98F7B22CC');
        $this->addSql('ALTER TABLE tools DROP FOREIGN KEY FK_EAFADE7712469DE2');
        $this->addSql('ALTER TABLE usage_logs DROP FOREIGN KEY FK_5B25D4479D86650F');
        $this->addSql('ALTER TABLE usage_logs DROP FOREIGN KEY FK_5B25D4478F7B22CC');
        $this->addSql('ALTER TABLE user_tool_access DROP FOREIGN KEY FK_CA23EEDD9D86650F');
        $this->addSql('ALTER TABLE user_tool_access DROP FOREIGN KEY FK_CA23EEDD8F7B22CC');
        $this->addSql('ALTER TABLE user_tool_access DROP FOREIGN KEY FK_CA23EEDD3151C11F');
        $this->addSql('ALTER TABLE user_tool_access DROP FOREIGN KEY FK_CA23EEDDFB8FE773');
        $this->addSql('DROP TABLE access_requests');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE cost_tracking');
        $this->addSql('DROP TABLE tools');
        $this->addSql('DROP TABLE usage_logs');
        $this->addSql('DROP TABLE user_tool_access');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
