<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306170053 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE map ADD COLUMN x INTEGER NOT NULL');
        $this->addSql('ALTER TABLE map ADD COLUMN y INTEGER NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__map AS SELECT id, area_id, name, slug, created_at, updated_at FROM map');
        $this->addSql('DROP TABLE map');
        $this->addSql('CREATE TABLE map (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, area_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, CONSTRAINT FK_93ADAABBBD0F409C FOREIGN KEY (area_id) REFERENCES area (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO map (id, area_id, name, slug, created_at, updated_at) SELECT id, area_id, name, slug, created_at, updated_at FROM __temp__map');
        $this->addSql('DROP TABLE __temp__map');
        $this->addSql('CREATE INDEX IDX_93ADAABBBD0F409C ON map (area_id)');
    }
}
