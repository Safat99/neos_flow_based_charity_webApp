<?php

declare(strict_types=1);

namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240726071802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('DROP SEQUENCE donations_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE charity_donation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE charity_donation (id INT NOT NULL, organization_id INT NOT NULL, donation_code_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B28F550032C8A3DE ON charity_donation (organization_id)');
        $this->addSql('CREATE INDEX IDX_B28F5500D7602A7 ON charity_donation (donation_code_id)');
        $this->addSql('ALTER TABLE charity_donation ADD CONSTRAINT FK_B28F550032C8A3DE FOREIGN KEY (organization_id) REFERENCES organizations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE charity_donation ADD CONSTRAINT FK_B28F5500D7602A7 FOREIGN KEY (donation_code_id) REFERENCES donation_codes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE donations');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\PostgreSQL100Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\PostgreSQL100Platform'."
        );

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE charity_donation_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE donations_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE donations (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE charity_donation');
    }
}
