<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240429124745 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE av_travel_av_category (av_travel_id INT NOT NULL, av_category_id INT NOT NULL, INDEX IDX_5C54153B9C08A260 (av_travel_id), INDEX IDX_5C54153BED565DB2 (av_category_id), PRIMARY KEY(av_travel_id, av_category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE av_travel_av_country (av_travel_id INT NOT NULL, av_country_id INT NOT NULL, INDEX IDX_4EA028989C08A260 (av_travel_id), INDEX IDX_4EA02898E6851EA9 (av_country_id), PRIMARY KEY(av_travel_id, av_country_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE av_travel_av_category ADD CONSTRAINT FK_5C54153B9C08A260 FOREIGN KEY (av_travel_id) REFERENCES av_travel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE av_travel_av_category ADD CONSTRAINT FK_5C54153BED565DB2 FOREIGN KEY (av_category_id) REFERENCES av_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE av_travel_av_country ADD CONSTRAINT FK_4EA028989C08A260 FOREIGN KEY (av_travel_id) REFERENCES av_travel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE av_travel_av_country ADD CONSTRAINT FK_4EA02898E6851EA9 FOREIGN KEY (av_country_id) REFERENCES av_country (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE av_travel_av_category DROP FOREIGN KEY FK_5C54153B9C08A260');
        $this->addSql('ALTER TABLE av_travel_av_category DROP FOREIGN KEY FK_5C54153BED565DB2');
        $this->addSql('ALTER TABLE av_travel_av_country DROP FOREIGN KEY FK_4EA028989C08A260');
        $this->addSql('ALTER TABLE av_travel_av_country DROP FOREIGN KEY FK_4EA02898E6851EA9');
        $this->addSql('DROP TABLE av_travel_av_category');
        $this->addSql('DROP TABLE av_travel_av_country');
    }
}
