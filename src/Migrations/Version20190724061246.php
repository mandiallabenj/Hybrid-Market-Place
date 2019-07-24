<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190724061246 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collaborator (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, project_id INT DEFAULT NULL, github_url VARCHAR(255) NOT NULL, reason VARCHAR(255) NOT NULL, is_accepted VARCHAR(255) NOT NULL, INDEX IDX_606D487CA76ED395 (user_id), INDEX IDX_606D487C166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collaborator_projects (id INT AUTO_INCREMENT NOT NULL, collaborator_id INT DEFAULT NULL, INDEX IDX_7C293D2230098C8C (collaborator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donations (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, project_id INT DEFAULT NULL, amount INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_CDE98962A76ED395 (user_id), INDEX IDX_CDE98962166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE issues (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, project_id INT DEFAULT NULL, issue LONGTEXT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_DA7D7F83A76ED395 (user_id), INDEX IDX_DA7D7F83166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, published_at DATETIME NOT NULL, category VARCHAR(255) DEFAULT NULL, is_enterprise VARCHAR(255) DEFAULT NULL, isblocked VARCHAR(255) DEFAULT NULL, is_approved VARCHAR(255) DEFAULT NULL, price INT DEFAULT NULL, INDEX IDX_2FB3D0EEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projectfiles (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, project_id INT DEFAULT NULL, projectfile VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, version_name VARCHAR(255) DEFAULT NULL, features LONGTEXT DEFAULT NULL, INDEX IDX_6281F85AA76ED395 (user_id), INDEX IDX_6281F85A166D1F9C (project_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE screenshot (id INT AUTO_INCREMENT NOT NULL, project_id INT DEFAULT NULL, user_id INT DEFAULT NULL, screenshot VARCHAR(255) DEFAULT NULL, INDEX IDX_58991E41166D1F9C (project_id), INDEX IDX_58991E41A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, stripe_customer_id VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649708DC647 (stripe_customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collaborator ADD CONSTRAINT FK_606D487CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE collaborator ADD CONSTRAINT FK_606D487C166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE collaborator_projects ADD CONSTRAINT FK_7C293D2230098C8C FOREIGN KEY (collaborator_id) REFERENCES collaborator (id)');
        $this->addSql('ALTER TABLE donations ADD CONSTRAINT FK_CDE98962A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE donations ADD CONSTRAINT FK_CDE98962166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE issues ADD CONSTRAINT FK_DA7D7F83A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE issues ADD CONSTRAINT FK_DA7D7F83166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE projectfiles ADD CONSTRAINT FK_6281F85AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE projectfiles ADD CONSTRAINT FK_6281F85A166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE screenshot ADD CONSTRAINT FK_58991E41166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE screenshot ADD CONSTRAINT FK_58991E41A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE collaborator_projects DROP FOREIGN KEY FK_7C293D2230098C8C');
        $this->addSql('ALTER TABLE collaborator DROP FOREIGN KEY FK_606D487C166D1F9C');
        $this->addSql('ALTER TABLE donations DROP FOREIGN KEY FK_CDE98962166D1F9C');
        $this->addSql('ALTER TABLE issues DROP FOREIGN KEY FK_DA7D7F83166D1F9C');
        $this->addSql('ALTER TABLE projectfiles DROP FOREIGN KEY FK_6281F85A166D1F9C');
        $this->addSql('ALTER TABLE screenshot DROP FOREIGN KEY FK_58991E41166D1F9C');
        $this->addSql('ALTER TABLE collaborator DROP FOREIGN KEY FK_606D487CA76ED395');
        $this->addSql('ALTER TABLE donations DROP FOREIGN KEY FK_CDE98962A76ED395');
        $this->addSql('ALTER TABLE issues DROP FOREIGN KEY FK_DA7D7F83A76ED395');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEA76ED395');
        $this->addSql('ALTER TABLE projectfiles DROP FOREIGN KEY FK_6281F85AA76ED395');
        $this->addSql('ALTER TABLE screenshot DROP FOREIGN KEY FK_58991E41A76ED395');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE collaborator');
        $this->addSql('DROP TABLE collaborator_projects');
        $this->addSql('DROP TABLE donations');
        $this->addSql('DROP TABLE issues');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE projectfiles');
        $this->addSql('DROP TABLE screenshot');
        $this->addSql('DROP TABLE user');
    }
}
