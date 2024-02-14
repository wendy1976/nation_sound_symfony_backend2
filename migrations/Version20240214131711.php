<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240214131711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE concert DROP INDEX UNIQ_D57C02D24FFA7A88, ADD INDEX IDX_D57C02D24FFA7A88 (date_concert_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE concert DROP INDEX IDX_D57C02D24FFA7A88, ADD UNIQUE INDEX UNIQ_D57C02D24FFA7A88 (date_concert_id)');
    }
}
