<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230109161315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_checklist (id INT AUTO_INCREMENT NOT NULL, checklist_id INT DEFAULT NULL, user_id INT DEFAULT NULL, is_checked TINYINT(1) NOT NULL, checked_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_5C89E0CBB16D08A7 (checklist_id), INDEX IDX_5C89E0CBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_document (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, document_id INT DEFAULT NULL, is_checked TINYINT(1) NOT NULL, checked_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_38E46E76A76ED395 (user_id), INDEX IDX_38E46E76C33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_med_discipline (id INT AUTO_INCREMENT NOT NULL, medical_discipline_id INT DEFAULT NULL, user_id INT DEFAULT NULL, is_checked TINYINT(1) NOT NULL, checked_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_C4E3C87D787AA6E3 (medical_discipline_id), INDEX IDX_C4E3C87DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_medical_course (id INT AUTO_INCREMENT NOT NULL, medical_course_id INT DEFAULT NULL, user_id INT DEFAULT NULL, is_checked TINYINT(1) NOT NULL, checked_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_1645074FAC6F9728 (medical_course_id), INDEX IDX_1645074FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_schema_content (id INT AUTO_INCREMENT NOT NULL, schema_content_id INT DEFAULT NULL, user_id INT DEFAULT NULL, is_checked TINYINT(1) NOT NULL, checked_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_107AB2861DC54D21 (schema_content_id), INDEX IDX_107AB286A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_video (id INT AUTO_INCREMENT NOT NULL, video_id INT DEFAULT NULL, user_id INT DEFAULT NULL, is_checked TINYINT(1) NOT NULL, checked_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9E05217429C1004E (video_id), INDEX IDX_9E052174A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_checklist ADD CONSTRAINT FK_5C89E0CBB16D08A7 FOREIGN KEY (checklist_id) REFERENCES checklist (id)');
        $this->addSql('ALTER TABLE user_checklist ADD CONSTRAINT FK_5C89E0CBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_document ADD CONSTRAINT FK_38E46E76A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_document ADD CONSTRAINT FK_38E46E76C33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE user_med_discipline ADD CONSTRAINT FK_C4E3C87D787AA6E3 FOREIGN KEY (medical_discipline_id) REFERENCES medical_discipline (id)');
        $this->addSql('ALTER TABLE user_med_discipline ADD CONSTRAINT FK_C4E3C87DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_medical_course ADD CONSTRAINT FK_1645074FAC6F9728 FOREIGN KEY (medical_course_id) REFERENCES medical_course (id)');
        $this->addSql('ALTER TABLE user_medical_course ADD CONSTRAINT FK_1645074FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_schema_content ADD CONSTRAINT FK_107AB2861DC54D21 FOREIGN KEY (schema_content_id) REFERENCES `schema_content` (id)');
        $this->addSql('ALTER TABLE user_schema_content ADD CONSTRAINT FK_107AB286A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_video ADD CONSTRAINT FK_9E05217429C1004E FOREIGN KEY (video_id) REFERENCES video (id)');
        $this->addSql('ALTER TABLE user_video ADD CONSTRAINT FK_9E052174A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE document ADD user_document_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A766A24B1A2 FOREIGN KEY (user_document_id) REFERENCES user_document (id)');
        $this->addSql('CREATE INDEX IDX_D8698A766A24B1A2 ON document (user_document_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A766A24B1A2');
        $this->addSql('ALTER TABLE user_checklist DROP FOREIGN KEY FK_5C89E0CBB16D08A7');
        $this->addSql('ALTER TABLE user_checklist DROP FOREIGN KEY FK_5C89E0CBA76ED395');
        $this->addSql('ALTER TABLE user_document DROP FOREIGN KEY FK_38E46E76A76ED395');
        $this->addSql('ALTER TABLE user_document DROP FOREIGN KEY FK_38E46E76C33F7837');
        $this->addSql('ALTER TABLE user_med_discipline DROP FOREIGN KEY FK_C4E3C87D787AA6E3');
        $this->addSql('ALTER TABLE user_med_discipline DROP FOREIGN KEY FK_C4E3C87DA76ED395');
        $this->addSql('ALTER TABLE user_medical_course DROP FOREIGN KEY FK_1645074FAC6F9728');
        $this->addSql('ALTER TABLE user_medical_course DROP FOREIGN KEY FK_1645074FA76ED395');
        $this->addSql('ALTER TABLE user_schema_content DROP FOREIGN KEY FK_107AB2861DC54D21');
        $this->addSql('ALTER TABLE user_schema_content DROP FOREIGN KEY FK_107AB286A76ED395');
        $this->addSql('ALTER TABLE user_video DROP FOREIGN KEY FK_9E05217429C1004E');
        $this->addSql('ALTER TABLE user_video DROP FOREIGN KEY FK_9E052174A76ED395');
        $this->addSql('DROP TABLE user_checklist');
        $this->addSql('DROP TABLE user_document');
        $this->addSql('DROP TABLE user_med_discipline');
        $this->addSql('DROP TABLE user_medical_course');
        $this->addSql('DROP TABLE user_schema_content');
        $this->addSql('DROP TABLE user_video');
        $this->addSql('DROP INDEX IDX_D8698A766A24B1A2 ON document');
        $this->addSql('ALTER TABLE document DROP user_document_id');
    }
}
