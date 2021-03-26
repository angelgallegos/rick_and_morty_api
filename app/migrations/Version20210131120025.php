<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210131120025 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `character` (id INT AUTO_INCREMENT NOT NULL, origin_id INT NOT NULL, location_id INT NOT NULL, external_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(100) NOT NULL, species VARCHAR(100) NOT NULL, type VARCHAR(100) DEFAULT NULL, gender VARCHAR(100) NOT NULL, image VARCHAR(100) DEFAULT NULL, INDEX IDX_937AB03456A273CC (origin_id), INDEX IDX_937AB03464D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `dimension` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE episode (id INT AUTO_INCREMENT NOT NULL, external_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, air_date DATE NOT NULL, episode VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE episode_character (episode_id INT NOT NULL, character_id INT NOT NULL, INDEX IDX_2DB8260D362B62A0 (episode_id), INDEX IDX_2DB8260D1136BE75 (character_id), PRIMARY KEY(episode_id, character_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, dimension_id INT NOT NULL, external_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_5E9E89CB277428AD (dimension_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB03456A273CC FOREIGN KEY (origin_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE `character` ADD CONSTRAINT FK_937AB03464D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE episode_character ADD CONSTRAINT FK_2DB8260D362B62A0 FOREIGN KEY (episode_id) REFERENCES episode (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE episode_character ADD CONSTRAINT FK_2DB8260D1136BE75 FOREIGN KEY (character_id) REFERENCES `character` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB277428AD FOREIGN KEY (dimension_id) REFERENCES `dimension` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode_character DROP FOREIGN KEY FK_2DB8260D1136BE75');
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB277428AD');
        $this->addSql('ALTER TABLE episode_character DROP FOREIGN KEY FK_2DB8260D362B62A0');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB03456A273CC');
        $this->addSql('ALTER TABLE `character` DROP FOREIGN KEY FK_937AB03464D218E');
        $this->addSql('DROP TABLE `character`');
        $this->addSql('DROP TABLE `dimension`');
        $this->addSql('DROP TABLE episode');
        $this->addSql('DROP TABLE episode_character');
        $this->addSql('DROP TABLE location');
    }
}
