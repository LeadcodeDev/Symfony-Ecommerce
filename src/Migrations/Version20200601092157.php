<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200601092157 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE items ADD filename VARCHAR(255) NOT NULL, ADD updated_at DATETIME NOT NULL, CHANGE category_id category_id INT DEFAULT NULL, CHANGE author_id author_id INT DEFAULT NULL, CHANGE is_visible is_visible TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE keywords CHANGE website_config_id website_config_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE items DROP filename, DROP updated_at, CHANGE category_id category_id INT DEFAULT NULL, CHANGE author_id author_id INT DEFAULT NULL, CHANGE is_visible is_visible TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE keywords CHANGE website_config_id website_config_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
