<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240422094924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE concert_date_concert (concert_id INT NOT NULL, date_concert_id INT NOT NULL, INDEX IDX_DE47DA0D83C97B2E (concert_id), INDEX IDX_DE47DA0D4FFA7A88 (date_concert_id), PRIMARY KEY(concert_id, date_concert_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE concert_date_concert ADD CONSTRAINT FK_DE47DA0D83C97B2E FOREIGN KEY (concert_id) REFERENCES concert (id)');
        $this->addSql('ALTER TABLE concert_date_concert ADD CONSTRAINT FK_DE47DA0D4FFA7A88 FOREIGN KEY (date_concert_id) REFERENCES date_concert (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE concert DROP FOREIGN KEY FK_D57C02D24FFA7A88');
        $this->addSql('DROP INDEX IDX_D57C02D24FFA7A88 ON concert');
        $this->addSql('ALTER TABLE concert DROP date_concert_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE concert_date_concert DROP FOREIGN KEY FK_DE47DA0D83C97B2E');
        $this->addSql('ALTER TABLE concert_date_concert DROP FOREIGN KEY FK_DE47DA0D4FFA7A88');
        $this->addSql('DROP TABLE concert_date_concert');
        $this->addSql('ALTER TABLE concert ADD date_concert_id INT NOT NULL');
        $this->addSql('ALTER TABLE concert ADD CONSTRAINT FK_D57C02D24FFA7A88 FOREIGN KEY (date_concert_id) REFERENCES date_concert (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D57C02D24FFA7A88 ON concert (date_concert_id)');
    }
}
