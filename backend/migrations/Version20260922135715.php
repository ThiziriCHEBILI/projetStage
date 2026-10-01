<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260922135715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories_show (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE `show` (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(30) NOT NULL, description LONGTEXT NOT NULL, date_publication DATE NOT NULL, release_date DATE NOT NULL, categorie_show_id INT NOT NULL, INDEX IDX_320ED9018F4252C6 (categorie_show_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE show_video (id INT AUTO_INCREMENT NOT NULL, description_video LONGTEXT NOT NULL, image_video VARCHAR(255) NOT NULL, url_video VARCHAR(255) NOT NULL, episode_number INT NOT NULL, saison_number INT NOT NULL, video_quality VARCHAR(10) NOT NULL, viewing_time TIME NOT NULL, show_id INT NOT NULL, INDEX IDX_7E76BEF0D0C1FC64 (show_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user_lectures (id INT AUTO_INCREMENT NOT NULL, remaining_duration TIME NOT NULL, last_watched DATE NOT NULL, user_id INT NOT NULL, show_video_id INT NOT NULL, INDEX IDX_834585D0A76ED395 (user_id), INDEX IDX_834585D010A5E1A1 (show_video_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user_list_show (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, show_id INT NOT NULL, INDEX IDX_77208B0CA76ED395 (user_id), INDEX IDX_77208B0CD0C1FC64 (show_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, surname VARCHAR(25) NOT NULL, name VARCHAR(25) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(255) NOT NULL, date_registration DATE NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE `show` ADD CONSTRAINT FK_320ED9018F4252C6 FOREIGN KEY (categorie_show_id) REFERENCES categories_show (id)');
        $this->addSql('ALTER TABLE show_video ADD CONSTRAINT FK_7E76BEF0D0C1FC64 FOREIGN KEY (show_id) REFERENCES `show` (id)');
        $this->addSql('ALTER TABLE user_lectures ADD CONSTRAINT FK_834585D0A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_lectures ADD CONSTRAINT FK_834585D010A5E1A1 FOREIGN KEY (show_video_id) REFERENCES show_video (id)');
        $this->addSql('ALTER TABLE user_list_show ADD CONSTRAINT FK_77208B0CA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_list_show ADD CONSTRAINT FK_77208B0CD0C1FC64 FOREIGN KEY (show_id) REFERENCES `show` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `show` DROP FOREIGN KEY FK_320ED9018F4252C6');
        $this->addSql('ALTER TABLE show_video DROP FOREIGN KEY FK_7E76BEF0D0C1FC64');
        $this->addSql('ALTER TABLE user_lectures DROP FOREIGN KEY FK_834585D0A76ED395');
        $this->addSql('ALTER TABLE user_lectures DROP FOREIGN KEY FK_834585D010A5E1A1');
        $this->addSql('ALTER TABLE user_list_show DROP FOREIGN KEY FK_77208B0CA76ED395');
        $this->addSql('ALTER TABLE user_list_show DROP FOREIGN KEY FK_77208B0CD0C1FC64');
        $this->addSql('DROP TABLE categories_show');
        $this->addSql('DROP TABLE `show`');
        $this->addSql('DROP TABLE show_video');
        $this->addSql('DROP TABLE user_lectures');
        $this->addSql('DROP TABLE user_list_show');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
