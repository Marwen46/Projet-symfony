<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210618031222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE regles');
        $this->addSql('ALTER TABLE acceptees ADD email VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD offre VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E33BD3B8E7927C74 ON candidature (email)');
        $this->addSql('ALTER TABLE offre_emploi CHANGE created_at created_at DATETIME NOT NULL, CHANGE nom_entrprise nom_entrprise VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE user DROP last_login, DROP postulation_restant, DROP inactif');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE regles (id INT AUTO_INCREMENT NOT NULL, duree INT DEFAULT NULL, limite_postulation INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE acceptees DROP email, DROP nom, DROP prenom, DROP offre');
        $this->addSql('DROP INDEX UNIQ_E33BD3B8E7927C74 ON candidature');
        $this->addSql('ALTER TABLE offre_emploi CHANGE nom_entrprise nom_entrprise VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE created_at created_at DATE NOT NULL');
        $this->addSql('ALTER TABLE user ADD last_login DATE DEFAULT NULL, ADD postulation_restant INT DEFAULT NULL, ADD inactif TINYINT(1) DEFAULT NULL');
    }
}
