<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240116142740 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location ADD icon_path VARCHAR(255) DEFAULT NULL, DROP icon, CHANGE coordinates coordinates JSON NOT NULL, CHANGE popup_content popup_content LONGTEXT DEFAULT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location ADD icon LONGTEXT NOT NULL COMMENT \'(DC2Type:object)\', DROP icon_path, CHANGE coordinates coordinates LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE popup_content popup_content LONGTEXT NOT NULL, CHANGE image image VARCHAR(255) NOT NULL');
    }
}
