<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240305135607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, add_property_id INT NOT NULL, add_country_id INT NOT NULL, add_nb_street INT NOT NULL, add_address_line_1 VARCHAR(255) NOT NULL, add_address_line_2 VARCHAR(255) DEFAULT NULL, add_city VARCHAR(255) NOT NULL, add_state VARCHAR(255) NOT NULL, add_zip INT NOT NULL, UNIQUE INDEX UNIQ_D4E6F816D74A6B (add_property_id), INDEX IDX_D4E6F81D4948FC3 (add_country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, ct_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feature (id INT AUTO_INCREMENT NOT NULL, feat_property_id INT NOT NULL, feat_title VARCHAR(255) NOT NULL, INDEX IDX_1FD77566EDB74B6E (feat_property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picture (id INT AUTO_INCREMENT NOT NULL, pic_property_id INT NOT NULL, pic_file INT NOT NULL, pic_name VARCHAR(255) DEFAULT NULL, pic_href VARCHAR(255) NOT NULL, pic_alt VARCHAR(255) NOT NULL, pic_caption VARCHAR(255) DEFAULT NULL, pic_type INT NOT NULL, pic_format VARCHAR(255) NOT NULL, pic_width INT NOT NULL, pic_height INT NOT NULL, pic_size NUMERIC(10, 2) NOT NULL, INDEX IDX_16DB4F8931C778CF (pic_property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, proj_client VARCHAR(255) NOT NULL, proj_price INT NOT NULL, proj_category VARCHAR(255) NOT NULL, proj_date DATE NOT NULL, proj_facebook VARCHAR(255) DEFAULT NULL, proj_twitter VARCHAR(255) DEFAULT NULL, proj_linkedin VARCHAR(255) DEFAULT NULL, proj_instagram VARCHAR(255) DEFAULT NULL, proj_title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rent (id INT AUTO_INCREMENT NOT NULL, rent_user_id INT NOT NULL, rent_property_id INT NOT NULL, rent_start DATE NOT NULL, rent_end DATE NOT NULL, rent_price NUMERIC(10, 2) NOT NULL, INDEX IDX_2784DCC4642A8E5 (rent_user_id), INDEX IDX_2784DCC89358D81 (rent_property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F816D74A6B FOREIGN KEY (add_property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81D4948FC3 FOREIGN KEY (add_country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE feature ADD CONSTRAINT FK_1FD77566EDB74B6E FOREIGN KEY (feat_property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F8931C778CF FOREIGN KEY (pic_property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCC4642A8E5 FOREIGN KEY (rent_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCC89358D81 FOREIGN KEY (rent_property_id) REFERENCES property (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F816D74A6B');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81D4948FC3');
        $this->addSql('ALTER TABLE feature DROP FOREIGN KEY FK_1FD77566EDB74B6E');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F8931C778CF');
        $this->addSql('ALTER TABLE rent DROP FOREIGN KEY FK_2784DCC4642A8E5');
        $this->addSql('ALTER TABLE rent DROP FOREIGN KEY FK_2784DCC89358D81');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE feature');
        $this->addSql('DROP TABLE picture');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE rent');
    }
}
