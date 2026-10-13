<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261013142555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Rend episode_number et saison_number nullables sur show_video';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE show_video CHANGE episode_number episode_number INT DEFAULT NULL, CHANGE saison_number saison_number INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE show_video CHANGE episode_number episode_number INT NOT NULL, CHANGE saison_number saison_number INT NOT NULL');
    }
}
