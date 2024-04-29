<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240429123842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE av_travel ADD av_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE av_travel ADD CONSTRAINT FK_8E7A4A6DE81250E6 FOREIGN KEY (av_user_id) REFERENCES av_user (id)');
        $this->addSql('CREATE INDEX IDX_8E7A4A6DE81250E6 ON av_travel (av_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE av_travel DROP FOREIGN KEY FK_8E7A4A6DE81250E6');
        $this->addSql('DROP INDEX IDX_8E7A4A6DE81250E6 ON av_travel');
        $this->addSql('ALTER TABLE av_travel DROP av_user_id');
    }
}
