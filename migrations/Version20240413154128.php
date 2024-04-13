<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240413154128 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horas_calculadas DROP horas_trabalhadas');
        $this->addSql('ALTER TABLE horas_calculadas DROP faltas');
        $this->addSql('ALTER TABLE horas_calculadas DROP horas_sabado');
        $this->addSql('ALTER TABLE horas_calculadas DROP horas_domingo');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE horas_calculadas ADD horas_trabalhadas VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE horas_calculadas ADD faltas VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE horas_calculadas ADD horas_sabado VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE horas_calculadas ADD horas_domingo VARCHAR(255) DEFAULT NULL');
    }
}
