<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190422164642 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE contributor_request (id INT AUTO_INCREMENT NOT NULL, relation_id INT NOT NULL, project_id INT NOT NULL, INDEX IDX_FE584F353256915B (relation_id), INDEX IDX_FE584F35166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donations (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, project_id INT DEFAULT NULL, amount INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_CDE98962A76ED395 (user_id), INDEX IDX_CDE98962166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE issues (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, project_id INT DEFAULT NULL, issue LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_DA7D7F83A76ED395 (user_id), INDEX IDX_DA7D7F83166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, published_at DATETIME NOT NULL, projectfile VARCHAR(255) DEFAULT NULL, INDEX IDX_2FB3D0EEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contributor_request ADD CONSTRAINT FK_FE584F353256915B FOREIGN KEY (relation_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE contributor_request ADD CONSTRAINT FK_FE584F35166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE donations ADD CONSTRAINT FK_CDE98962A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE donations ADD CONSTRAINT FK_CDE98962166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE issues ADD CONSTRAINT FK_DA7D7F83A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE issues ADD CONSTRAINT FK_DA7D7F83166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE contributor_request DROP FOREIGN KEY FK_FE584F35166D1F9C');
        $this->addSql('ALTER TABLE donations DROP FOREIGN KEY FK_CDE98962166D1F9C');
        $this->addSql('ALTER TABLE issues DROP FOREIGN KEY FK_DA7D7F83166D1F9C');
        $this->addSql('ALTER TABLE contributor_request DROP FOREIGN KEY FK_FE584F353256915B');
        $this->addSql('ALTER TABLE donations DROP FOREIGN KEY FK_CDE98962A76ED395');
        $this->addSql('ALTER TABLE issues DROP FOREIGN KEY FK_DA7D7F83A76ED395');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEA76ED395');
        $this->addSql('DROP TABLE contributor_request');
        $this->addSql('DROP TABLE donations');
        $this->addSql('DROP TABLE issues');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE user');
    }
}
