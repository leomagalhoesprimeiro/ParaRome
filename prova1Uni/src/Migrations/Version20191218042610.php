<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191218042610 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('ALTER TABLE aluno ADD COLUMN projeto_id INTEGER DEFAULT NULL');
        $this->addSql('ALTER TABLE professor ADD COLUMN projeto_id INTEGER DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__aluno AS SELECT id, nome FROM aluno');
        $this->addSql('DROP TABLE aluno');
        $this->addSql('CREATE TABLE aluno (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO aluno (id, nome) SELECT id, nome FROM __temp__aluno');
        $this->addSql('DROP TABLE __temp__aluno');
        $this->addSql('CREATE TEMPORARY TABLE __temp__professor AS SELECT id, nome FROM professor');
        $this->addSql('DROP TABLE professor');
        $this->addSql('CREATE TABLE professor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nome VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO professor (id, nome) SELECT id, nome FROM __temp__professor');
        $this->addSql('DROP TABLE __temp__professor');
    }
}
