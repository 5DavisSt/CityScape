<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305115610 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE amenity DROP FOREIGN KEY FK_AB607963A7C942B8');
        $this->addSql('DROP INDEX UNIQ_AB607963A7C942B8 ON amenity');
        $this->addSql('ALTER TABLE amenity CHANGE amen_prop_id_id amen_prop_id INT NOT NULL');
        $this->addSql('ALTER TABLE amenity ADD CONSTRAINT FK_AB6079633FD4699C FOREIGN KEY (amen_prop_id) REFERENCES property (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AB6079633FD4699C ON amenity (amen_prop_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE amenity DROP FOREIGN KEY FK_AB6079633FD4699C');
        $this->addSql('DROP INDEX UNIQ_AB6079633FD4699C ON amenity');
        $this->addSql('ALTER TABLE amenity CHANGE amen_prop_id amen_prop_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE amenity ADD CONSTRAINT FK_AB607963A7C942B8 FOREIGN KEY (amen_prop_id_id) REFERENCES property (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AB607963A7C942B8 ON amenity (amen_prop_id_id)');
    }
}
