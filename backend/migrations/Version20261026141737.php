<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261026141737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Replace remaining_duration with position in user_progress';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_progress DROP FOREIGN KEY `FK_C28C1646A76ED395`');
        $this->addSql('ALTER TABLE user_progress ADD position INT NOT NULL, DROP remaining_duration');
        $this->addSql('ALTER TABLE user_progress ADD CONSTRAINT FK_C28C1646A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_progress DROP FOREIGN KEY FK_C28C1646A76ED395');
        $this->addSql('ALTER TABLE user_progress ADD remaining_duration TIME NOT NULL, DROP position');
        $this->addSql('ALTER TABLE user_progress ADD CONSTRAINT `FK_C28C1646A76ED395` FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
