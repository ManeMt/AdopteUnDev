<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250109195330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company CHANGE sector_id sector_id INT DEFAULT NULL, CHANGE location_id location_id INT DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE banner banner VARCHAR(255) DEFAULT NULL, CHANGE contact contact VARCHAR(255) DEFAULT NULL, CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE developer CHANGE first_name first_name VARCHAR(40) DEFAULT NULL, CHANGE last_name last_name VARCHAR(255) DEFAULT NULL, CHANGE min_salary min_salary DOUBLE PRECISION DEFAULT NULL, CHANGE level level INT DEFAULT NULL, CHANGE biography biography LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE developer CHANGE first_name first_name VARCHAR(40) NOT NULL, CHANGE last_name last_name VARCHAR(255) NOT NULL, CHANGE min_salary min_salary DOUBLE PRECISION NOT NULL, CHANGE level level INT NOT NULL, CHANGE biography biography LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE company CHANGE sector_id sector_id INT NOT NULL, CHANGE location_id location_id INT NOT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE banner banner VARCHAR(255) NOT NULL, CHANGE contact contact VARCHAR(255) NOT NULL, CHANGE description description LONGTEXT NOT NULL');
    }
}
