<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261012170647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Renomme UserLectures en UserProgress et UserListShow en UserShowList, avec des cles primaires composites';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_progress (remaining_duration TIME NOT NULL, last_watched DATETIME NOT NULL, user_id INT NOT NULL, show_video_id INT NOT NULL, INDEX IDX_C28C1646A76ED395 (user_id), INDEX IDX_C28C164610A5E1A1 (show_video_id), PRIMARY KEY (user_id, show_video_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user_show_list (user_id INT NOT NULL, show_id INT NOT NULL, INDEX IDX_98DFA33FA76ED395 (user_id), INDEX IDX_98DFA33FD0C1FC64 (show_id), PRIMARY KEY (user_id, show_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE user_progress ADD CONSTRAINT FK_C28C1646A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_progress ADD CONSTRAINT FK_C28C164610A5E1A1 FOREIGN KEY (show_video_id) REFERENCES show_video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_show_list ADD CONSTRAINT FK_98DFA33FA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_show_list ADD CONSTRAINT FK_98DFA33FD0C1FC64 FOREIGN KEY (show_id) REFERENCES `show` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_lectures DROP FOREIGN KEY `FK_834585D010A5E1A1`');
        $this->addSql('ALTER TABLE user_lectures DROP FOREIGN KEY `FK_834585D0A76ED395`');
        $this->addSql('ALTER TABLE user_list_show DROP FOREIGN KEY `FK_77208B0CA76ED395`');
        $this->addSql('ALTER TABLE user_list_show DROP FOREIGN KEY `FK_77208B0CD0C1FC64`');
        $this->addSql('DROP TABLE user_lectures');
        $this->addSql('DROP TABLE user_list_show');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_lectures (id INT AUTO_INCREMENT NOT NULL, remaining_duration TIME NOT NULL, last_watched DATE NOT NULL, user_id INT NOT NULL, show_video_id INT NOT NULL, INDEX IDX_834585D0A76ED395 (user_id), INDEX IDX_834585D010A5E1A1 (show_video_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user_list_show (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, show_id INT NOT NULL, INDEX IDX_77208B0CA76ED395 (user_id), INDEX IDX_77208B0CD0C1FC64 (show_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_lectures ADD CONSTRAINT `FK_834585D010A5E1A1` FOREIGN KEY (show_video_id) REFERENCES show_video (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_lectures ADD CONSTRAINT `FK_834585D0A76ED395` FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_list_show ADD CONSTRAINT `FK_77208B0CA76ED395` FOREIGN KEY (user_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user_list_show ADD CONSTRAINT `FK_77208B0CD0C1FC64` FOREIGN KEY (show_id) REFERENCES `show` (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_progress DROP FOREIGN KEY FK_C28C1646A76ED395');
        $this->addSql('ALTER TABLE user_progress DROP FOREIGN KEY FK_C28C164610A5E1A1');
        $this->addSql('ALTER TABLE user_show_list DROP FOREIGN KEY FK_98DFA33FA76ED395');
        $this->addSql('ALTER TABLE user_show_list DROP FOREIGN KEY FK_98DFA33FD0C1FC64');
        $this->addSql('DROP TABLE user_progress');
        $this->addSql('DROP TABLE user_show_list');
    }
}
