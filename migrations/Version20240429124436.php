<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240429124436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE av_form ADD av_travel_id INT NOT NULL, ADD av_status_id INT NOT NULL, ADD av_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE av_form ADD CONSTRAINT FK_A4590CBA9C08A260 FOREIGN KEY (av_travel_id) REFERENCES av_travel (id)');
        $this->addSql('ALTER TABLE av_form ADD CONSTRAINT FK_A4590CBA1B54B76E FOREIGN KEY (av_status_id) REFERENCES av_status (id)');
        $this->addSql('ALTER TABLE av_form ADD CONSTRAINT FK_A4590CBAE81250E6 FOREIGN KEY (av_user_id) REFERENCES av_user (id)');
        $this->addSql('CREATE INDEX IDX_A4590CBA9C08A260 ON av_form (av_travel_id)');
        $this->addSql('CREATE INDEX IDX_A4590CBA1B54B76E ON av_form (av_status_id)');
        $this->addSql('CREATE INDEX IDX_A4590CBAE81250E6 ON av_form (av_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE av_form DROP FOREIGN KEY FK_A4590CBA9C08A260');
        $this->addSql('ALTER TABLE av_form DROP FOREIGN KEY FK_A4590CBA1B54B76E');
        $this->addSql('ALTER TABLE av_form DROP FOREIGN KEY FK_A4590CBAE81250E6');
        $this->addSql('DROP INDEX IDX_A4590CBA9C08A260 ON av_form');
        $this->addSql('DROP INDEX IDX_A4590CBA1B54B76E ON av_form');
        $this->addSql('DROP INDEX IDX_A4590CBAE81250E6 ON av_form');
        $this->addSql('ALTER TABLE av_form DROP av_travel_id, DROP av_status_id, DROP av_user_id');
    }
}
