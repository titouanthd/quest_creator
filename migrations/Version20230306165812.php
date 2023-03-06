<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230306165812 extends AbstractMigration
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
        $this->addSql('CREATE TABLE biome (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, biome_type_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, CONSTRAINT FK_CDFE6799F1C7E45C FOREIGN KEY (biome_type_id) REFERENCES biome_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_CDFE6799F1C7E45C ON biome (biome_type_id)');
        $this->addSql('CREATE TABLE biome_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE interaction (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, interaction_type_id INTEGER DEFAULT NULL, map_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, CONSTRAINT FK_378DFDA7A50ABBF2 FOREIGN KEY (interaction_type_id) REFERENCES interaction_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_378DFDA753C55F64 FOREIGN KEY (map_id) REFERENCES map (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_378DFDA7A50ABBF2 ON interaction (interaction_type_id)');
        $this->addSql('CREATE INDEX IDX_378DFDA753C55F64 ON interaction (map_id)');
        $this->addSql('CREATE TABLE interaction_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE map (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, area_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, CONSTRAINT FK_93ADAABBBD0F409C FOREIGN KEY (area_id) REFERENCES area (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_93ADAABBBD0F409C ON map (area_id)');
        $this->addSql('CREATE TABLE universe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, seed VARCHAR(255) NOT NULL, CONSTRAINT FK_61353835A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_61353835A76ED395 ON universe (user_id)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, username VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, last_connect DATETIME DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
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
        $this->addSql('DROP TABLE universe');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
