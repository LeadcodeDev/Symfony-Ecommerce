<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200601105153 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, INDEX IDX_BA388B7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_items (id INT AUTO_INCREMENT NOT NULL, cart_id INT DEFAULT NULL, amount INT NOT NULL, INDEX IDX_BEF484451AD5CDBF (cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_items_items (cart_items_id INT NOT NULL, items_id INT NOT NULL, INDEX IDX_B611DAB6F52FE1EF (cart_items_id), INDEX IDX_B611DAB66BB0AE84 (items_id), PRIMARY KEY(cart_items_id, items_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart_items ADD CONSTRAINT FK_BEF484451AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE cart_items_items ADD CONSTRAINT FK_B611DAB6F52FE1EF FOREIGN KEY (cart_items_id) REFERENCES cart_items (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_items_items ADD CONSTRAINT FK_B611DAB66BB0AE84 FOREIGN KEY (items_id) REFERENCES items (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE items CHANGE category_id category_id INT DEFAULT NULL, CHANGE author_id author_id INT DEFAULT NULL, CHANGE is_visible is_visible TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE keywords CHANGE website_config_id website_config_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cart_items DROP FOREIGN KEY FK_BEF484451AD5CDBF');
        $this->addSql('ALTER TABLE cart_items_items DROP FOREIGN KEY FK_B611DAB6F52FE1EF');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_items');
        $this->addSql('DROP TABLE cart_items_items');
        $this->addSql('ALTER TABLE items CHANGE category_id category_id INT DEFAULT NULL, CHANGE author_id author_id INT DEFAULT NULL, CHANGE is_visible is_visible TINYINT(1) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE keywords CHANGE website_config_id website_config_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
