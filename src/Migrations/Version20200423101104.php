<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200423101104 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, describes LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE items (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, author_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, describes LONGTEXT NOT NULL, INDEX IDX_E11EE94D12469DE2 (category_id), INDEX IDX_E11EE94DF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE items ADD CONSTRAINT FK_E11EE94DF675F31B FOREIGN KEY (author_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE items DROP FOREIGN KEY FK_E11EE94D12469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE items');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
