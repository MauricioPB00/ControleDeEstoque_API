<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240413152057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE horas_calculadas ADD dias_faltados VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE horas_calculadas ADD dias_trabalhados VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE horas_calculadas ADD dias_uteis VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE horas_calculadas ADD horas_faltando VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE horas_calculadas ADD horas_no_mes_trabalhadas VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE horas_calculadas ADD total_horas_dias_semana VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE horas_calculadas ADD total_horas_domingo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE horas_calculadas ADD total_horas_sabado VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE horas_calculadas DROP dias_faltados');
        $this->addSql('ALTER TABLE horas_calculadas DROP dias_trabalhados');
        $this->addSql('ALTER TABLE horas_calculadas DROP dias_uteis');
        $this->addSql('ALTER TABLE horas_calculadas DROP horas_faltando');
        $this->addSql('ALTER TABLE horas_calculadas DROP horas_no_mes_trabalhadas');
        $this->addSql('ALTER TABLE horas_calculadas DROP total_horas_dias_semana');
        $this->addSql('ALTER TABLE horas_calculadas DROP total_horas_domingo');
        $this->addSql('ALTER TABLE horas_calculadas DROP total_horas_sabado');
    }
}
