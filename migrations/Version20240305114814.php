<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305114814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE amenity (id INT AUTO_INCREMENT NOT NULL, amen_prop_id_id INT NOT NULL, amen_dishwasher TINYINT(1) NOT NULL, amen_floor_coverings TINYINT(1) NOT NULL, amen_internet TINYINT(1) NOT NULL, amen_wardrobes TINYINT(1) NOT NULL, amen_supermarket TINYINT(1) NOT NULL, amen_kids_zone TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_AB607963A7C942B8 (amen_prop_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amenity ADD CONSTRAINT FK_AB607963A7C942B8 FOREIGN KEY (amen_prop_id_id) REFERENCES property (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE amenity DROP FOREIGN KEY FK_AB607963A7C942B8');
        $this->addSql('DROP TABLE amenity');
    }
}
