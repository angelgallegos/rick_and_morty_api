<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201095852 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location DROP FOREIGN KEY FK_5E9E89CB277428AD');
        $this->addSql('DROP INDEX IDX_5E9E89CB277428AD ON location');
        $this->addSql('ALTER TABLE location ADD dimension VARCHAR(255) NOT NULL, DROP dimension_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE location ADD dimension_id INT NOT NULL, DROP dimension');
        $this->addSql('ALTER TABLE location ADD CONSTRAINT FK_5E9E89CB277428AD FOREIGN KEY (dimension_id) REFERENCES dimension (id)');
        $this->addSql('CREATE INDEX IDX_5E9E89CB277428AD ON location (dimension_id)');
    }
}
