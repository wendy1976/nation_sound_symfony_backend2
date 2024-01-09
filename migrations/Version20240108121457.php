<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240108121457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE concert (id INT AUTO_INCREMENT NOT NULL, date_concert_id INT NOT NULL, scene_id INT NOT NULL, musique_id INT DEFAULT NULL, nom_artiste VARCHAR(255) NOT NULL, designation VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_D57C02D24FFA7A88 (date_concert_id), INDEX IDX_D57C02D2166053B4 (scene_id), INDEX IDX_D57C02D225E254A1 (musique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE concert ADD CONSTRAINT FK_D57C02D24FFA7A88 FOREIGN KEY (date_concert_id) REFERENCES date_concert (id)');
        $this->addSql('ALTER TABLE concert ADD CONSTRAINT FK_D57C02D2166053B4 FOREIGN KEY (scene_id) REFERENCES scene (id)');
        $this->addSql('ALTER TABLE concert ADD CONSTRAINT FK_D57C02D225E254A1 FOREIGN KEY (musique_id) REFERENCES musique (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE concert DROP FOREIGN KEY FK_D57C02D24FFA7A88');
        $this->addSql('ALTER TABLE concert DROP FOREIGN KEY FK_D57C02D2166053B4');
        $this->addSql('ALTER TABLE concert DROP FOREIGN KEY FK_D57C02D225E254A1');
        $this->addSql('DROP TABLE concert');
    }
}
