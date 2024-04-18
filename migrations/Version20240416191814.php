<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240416191814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" DROP hor_ini');
        $this->addSql('ALTER TABLE "user" DROP hor_ini_fim');
        $this->addSql('ALTER TABLE "user" DROP hor_ini_aft');
        $this->addSql('ALTER TABLE "user" DROP hor_fim_aft');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" ADD hor_ini VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD hor_ini_fim VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD hor_ini_aft VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD hor_fim_aft VARCHAR(255) DEFAULT NULL');
    }
}
