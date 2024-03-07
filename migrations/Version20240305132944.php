<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305132944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE amenity DROP FOREIGN KEY FK_AB6079633FD4699C');
        $this->addSql('DROP INDEX UNIQ_AB6079633FD4699C ON amenity');
        $this->addSql('ALTER TABLE amenity CHANGE amen_prop_id amen_property_id INT NOT NULL');
        $this->addSql('ALTER TABLE amenity ADD CONSTRAINT FK_AB6079634833307B FOREIGN KEY (amen_property_id) REFERENCES property (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AB6079634833307B ON amenity (amen_property_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE amenity DROP FOREIGN KEY FK_AB6079634833307B');
        $this->addSql('DROP INDEX UNIQ_AB6079634833307B ON amenity');
        $this->addSql('ALTER TABLE amenity CHANGE amen_property_id amen_prop_id INT NOT NULL');
        $this->addSql('ALTER TABLE amenity ADD CONSTRAINT FK_AB6079633FD4699C FOREIGN KEY (amen_prop_id) REFERENCES property (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AB6079633FD4699C ON amenity (amen_prop_id)');
    }
}
