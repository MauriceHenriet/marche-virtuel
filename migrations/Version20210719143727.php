<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210719143727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27858C065E');
        $this->addSql('CREATE TABLE boutique (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, category LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_A1223C54A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE boutique ADD CONSTRAINT FK_A1223C54A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE profil_vendeur');
        $this->addSql('DROP INDEX IDX_29A5EC27858C065E ON produit');
        $this->addSql('ALTER TABLE produit CHANGE vendeur_id boutique_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27AB677BE6 FOREIGN KEY (boutique_id) REFERENCES boutique (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27AB677BE6 ON produit (boutique_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27AB677BE6');
        $this->addSql('CREATE TABLE profil_vendeur (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_FFE056C7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE profil_vendeur ADD CONSTRAINT FK_FFE056C7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('DROP TABLE boutique');
        $this->addSql('DROP INDEX IDX_29A5EC27AB677BE6 ON produit');
        $this->addSql('ALTER TABLE produit CHANGE boutique_id vendeur_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27858C065E FOREIGN KEY (vendeur_id) REFERENCES profil_vendeur (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27858C065E ON produit (vendeur_id)');
    }
}
