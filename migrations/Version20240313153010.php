<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313153010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address CHANGE add_address_line_1 add_address_line1 VARCHAR(255) NOT NULL, CHANGE add_address_line_2 add_address_line2 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD cat_name VARCHAR(255) NOT NULL, ADD cat_slug VARCHAR(255) NOT NULL, ADD cat_meta_title VARCHAR(255) NOT NULL, ADD cat_meta_description VARCHAR(255) NOT NULL, DROP name, DROP slug, DROP meta_title, DROP meta_description');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F89549213EC');
        $this->addSql('DROP INDEX IDX_16DB4F89549213EC ON picture');
        $this->addSql('ALTER TABLE picture ADD pic_property_id INT DEFAULT NULL, ADD pic_size INT DEFAULT NULL, DROP property_id, DROP image_size, CHANGE image_name pic_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F8931C778CF FOREIGN KEY (pic_property_id) REFERENCES property (id)');
        $this->addSql('CREATE INDEX IDX_16DB4F8931C778CF ON picture (pic_property_id)');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE12469DE2');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE9F9F1305');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEF5B7AF75');
        $this->addSql('DROP INDEX IDX_8BF21CDE12469DE2 ON property');
        $this->addSql('DROP INDEX UNIQ_8BF21CDE9F9F1305 ON property');
        $this->addSql('DROP INDEX UNIQ_8BF21CDEF5B7AF75 ON property');
        $this->addSql('ALTER TABLE property ADD prop_category_id INT DEFAULT NULL, ADD prop_amenity_id INT DEFAULT NULL, ADD prop_address_id INT DEFAULT NULL, DROP category_id, DROP amenity_id, DROP address_id');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDECA943D59 FOREIGN KEY (prop_category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE401472AD FOREIGN KEY (prop_amenity_id) REFERENCES amenity (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE2A3CCEDD FOREIGN KEY (prop_address_id) REFERENCES address (id)');
        $this->addSql('CREATE INDEX IDX_8BF21CDECA943D59 ON property (prop_category_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDE401472AD ON property (prop_amenity_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDE2A3CCEDD ON property (prop_address_id)');
        $this->addSql('ALTER TABLE rent DROP FOREIGN KEY FK_2784DCC549213EC');
        $this->addSql('ALTER TABLE rent DROP FOREIGN KEY FK_2784DCCA76ED395');
        $this->addSql('DROP INDEX IDX_2784DCC549213EC ON rent');
        $this->addSql('DROP INDEX IDX_2784DCCA76ED395 ON rent');
        $this->addSql('ALTER TABLE rent ADD rent_user_id INT DEFAULT NULL, ADD rent_property_id INT DEFAULT NULL, DROP user_id, DROP property_id');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCC4642A8E5 FOREIGN KEY (rent_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCC89358D81 FOREIGN KEY (rent_property_id) REFERENCES property (id)');
        $this->addSql('CREATE INDEX IDX_2784DCC4642A8E5 ON rent (rent_user_id)');
        $this->addSql('CREATE INDEX IDX_2784DCC89358D81 ON rent (rent_property_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD user_first_name VARCHAR(255) NOT NULL, ADD user_last_name VARCHAR(255) NOT NULL, DROP first_name, DROP last_name, CHANGE email user_email VARCHAR(180) NOT NULL, CHANGE is_verified user_is_verified TINYINT(1) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649550872C ON user (user_email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rent DROP FOREIGN KEY FK_2784DCC4642A8E5');
        $this->addSql('ALTER TABLE rent DROP FOREIGN KEY FK_2784DCC89358D81');
        $this->addSql('DROP INDEX IDX_2784DCC4642A8E5 ON rent');
        $this->addSql('DROP INDEX IDX_2784DCC89358D81 ON rent');
        $this->addSql('ALTER TABLE rent ADD user_id INT DEFAULT NULL, ADD property_id INT DEFAULT NULL, DROP rent_user_id, DROP rent_property_id');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCC549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2784DCC549213EC ON rent (property_id)');
        $this->addSql('CREATE INDEX IDX_2784DCCA76ED395 ON rent (user_id)');
        $this->addSql('ALTER TABLE address CHANGE add_address_line1 add_address_line_1 VARCHAR(255) NOT NULL, CHANGE add_address_line2 add_address_line_2 VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDECA943D59');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE401472AD');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE2A3CCEDD');
        $this->addSql('DROP INDEX IDX_8BF21CDECA943D59 ON property');
        $this->addSql('DROP INDEX UNIQ_8BF21CDE401472AD ON property');
        $this->addSql('DROP INDEX UNIQ_8BF21CDE2A3CCEDD ON property');
        $this->addSql('ALTER TABLE property ADD category_id INT DEFAULT NULL, ADD amenity_id INT DEFAULT NULL, ADD address_id INT DEFAULT NULL, DROP prop_category_id, DROP prop_amenity_id, DROP prop_address_id');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE9F9F1305 FOREIGN KEY (amenity_id) REFERENCES amenity (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8BF21CDE12469DE2 ON property (category_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDE9F9F1305 ON property (amenity_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BF21CDEF5B7AF75 ON property (address_id)');
        $this->addSql('ALTER TABLE picture DROP FOREIGN KEY FK_16DB4F8931C778CF');
        $this->addSql('DROP INDEX IDX_16DB4F8931C778CF ON picture');
        $this->addSql('ALTER TABLE picture ADD property_id INT DEFAULT NULL, ADD image_size INT DEFAULT NULL, DROP pic_property_id, DROP pic_size, CHANGE pic_name image_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_16DB4F89549213EC ON picture (property_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649550872C ON user');
        $this->addSql('ALTER TABLE user ADD first_name VARCHAR(255) NOT NULL, ADD last_name VARCHAR(255) NOT NULL, DROP user_first_name, DROP user_last_name, CHANGE user_email email VARCHAR(180) NOT NULL, CHANGE user_is_verified is_verified TINYINT(1) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('ALTER TABLE category ADD name VARCHAR(255) NOT NULL, ADD slug VARCHAR(255) NOT NULL, ADD meta_title VARCHAR(255) NOT NULL, ADD meta_description VARCHAR(255) NOT NULL, DROP cat_name, DROP cat_slug, DROP cat_meta_title, DROP cat_meta_description');
    }
}
