<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306122613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE area (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, universe_id INTEGER DEFAULT NULL, biome_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, CONSTRAINT FK_D7943D685CD9AF2 FOREIGN KEY (universe_id) REFERENCES universe (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D7943D68E43A64F9 FOREIGN KEY (biome_id) REFERENCES biome (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D7943D685CD9AF2 ON area (universe_id)');
        $this->addSql('CREATE INDEX IDX_D7943D68E43A64F9 ON area (biome_id)');
        $this->addSql('CREATE TABLE biome (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, CONSTRAINT FK_CDFE6799C54C8C93 FOREIGN KEY (type_id) REFERENCES biome_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_CDFE6799C54C8C93 ON biome (type_id)');
        $this->addSql('CREATE TABLE biome_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE interaction (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER DEFAULT NULL, map_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, CONSTRAINT FK_378DFDA7C54C8C93 FOREIGN KEY (type_id) REFERENCES interaction_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_378DFDA753C55F64 FOREIGN KEY (map_id) REFERENCES map (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_378DFDA7C54C8C93 ON interaction (type_id)');
        $this->addSql('CREATE INDEX IDX_378DFDA753C55F64 ON interaction (map_id)');
        $this->addSql('CREATE TABLE interaction_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE map (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, area_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, x VARCHAR(255) NOT NULL, y VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, CONSTRAINT FK_93ADAABBBD0F409C FOREIGN KEY (area_id) REFERENCES area (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_93ADAABBBD0F409C ON map (area_id)');
        $this->addSql('ALTER TABLE universe ADD COLUMN seed VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE area');
        $this->addSql('DROP TABLE biome');
        $this->addSql('DROP TABLE biome_type');
        $this->addSql('DROP TABLE interaction');
        $this->addSql('DROP TABLE interaction_type');
        $this->addSql('DROP TABLE map');
        $this->addSql('CREATE TEMPORARY TABLE __temp__universe AS SELECT id, user_id, name, slug, created_at, updated_at FROM universe');
        $this->addSql('DROP TABLE universe');
        $this->addSql('CREATE TABLE universe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, CONSTRAINT FK_61353835A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO universe (id, user_id, name, slug, created_at, updated_at) SELECT id, user_id, name, slug, created_at, updated_at FROM __temp__universe');
        $this->addSql('DROP TABLE __temp__universe');
        $this->addSql('CREATE INDEX IDX_61353835A76ED395 ON universe (user_id)');
    }
}
