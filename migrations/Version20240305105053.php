<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305105053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON property');
        $this->addSql('ALTER TABLE property CHANGE id prop_id INT AUTO_INCREMENT NOT NULL, CHANGE created_at prop_created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE property ADD PRIMARY KEY (prop_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property MODIFY prop_id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON property');
        $this->addSql('ALTER TABLE property CHANGE prop_id id INT AUTO_INCREMENT NOT NULL, CHANGE prop_created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE property ADD PRIMARY KEY (id)');
    }
}
