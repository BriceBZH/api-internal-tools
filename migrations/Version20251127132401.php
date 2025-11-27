<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251127132401 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE access_requests DROP FOREIGN KEY `FK_169017609D86650F`');
        $this->addSql('DROP INDEX IDX_169017609D86650F ON access_requests');
        $this->addSql('ALTER TABLE access_requests CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE access_requests ADD CONSTRAINT FK_16901760A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_16901760A76ED395 ON access_requests (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE access_requests DROP FOREIGN KEY FK_16901760A76ED395');
        $this->addSql('DROP INDEX IDX_16901760A76ED395 ON access_requests');
        $this->addSql('ALTER TABLE access_requests CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE access_requests ADD CONSTRAINT `FK_169017609D86650F` FOREIGN KEY (user_id_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_169017609D86650F ON access_requests (user_id_id)');
    }
}
