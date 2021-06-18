<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617160513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE regles');
        $this->addSql('ALTER TABLE offre_emploi ADD recruteur_id INT NOT NULL');
        $this->addSql('ALTER TABLE user DROP last_login, DROP postulation_restant');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE regles (id INT AUTO_INCREMENT NOT NULL, duree INT DEFAULT NULL, limite_postulation INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE offre_emploi DROP recruteur_id');
        $this->addSql('ALTER TABLE user ADD last_login DATE DEFAULT NULL, ADD postulation_restant INT DEFAULT NULL');
    }
}
