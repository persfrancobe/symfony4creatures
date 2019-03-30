<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190329162009 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE creatures (id INT AUTO_INCREMENT NOT NULL, film_id INT DEFAULT NULL, nom VARCHAR(45) NOT NULL, texte_lead LONGTEXT NOT NULL, texte_suite LONGTEXT NOT NULL, date_creation DATETIME NOT NULL, image VARCHAR(45) DEFAULT NULL, slug VARCHAR(45) NOT NULL, INDEX IDX_A1F49564567F5183 (film_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE creatures_tags (creatures_id INT NOT NULL, tags_id INT NOT NULL, INDEX IDX_D16472829F79EE37 (creatures_id), INDEX IDX_D16472828D7B4FB4 (tags_id), PRIMARY KEY(creatures_id, tags_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE films (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(45) NOT NULL, synopsis LONGTEXT NOT NULL, slug VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pages (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(45) NOT NULL, slug VARCHAR(45) NOT NULL, type VARCHAR(45) NOT NULL, texte LONGTEXT NOT NULL, tri INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tags (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(45) NOT NULL, slug VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE creatures ADD CONSTRAINT FK_A1F49564567F5183 FOREIGN KEY (film_id) REFERENCES films (id)');
        $this->addSql('ALTER TABLE creatures_tags ADD CONSTRAINT FK_D16472829F79EE37 FOREIGN KEY (creatures_id) REFERENCES creatures (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE creatures_tags ADD CONSTRAINT FK_D16472828D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tags (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE creatures_tags DROP FOREIGN KEY FK_D16472829F79EE37');
        $this->addSql('ALTER TABLE creatures DROP FOREIGN KEY FK_A1F49564567F5183');
        $this->addSql('ALTER TABLE creatures_tags DROP FOREIGN KEY FK_D16472828D7B4FB4');
        $this->addSql('DROP TABLE creatures');
        $this->addSql('DROP TABLE creatures_tags');
        $this->addSql('DROP TABLE films');
        $this->addSql('DROP TABLE pages');
        $this->addSql('DROP TABLE tags');
    }
}
