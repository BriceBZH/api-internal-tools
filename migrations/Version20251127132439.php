<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251127132439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usage_logs DROP FOREIGN KEY `FK_5B25D4479D86650F`');
        $this->addSql('DROP INDEX IDX_5B25D4479D86650F ON usage_logs');
        $this->addSql('ALTER TABLE usage_logs CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE usage_logs ADD CONSTRAINT FK_5B25D447A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_5B25D447A76ED395 ON usage_logs (user_id)');
        $this->addSql('ALTER TABLE user_tool_access DROP FOREIGN KEY `FK_CA23EEDD9D86650F`');
        $this->addSql('DROP INDEX IDX_CA23EEDD9D86650F ON user_tool_access');
        $this->addSql('ALTER TABLE user_tool_access CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_tool_access ADD CONSTRAINT FK_CA23EEDDA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_CA23EEDDA76ED395 ON user_tool_access (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usage_logs DROP FOREIGN KEY FK_5B25D447A76ED395');
        $this->addSql('DROP INDEX IDX_5B25D447A76ED395 ON usage_logs');
        $this->addSql('ALTER TABLE usage_logs CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE usage_logs ADD CONSTRAINT `FK_5B25D4479D86650F` FOREIGN KEY (user_id_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5B25D4479D86650F ON usage_logs (user_id_id)');
        $this->addSql('ALTER TABLE user_tool_access DROP FOREIGN KEY FK_CA23EEDDA76ED395');
        $this->addSql('DROP INDEX IDX_CA23EEDDA76ED395 ON user_tool_access');
        $this->addSql('ALTER TABLE user_tool_access CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_tool_access ADD CONSTRAINT `FK_CA23EEDD9D86650F` FOREIGN KEY (user_id_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_CA23EEDD9D86650F ON user_tool_access (user_id_id)');
    }
}
