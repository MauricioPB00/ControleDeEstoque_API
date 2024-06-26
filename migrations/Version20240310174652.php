<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240310174652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_date_time ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_date_time ADD CONSTRAINT FK_4FAA9C55A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4FAA9C55A76ED395 ON user_date_time (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_date_time DROP CONSTRAINT FK_4FAA9C55A76ED395');
        $this->addSql('DROP INDEX IDX_4FAA9C55A76ED395');
        $this->addSql('ALTER TABLE user_date_time DROP user_id');
    }
}
