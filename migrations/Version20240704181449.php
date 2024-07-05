<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704181449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pro ADD cat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pro ADD CONSTRAINT FK_6BB4D6FFE6ADA943 FOREIGN KEY (cat_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_6BB4D6FFE6ADA943 ON pro (cat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pro DROP FOREIGN KEY FK_6BB4D6FFE6ADA943');
        $this->addSql('DROP INDEX IDX_6BB4D6FFE6ADA943 ON pro');
        $this->addSql('ALTER TABLE pro DROP cat_id');
    }
}
