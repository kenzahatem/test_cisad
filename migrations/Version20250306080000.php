<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250306080000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE infos (id SERIAL NOT NULL, user_id_id INT DEFAULT NULL, rank VARCHAR(255) DEFAULT NULL, victoire VARCHAR(255) DEFAULT NULL, defaite VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EECA826D9D86650F ON infos (user_id_id)');
        $this->addSql('ALTER TABLE infos ADD CONSTRAINT FK_EECA826D9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE infos DROP CONSTRAINT FK_EECA826D9D86650F');
        $this->addSql('DROP TABLE infos');
    }
}
