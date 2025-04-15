<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250415105105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE article ADD categorie_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE article ADD CONSTRAINT FK_23A0E66BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_23A0E66BCF5E72D ON article (categorie_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE article DROP FOREIGN KEY FK_23A0E66BCF5E72D
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE categorie
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_23A0E66BCF5E72D ON article
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE article DROP categorie_id
        SQL);
    }
}
