<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261012103648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Renomme viewing_time en duration et categorie_show_id en category_show_id';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `show` DROP FOREIGN KEY `FK_320ED9018F4252C6`');
        $this->addSql('DROP INDEX IDX_320ED9018F4252C6 ON `show`');
        $this->addSql('ALTER TABLE `show` CHANGE categorie_show_id category_show_id INT NOT NULL');
        $this->addSql('ALTER TABLE `show` ADD CONSTRAINT FK_320ED9011719BC1A FOREIGN KEY (category_show_id) REFERENCES categories_show (id)');
        $this->addSql('CREATE INDEX IDX_320ED9011719BC1A ON `show` (category_show_id)');
        $this->addSql('ALTER TABLE show_video CHANGE viewing_time duration TIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `show` DROP FOREIGN KEY FK_320ED9011719BC1A');
        $this->addSql('DROP INDEX IDX_320ED9011719BC1A ON `show`');
        $this->addSql('ALTER TABLE `show` CHANGE category_show_id categorie_show_id INT NOT NULL');
        $this->addSql('ALTER TABLE `show` ADD CONSTRAINT `FK_320ED9018F4252C6` FOREIGN KEY (categorie_show_id) REFERENCES categories_show (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_320ED9018F4252C6 ON `show` (categorie_show_id)');
        $this->addSql('ALTER TABLE show_video CHANGE duration viewing_time TIME NOT NULL');
    }
}
