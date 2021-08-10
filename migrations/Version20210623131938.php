<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210623131938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commerce (id INT AUTO_INCREMENT NOT NULL, patron_id INT NOT NULL, nom VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, image VARCHAR(100) NOT NULL, adress VARCHAR(100) NOT NULL, cp VARCHAR(100) NOT NULL, ville VARCHAR(100) NOT NULL, tel VARCHAR(100) DEFAULT NULL, INDEX IDX_BBF5FDF9DBD5322 (patron_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commerce_user (commerce_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_55A09C4CB09114B7 (commerce_id), INDEX IDX_55A09C4CA76ED395 (user_id), PRIMARY KEY(commerce_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, abonnement INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commerce ADD CONSTRAINT FK_BBF5FDF9DBD5322 FOREIGN KEY (patron_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commerce_user ADD CONSTRAINT FK_55A09C4CB09114B7 FOREIGN KEY (commerce_id) REFERENCES commerce (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commerce_user ADD CONSTRAINT FK_55A09C4CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commerce_user DROP FOREIGN KEY FK_55A09C4CB09114B7');
        $this->addSql('ALTER TABLE commerce DROP FOREIGN KEY FK_BBF5FDF9DBD5322');
        $this->addSql('ALTER TABLE commerce_user DROP FOREIGN KEY FK_55A09C4CA76ED395');
        $this->addSql('DROP TABLE commerce');
        $this->addSql('DROP TABLE commerce_user');
        $this->addSql('DROP TABLE user');
    }
}
