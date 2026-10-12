<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261012151946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Passe image_show et image_poster en NOT NULL';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `show` CHANGE image_show image_show VARCHAR(255) NOT NULL, CHANGE image_poster image_poster VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `show` CHANGE image_show image_show VARCHAR(255) DEFAULT NULL, CHANGE image_poster image_poster VARCHAR(255) DEFAULT NULL');
    }
}
