<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240327153037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, cart_user_id INT DEFAULT NULL, stripe_id INT NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BA388B75CB41B92 (cart_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_property (cart_id INT NOT NULL, property_id INT NOT NULL, INDEX IDX_156D53B51AD5CDBF (cart_id), INDEX IDX_156D53B5549213EC (property_id), PRIMARY KEY(cart_id, property_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B75CB41B92 FOREIGN KEY (cart_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE cart_property ADD CONSTRAINT FK_156D53B51AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_property ADD CONSTRAINT FK_156D53B5549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B75CB41B92');
        $this->addSql('ALTER TABLE cart_property DROP FOREIGN KEY FK_156D53B51AD5CDBF');
        $this->addSql('ALTER TABLE cart_property DROP FOREIGN KEY FK_156D53B5549213EC');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_property');
    }
}
