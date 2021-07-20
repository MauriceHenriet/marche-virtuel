<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210719134237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816B981C689');
        $this->addSql('DROP INDEX IDX_C35F0816B981C689 ON adresse');
        $this->addSql('ALTER TABLE adresse CHANGE utilisateur_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C35F0816A76ED395 ON adresse (user_id)');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DB981C689');
        $this->addSql('DROP INDEX IDX_6EEAA67DB981C689 ON commande');
        $this->addSql('ALTER TABLE commande CHANGE utilisateur_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DA76ED395 ON commande (user_id)');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE866410462C4194');
        $this->addSql('DROP INDEX UNIQ_FE866410462C4194 ON facture');
        $this->addSql('ALTER TABLE facture CHANGE commande_id_id commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641082EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE86641082EA2E54 ON facture (commande_id)');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B462C4194');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B4FD8F9C3');
        $this->addSql('DROP INDEX IDX_3170B74B4FD8F9C3 ON ligne_commande');
        $this->addSql('DROP INDEX IDX_3170B74B462C4194 ON ligne_commande');
        $this->addSql('ALTER TABLE ligne_commande ADD commande_id INT NOT NULL, ADD produit_id INT NOT NULL, DROP commande_id_id, DROP produit_id_id');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_3170B74B82EA2E54 ON ligne_commande (commande_id)');
        $this->addSql('CREATE INDEX IDX_3170B74BF347EFB ON ligne_commande (produit_id)');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27B237AE82');
        $this->addSql('DROP INDEX IDX_29A5EC27B237AE82 ON produit');
        $this->addSql('ALTER TABLE produit CHANGE vendeur_id_id vendeur_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27858C065E FOREIGN KEY (vendeur_id) REFERENCES profil_vendeur (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27858C065E ON produit (vendeur_id)');
        $this->addSql('ALTER TABLE profil_vendeur DROP FOREIGN KEY FK_FFE056C79D86650F');
        $this->addSql('DROP INDEX IDX_FFE056C79D86650F ON profil_vendeur');
        $this->addSql('ALTER TABLE profil_vendeur CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE profil_vendeur ADD CONSTRAINT FK_FFE056C7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FFE056C7A76ED395 ON profil_vendeur (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F0816A76ED395');
        $this->addSql('DROP INDEX IDX_C35F0816A76ED395 ON adresse');
        $this->addSql('ALTER TABLE adresse CHANGE user_id utilisateur_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F0816B981C689 FOREIGN KEY (utilisateur_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_C35F0816B981C689 ON adresse (utilisateur_id_id)');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DA76ED395');
        $this->addSql('DROP INDEX IDX_6EEAA67DA76ED395 ON commande');
        $this->addSql('ALTER TABLE commande CHANGE user_id utilisateur_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DB981C689 FOREIGN KEY (utilisateur_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DB981C689 ON commande (utilisateur_id_id)');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641082EA2E54');
        $this->addSql('DROP INDEX UNIQ_FE86641082EA2E54 ON facture');
        $this->addSql('ALTER TABLE facture CHANGE commande_id commande_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE866410462C4194 FOREIGN KEY (commande_id_id) REFERENCES commande (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE866410462C4194 ON facture (commande_id_id)');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B82EA2E54');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74BF347EFB');
        $this->addSql('DROP INDEX IDX_3170B74B82EA2E54 ON ligne_commande');
        $this->addSql('DROP INDEX IDX_3170B74BF347EFB ON ligne_commande');
        $this->addSql('ALTER TABLE ligne_commande ADD commande_id_id INT NOT NULL, ADD produit_id_id INT NOT NULL, DROP commande_id, DROP produit_id');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B462C4194 FOREIGN KEY (commande_id_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B4FD8F9C3 FOREIGN KEY (produit_id_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_3170B74B4FD8F9C3 ON ligne_commande (produit_id_id)');
        $this->addSql('CREATE INDEX IDX_3170B74B462C4194 ON ligne_commande (commande_id_id)');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27858C065E');
        $this->addSql('DROP INDEX IDX_29A5EC27858C065E ON produit');
        $this->addSql('ALTER TABLE produit CHANGE vendeur_id vendeur_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27B237AE82 FOREIGN KEY (vendeur_id_id) REFERENCES profil_vendeur (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27B237AE82 ON produit (vendeur_id_id)');
        $this->addSql('ALTER TABLE profil_vendeur DROP FOREIGN KEY FK_FFE056C7A76ED395');
        $this->addSql('DROP INDEX IDX_FFE056C7A76ED395 ON profil_vendeur');
        $this->addSql('ALTER TABLE profil_vendeur CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE profil_vendeur ADD CONSTRAINT FK_FFE056C79D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FFE056C79D86650F ON profil_vendeur (user_id_id)');
    }
}
