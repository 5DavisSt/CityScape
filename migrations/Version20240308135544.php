<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240308135544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address CHANGE add_property_id add_property_id INT DEFAULT NULL, CHANGE add_country_id add_country_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE amenity CHANGE amen_property_id amen_property_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE rent CHANGE rent_user_id rent_user_id INT DEFAULT NULL, CHANGE rent_property_id rent_property_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address CHANGE add_property_id add_property_id INT NOT NULL, CHANGE add_country_id add_country_id INT NOT NULL');
        $this->addSql('ALTER TABLE amenity CHANGE amen_property_id amen_property_id INT NOT NULL');
        $this->addSql('ALTER TABLE rent CHANGE rent_user_id rent_user_id INT NOT NULL, CHANGE rent_property_id rent_property_id INT NOT NULL');
    }
}
