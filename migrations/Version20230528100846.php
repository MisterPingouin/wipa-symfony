<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230528100846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fav_photo DROP FOREIGN KEY fav_photo_ibfk_3');
        $this->addSql('ALTER TABLE fav_photo DROP FOREIGN KEY fav_photo_ibfk_4');
        $this->addSql('ALTER TABLE follower_followed DROP FOREIGN KEY follower_followed_ibfk_1');
        $this->addSql('DROP TABLE fav_photo');
        $this->addSql('DROP TABLE follower_followed');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY photo_ibfk_1');
        $this->addSql('DROP INDEX photo_user_id ON photo');
        $this->addSql('ALTER TABLE photo DROP user_id, CHANGE link link VARCHAR(255) NOT NULL, CHANGE prompt prompt LONGTEXT NOT NULL, CHANGE description description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE user DROP role');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fav_photo (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, photo_id INT NOT NULL, INDEX photo_id (photo_id), INDEX user_id (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE follower_followed (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, follower_id INT DEFAULT NULL, INDEX following_id (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_0900_ai_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE fav_photo ADD CONSTRAINT fav_photo_ibfk_3 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fav_photo ADD CONSTRAINT fav_photo_ibfk_4 FOREIGN KEY (photo_id) REFERENCES photo (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE follower_followed ADD CONSTRAINT follower_followed_ibfk_1 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE photo ADD user_id INT NOT NULL, CHANGE link link VARCHAR(2048) NOT NULL, CHANGE prompt prompt TEXT NOT NULL, CHANGE description description TEXT NOT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT photo_ibfk_1 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('CREATE INDEX photo_user_id ON photo (user_id)');
        $this->addSql('ALTER TABLE user ADD role VARCHAR(20) NOT NULL');
    }
}
