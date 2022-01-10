<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220110150009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE issues_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE issues (id INT NOT NULL, super_heavy_problem BOOLEAN DEFAULT NULL, invalid_address_problem BOOLEAN DEFAULT NULL, email_problem BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE "order" ADD issues_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398321088B FOREIGN KEY (issues_id) REFERENCES issues (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F5299398321088B ON "order" (issues_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F5299398321088B');
        $this->addSql('DROP SEQUENCE issues_id_seq CASCADE');
        $this->addSql('DROP TABLE issues');
        $this->addSql('DROP INDEX UNIQ_F5299398321088B');
        $this->addSql('ALTER TABLE "order" DROP issues_id');
    }
}
