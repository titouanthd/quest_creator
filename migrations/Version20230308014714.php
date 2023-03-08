<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308014714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE universe ADD COLUMN description CLOB DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__universe AS SELECT id, user_id, name, slug, created_at, updated_at, seed FROM universe');
        $this->addSql('DROP TABLE universe');
        $this->addSql('CREATE TABLE universe (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, seed VARCHAR(255) NOT NULL, CONSTRAINT FK_61353835A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO universe (id, user_id, name, slug, created_at, updated_at, seed) SELECT id, user_id, name, slug, created_at, updated_at, seed FROM __temp__universe');
        $this->addSql('DROP TABLE __temp__universe');
        $this->addSql('CREATE INDEX IDX_61353835A76ED395 ON universe (user_id)');
    }
}
