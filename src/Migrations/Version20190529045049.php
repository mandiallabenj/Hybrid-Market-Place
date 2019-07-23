<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190529045049 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE collaborator_projects (id INT AUTO_INCREMENT NOT NULL, collaborator_id INT DEFAULT NULL, INDEX IDX_7C293D2230098C8C (collaborator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collaborator_projects ADD CONSTRAINT FK_7C293D2230098C8C FOREIGN KEY (collaborator_id) REFERENCES collaborator (id)');
        $this->addSql('ALTER TABLE collaborator ADD is_accepted VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE project ADD is_enterprise VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE collaborator_projects');
        $this->addSql('ALTER TABLE collaborator DROP is_accepted');
        $this->addSql('ALTER TABLE project DROP is_enterprise');
    }
}
