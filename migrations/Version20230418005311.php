<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230418005311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE world ADD COLUMN slug VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__world AS SELECT id, universe_id, name, created_at, updated_at FROM world');
        $this->addSql('DROP TABLE world');
        $this->addSql('CREATE TABLE world (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, universe_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT \'now()\' NOT NULL, updated_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        , CONSTRAINT FK_3A7711435CD9AF2 FOREIGN KEY (universe_id) REFERENCES universe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO world (id, universe_id, name, created_at, updated_at) SELECT id, universe_id, name, created_at, updated_at FROM __temp__world');
        $this->addSql('DROP TABLE __temp__world');
        $this->addSql('CREATE INDEX IDX_3A7711435CD9AF2 ON world (universe_id)');
    }
}
