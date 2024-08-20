<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240610160115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE calculo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE feriado_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE horas_calculadas_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE user_date_time_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE calculo (id INT NOT NULL, user_id INT NOT NULL, date DATE DEFAULT NULL, time TIME(0) WITHOUT TIME ZONE DEFAULT NULL, weekend VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D7B46581A76ED395 ON calculo (user_id)');
        $this->addSql('CREATE TABLE feriado (id INT NOT NULL, dia DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE horas_calculadas (id INT NOT NULL, user_id INT NOT NULL, mes VARCHAR(255) DEFAULT NULL, ano VARCHAR(255) NOT NULL, dias_faltados VARCHAR(255) DEFAULT NULL, dias_trabalhados VARCHAR(255) DEFAULT NULL, dias_uteis VARCHAR(255) DEFAULT NULL, horas_faltando VARCHAR(255) DEFAULT NULL, horas_no_mes_trabalhadas VARCHAR(255) DEFAULT NULL, total_horas_dias_semana VARCHAR(255) DEFAULT NULL, total_horas_domingo VARCHAR(255) DEFAULT NULL, total_horas_sabado VARCHAR(255) DEFAULT NULL, progresso VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E2F897EAA76ED395 ON horas_calculadas (user_id)');
        $this->addSql('CREATE TABLE user_date_time (id INT NOT NULL, user_id INT NOT NULL, date DATE DEFAULT NULL, time TIME(0) WITHOUT TIME ZONE DEFAULT NULL, insert VARCHAR(255) DEFAULT NULL, update VARCHAR(255) DEFAULT NULL, horaeditada VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4FAA9C55A76ED395 ON user_date_time (user_id)');
        $this->addSql('ALTER TABLE calculo ADD CONSTRAINT FK_D7B46581A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE horas_calculadas ADD CONSTRAINT FK_E2F897EAA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_date_time ADD CONSTRAINT FK_4FAA9C55A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" DROP hor_ini');
        $this->addSql('ALTER TABLE "user" DROP hor_ini_fim');
        $this->addSql('ALTER TABLE "user" DROP hor_ini_aft');
        $this->addSql('ALTER TABLE "user" DROP hor_fim_aft');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE calculo_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE feriado_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE horas_calculadas_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE user_date_time_id_seq CASCADE');
        $this->addSql('ALTER TABLE calculo DROP CONSTRAINT FK_D7B46581A76ED395');
        $this->addSql('ALTER TABLE horas_calculadas DROP CONSTRAINT FK_E2F897EAA76ED395');
        $this->addSql('ALTER TABLE user_date_time DROP CONSTRAINT FK_4FAA9C55A76ED395');
        $this->addSql('DROP TABLE calculo');
        $this->addSql('DROP TABLE feriado');
        $this->addSql('DROP TABLE horas_calculadas');
        $this->addSql('DROP TABLE user_date_time');
        $this->addSql('ALTER TABLE "user" ADD hor_ini VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD hor_ini_fim VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD hor_ini_aft VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD hor_fim_aft VARCHAR(255) DEFAULT NULL');
    }
}
