<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260928155105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE show_video DROP FOREIGN KEY `FK_7E76BEF0D0C1FC64`');
        $this->addSql('ALTER TABLE show_video ADD CONSTRAINT FK_7E76BEF0D0C1FC64 FOREIGN KEY (show_id) REFERENCES `show` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_lectures DROP FOREIGN KEY `FK_834585D010A5E1A1`');
        $this->addSql('ALTER TABLE user_lectures ADD CONSTRAINT FK_834585D010A5E1A1 FOREIGN KEY (show_video_id) REFERENCES show_video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_list_show DROP FOREIGN KEY `FK_77208B0CD0C1FC64`');
        $this->addSql('ALTER TABLE user_list_show ADD CONSTRAINT FK_77208B0CD0C1FC64 FOREIGN KEY (show_id) REFERENCES `show` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE show_video DROP FOREIGN KEY FK_7E76BEF0D0C1FC64');
        $this->addSql('ALTER TABLE show_video ADD CONSTRAINT `FK_7E76BEF0D0C1FC64` FOREIGN KEY (show_id) REFERENCES `show` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_lectures DROP FOREIGN KEY FK_834585D010A5E1A1');
        $this->addSql('ALTER TABLE user_lectures ADD CONSTRAINT `FK_834585D010A5E1A1` FOREIGN KEY (show_video_id) REFERENCES show_video (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_list_show DROP FOREIGN KEY FK_77208B0CD0C1FC64');
        $this->addSql('ALTER TABLE user_list_show ADD CONSTRAINT `FK_77208B0CD0C1FC64` FOREIGN KEY (show_id) REFERENCES `show` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
