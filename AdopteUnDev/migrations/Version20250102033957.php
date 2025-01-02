<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250102033957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, sector_id INT NOT NULL, location_id INT NOT NULL, name VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, banner VARCHAR(255) NOT NULL, images LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', website VARCHAR(255) DEFAULT NULL, contact VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_4FBF094FDE95C867 (sector_id), INDEX IDX_4FBF094F64D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE developer (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, first_name VARCHAR(40) NOT NULL, last_name VARCHAR(255) NOT NULL, min_salary DOUBLE PRECISION NOT NULL, level INT NOT NULL, biography LONGTEXT NOT NULL, avatar VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_65FB8B9AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE developer_programing_language (developer_id INT NOT NULL, programing_language_id INT NOT NULL, INDEX IDX_FC2576B264DD9267 (developer_id), INDEX IDX_FC2576B252C89648 (programing_language_id), PRIMARY KEY(developer_id, programing_language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_add (id INT AUTO_INCREMENT NOT NULL, location_id INT NOT NULL, company_id INT NOT NULL, post_title VARCHAR(255) NOT NULL, level INT NOT NULL, salary DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_39CFE07664D218E (location_id), INDEX IDX_39CFE076979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_add_programing_language (job_add_id INT NOT NULL, programing_language_id INT NOT NULL, INDEX IDX_DDF5D8E6398FD26 (job_add_id), INDEX IDX_DDF5D8E52C89648 (programing_language_id), PRIMARY KEY(job_add_id, programing_language_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, entitled VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE programing_language (id INT AUTO_INCREMENT NOT NULL, entitled VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, developer_id INT NOT NULL, star_number INT NOT NULL, comment VARCHAR(255) NOT NULL, INDEX IDX_D889262264DD9267 (developer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sector (id INT AUTO_INCREMENT NOT NULL, entitled VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FDE95C867 FOREIGN KEY (sector_id) REFERENCES sector (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE developer ADD CONSTRAINT FK_65FB8B9AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE developer_programing_language ADD CONSTRAINT FK_FC2576B264DD9267 FOREIGN KEY (developer_id) REFERENCES developer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE developer_programing_language ADD CONSTRAINT FK_FC2576B252C89648 FOREIGN KEY (programing_language_id) REFERENCES programing_language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_add ADD CONSTRAINT FK_39CFE07664D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE job_add ADD CONSTRAINT FK_39CFE076979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE job_add_programing_language ADD CONSTRAINT FK_DDF5D8E6398FD26 FOREIGN KEY (job_add_id) REFERENCES job_add (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_add_programing_language ADD CONSTRAINT FK_DDF5D8E52C89648 FOREIGN KEY (programing_language_id) REFERENCES programing_language (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D889262264DD9267 FOREIGN KEY (developer_id) REFERENCES developer (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FDE95C867');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F64D218E');
        $this->addSql('ALTER TABLE developer DROP FOREIGN KEY FK_65FB8B9AA76ED395');
        $this->addSql('ALTER TABLE developer_programing_language DROP FOREIGN KEY FK_FC2576B264DD9267');
        $this->addSql('ALTER TABLE developer_programing_language DROP FOREIGN KEY FK_FC2576B252C89648');
        $this->addSql('ALTER TABLE job_add DROP FOREIGN KEY FK_39CFE07664D218E');
        $this->addSql('ALTER TABLE job_add DROP FOREIGN KEY FK_39CFE076979B1AD6');
        $this->addSql('ALTER TABLE job_add_programing_language DROP FOREIGN KEY FK_DDF5D8E6398FD26');
        $this->addSql('ALTER TABLE job_add_programing_language DROP FOREIGN KEY FK_DDF5D8E52C89648');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D889262264DD9267');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE developer');
        $this->addSql('DROP TABLE developer_programing_language');
        $this->addSql('DROP TABLE job_add');
        $this->addSql('DROP TABLE job_add_programing_language');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE programing_language');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE sector');
        $this->addSql('DROP TABLE user');
    }
}
