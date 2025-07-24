<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250723200356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie_director DROP FOREIGN KEY movie_director_ibfk_1');
        $this->addSql('ALTER TABLE movie_director DROP FOREIGN KEY movie_director_ibfk_2');
        $this->addSql('ALTER TABLE movie_genre DROP FOREIGN KEY movie_genre_ibfk_2');
        $this->addSql('ALTER TABLE movie_genre DROP FOREIGN KEY movie_genre_ibfk_1');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY review_ibfk_1');
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY review_ibfk_2');
        $this->addSql('DROP TABLE director');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE movie_director');
        $this->addSql('DROP TABLE movie_genre');
        $this->addSql('DROP TABLE review');
        $this->addSql('ALTER TABLE user MODIFY id_user INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON user');
        $this->addSql('ALTER TABLE user DROP nickname, CHANGE email email VARCHAR(180) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE roles roles JSON NOT NULL, CHANGE id_user id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON user (email)');
        $this->addSql('ALTER TABLE user ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE director (id_director INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, last_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id_director)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE genre (id_genre INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id_genre)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE movie (id_movie INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, release_year DATE DEFAULT \'NULL\', synopsis TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, duration TIME DEFAULT \'NULL\', PRIMARY KEY(id_movie)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE movie_director (id_movie_director INT AUTO_INCREMENT NOT NULL, id_movie INT DEFAULT NULL, id_director INT DEFAULT NULL, INDEX id_movie (id_movie), INDEX id_director (id_director), PRIMARY KEY(id_movie_director)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE movie_genre (id_movie_genre INT AUTO_INCREMENT NOT NULL, id_genre INT DEFAULT NULL, id_movie INT DEFAULT NULL, INDEX id_movie (id_movie), INDEX id_genre (id_genre), PRIMARY KEY(id_movie_genre)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE review (id_review INT AUTO_INCREMENT NOT NULL, id_user INT DEFAULT NULL, id_movie INT DEFAULT NULL, rate SMALLINT DEFAULT NULL, review TEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_general_ci`, approved TINYINT(1) DEFAULT NULL, INDEX id_user (id_user), INDEX id_movie (id_movie), PRIMARY KEY(id_review)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE movie_director ADD CONSTRAINT movie_director_ibfk_1 FOREIGN KEY (id_movie) REFERENCES movie (id_movie)');
        $this->addSql('ALTER TABLE movie_director ADD CONSTRAINT movie_director_ibfk_2 FOREIGN KEY (id_director) REFERENCES director (id_director)');
        $this->addSql('ALTER TABLE movie_genre ADD CONSTRAINT movie_genre_ibfk_2 FOREIGN KEY (id_genre) REFERENCES genre (id_genre)');
        $this->addSql('ALTER TABLE movie_genre ADD CONSTRAINT movie_genre_ibfk_1 FOREIGN KEY (id_movie) REFERENCES movie (id_movie)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT review_ibfk_1 FOREIGN KEY (id_user) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT review_ibfk_2 FOREIGN KEY (id_movie) REFERENCES movie (id_movie)');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE user MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_EMAIL ON user');
        $this->addSql('DROP INDEX `PRIMARY` ON user');
        $this->addSql('ALTER TABLE user ADD nickname VARCHAR(255) DEFAULT \'NULL\', CHANGE email email VARCHAR(255) DEFAULT \'NULL\', CHANGE roles roles LONGTEXT DEFAULT NULL COLLATE `utf8mb4_bin`, CHANGE password password VARCHAR(255) DEFAULT \'NULL\', CHANGE id id_user INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user ADD PRIMARY KEY (id_user)');
    }
}
