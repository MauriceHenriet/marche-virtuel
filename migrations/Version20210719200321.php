<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210719200321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boutique DROP FOREIGN KEY FK_A1223C54A76ED395');
        $this->addSql('DROP INDEX UNIQ_A1223C54A76ED395 ON boutique');
        $this->addSql('ALTER TABLE boutique ADD categorie VARCHAR(255) NOT NULL, ADD status VARCHAR(255) NOT NULL, CHANGE user_id vendeur_id INT NOT NULL');
        $this->addSql('ALTER TABLE boutique ADD CONSTRAINT FK_A1223C54858C065E FOREIGN KEY (vendeur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A1223C54858C065E ON boutique (vendeur_id)');
        $this->addSql('ALTER TABLE produit ADD status VARCHAR(255) NOT NULL, DROP categorie');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE boutique DROP FOREIGN KEY FK_A1223C54858C065E');
        $this->addSql('DROP INDEX IDX_A1223C54858C065E ON boutique');
        $this->addSql('ALTER TABLE boutique DROP categorie, DROP status, CHANGE vendeur_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE boutique ADD CONSTRAINT FK_A1223C54A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A1223C54A76ED395 ON boutique (user_id)');
        $this->addSql('ALTER TABLE produit ADD categorie LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', DROP status');
    }
}
