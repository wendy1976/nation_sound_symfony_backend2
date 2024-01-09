<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240109102054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE concert_pass (id INT AUTO_INCREMENT NOT NULL, concert_id INT DEFAULT NULL, pass_id INT DEFAULT NULL, INDEX IDX_6BCDE0E383C97B2E (concert_id), INDEX IDX_6BCDE0E3EC545AE5 (pass_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE concert_pass ADD CONSTRAINT FK_6BCDE0E383C97B2E FOREIGN KEY (concert_id) REFERENCES concert (id)');
        $this->addSql('ALTER TABLE concert_pass ADD CONSTRAINT FK_6BCDE0E3EC545AE5 FOREIGN KEY (pass_id) REFERENCES pass (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE concert_pass DROP FOREIGN KEY FK_6BCDE0E383C97B2E');
        $this->addSql('ALTER TABLE concert_pass DROP FOREIGN KEY FK_6BCDE0E3EC545AE5');
        $this->addSql('DROP TABLE concert_pass');
    }
}
