<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240414115506 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, contractor_id_id INTEGER NOT NULL, system_id VARCHAR(255) NOT NULL, system_password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, multysign_traffik_available BOOLEAN NOT NULL, international_traffik_available BOOLEAN NOT NULL, CONSTRAINT FK_C74404552FB9E3A1 FOREIGN KEY (contractor_id_id) REFERENCES contractor (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C74404552FB9E3A1 ON client (contractor_id_id)');
        $this->addSql('CREATE TABLE contractor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, legal_type VARCHAR(255) NOT NULL, inn VARCHAR(12) NOT NULL, name VARCHAR(512) NOT NULL, address VARCHAR(512) NOT NULL, contact VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, client_id_id INTEGER DEFAULT NULL, email VARCHAR(180) NOT NULL, login VARCHAR(64) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, phone VARCHAR(16) NOT NULL, first_name VARCHAR(64) NOT NULL, middle_name VARCHAR(64) NOT NULL, last_name VARCHAR(64) NOT NULL, CONSTRAINT FK_8D93D649DC2902E0 FOREIGN KEY (client_id_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649DC2902E0 ON user (client_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE contractor');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
