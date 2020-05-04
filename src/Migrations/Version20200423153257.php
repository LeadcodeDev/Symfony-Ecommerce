<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200423153257 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE keywords (id INT AUTO_INCREMENT NOT NULL, website_config_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, INDEX IDX_AA5FB55EB703EE57 (website_config_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE website_config (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, describes LONGTEXT NOT NULL, image VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, copyright VARCHAR(255) NOT NULL, twitter_tag VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE keywords ADD CONSTRAINT FK_AA5FB55EB703EE57 FOREIGN KEY (website_config_id) REFERENCES website_config (id)');
        $this->addSql('ALTER TABLE items CHANGE category_id category_id INT DEFAULT NULL, CHANGE author_id author_id INT DEFAULT NULL, CHANGE is_visible is_visible TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE keywords DROP FOREIGN KEY FK_AA5FB55EB703EE57');
        $this->addSql('DROP TABLE keywords');
        $this->addSql('DROP TABLE website_config');
        $this->addSql('ALTER TABLE items CHANGE category_id category_id INT DEFAULT NULL, CHANGE author_id author_id INT DEFAULT NULL, CHANGE is_visible is_visible TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
