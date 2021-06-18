<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210618013806 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidature DROP Recruteur_id, DROP Offre_id, DROP email');
        $this->addSql('ALTER TABLE offre_emploi DROP recruteur_id, DROP nom_entrprise, CHANGE created_at created_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD inactif TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE candidature ADD Recruteur_id INT NOT NULL, ADD Offre_id INT NOT NULL, ADD email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE offre_emploi ADD recruteur_id INT NOT NULL, ADD nom_entrprise VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE created_at created_at DATE NOT NULL');
        $this->addSql('ALTER TABLE user DROP inactif');
    }
}
