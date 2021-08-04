<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210803161940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DAB677BE6 FOREIGN KEY (boutique_id) REFERENCES boutique (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DAB677BE6 ON commande (boutique_id)');
        $this->addSql('ALTER TABLE facture CHANGE paid_at paid_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DAB677BE6');
        $this->addSql('DROP INDEX IDX_6EEAA67DAB677BE6 ON commande');
        $this->addSql('ALTER TABLE facture CHANGE paid_at paid_at DATETIME NOT NULL');
    }
}
