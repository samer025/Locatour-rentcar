<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231124214632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_technique ADD id_v INT NOT NULL');
        $this->addSql('ALTER TABLE fiche_technique ADD CONSTRAINT FK_505525A9ACF191FB FOREIGN KEY (id_v) REFERENCES voiture (id_v)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_505525A9ACF191FB ON fiche_technique (id_v)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_technique DROP FOREIGN KEY FK_505525A9ACF191FB');
        $this->addSql('DROP INDEX UNIQ_505525A9ACF191FB ON fiche_technique');
        $this->addSql('ALTER TABLE fiche_technique DROP id_v');
    }
}
