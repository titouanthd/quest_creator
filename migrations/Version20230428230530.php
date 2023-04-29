<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230428230530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE biome ADD COLUMN created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE biome ADD COLUMN updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE map ADD COLUMN created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE map ADD COLUMN updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE universe ADD COLUMN created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE universe ADD COLUMN updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD COLUMN created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD COLUMN updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE world ADD COLUMN created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE world ADD COLUMN updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__biome AS SELECT id, world_id, name, slug, color FROM biome');
        $this->addSql('DROP TABLE biome');
        $this->addSql('CREATE TABLE biome (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, world_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, color VARCHAR(255) NOT NULL, CONSTRAINT FK_CDFE67998925311C FOREIGN KEY (world_id) REFERENCES world (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO biome (id, world_id, name, slug, color) SELECT id, world_id, name, slug, color FROM __temp__biome');
        $this->addSql('DROP TABLE __temp__biome');
        $this->addSql('CREATE INDEX IDX_CDFE67998925311C ON biome (world_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__map AS SELECT id, world_id, name, slug, width, height, size FROM map');
        $this->addSql('DROP TABLE map');
        $this->addSql('CREATE TABLE map (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, world_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, width INTEGER NOT NULL, height INTEGER NOT NULL, size VARCHAR(255) NOT NULL, CONSTRAINT FK_93ADAABB8925311C FOREIGN KEY (world_id) REFERENCES world (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO map (id, world_id, name, slug, width, height, size) SELECT id, world_id, name, slug, width, height, size FROM __temp__map');
        $this->addSql('DROP TABLE __temp__map');
        $this->addSql('CREATE INDEX IDX_93ADAABB8925311C ON map (world_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__universe AS SELECT id, author_id, name, slug FROM universe');
        $this->addSql('DROP TABLE universe');
        $this->addSql('CREATE TABLE universe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, CONSTRAINT FK_61353835F675F31B FOREIGN KEY (author_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO universe (id, author_id, name, slug) SELECT id, author_id, name, slug FROM __temp__universe');
        $this->addSql('DROP TABLE __temp__universe');
        $this->addSql('CREATE INDEX IDX_61353835F675F31B ON universe (author_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, roles, password, username, avatar_url FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, username VARCHAR(255) DEFAULT NULL, avatar_url VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO user (id, email, roles, password, username, avatar_url) SELECT id, email, roles, password, username, avatar_url FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__world AS SELECT id, universe_id, name, slug FROM world');
        $this->addSql('DROP TABLE world');
        $this->addSql('CREATE TABLE world (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, universe_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, CONSTRAINT FK_3A7711435CD9AF2 FOREIGN KEY (universe_id) REFERENCES universe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO world (id, universe_id, name, slug) SELECT id, universe_id, name, slug FROM __temp__world');
        $this->addSql('DROP TABLE __temp__world');
        $this->addSql('CREATE INDEX IDX_3A7711435CD9AF2 ON world (universe_id)');
    }
}
