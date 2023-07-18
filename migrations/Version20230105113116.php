<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230105113116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE secretariat (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secretariat_document (secretariat_id INT NOT NULL, document_id INT NOT NULL, INDEX IDX_489C788AA628C492 (secretariat_id), INDEX IDX_489C788AC33F7837 (document_id), PRIMARY KEY(secretariat_id, document_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secretariat_medical_course (secretariat_id INT NOT NULL, medical_course_id INT NOT NULL, INDEX IDX_61CF5C2CA628C492 (secretariat_id), INDEX IDX_61CF5C2CAC6F9728 (medical_course_id), PRIMARY KEY(secretariat_id, medical_course_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secretariat_medical_discipline (secretariat_id INT NOT NULL, medical_discipline_id INT NOT NULL, INDEX IDX_B4CC2CEAA628C492 (secretariat_id), INDEX IDX_B4CC2CEA787AA6E3 (medical_discipline_id), PRIMARY KEY(secretariat_id, medical_discipline_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secretariat_schema_content (secretariat_id INT NOT NULL, schema_content_id INT NOT NULL, INDEX IDX_67F0E9E5A628C492 (secretariat_id), INDEX IDX_67F0E9E51DC54D21 (schema_content_id), PRIMARY KEY(secretariat_id, schema_content_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secretariat_video (secretariat_id INT NOT NULL, video_id INT NOT NULL, INDEX IDX_17657C3A628C492 (secretariat_id), INDEX IDX_17657C329C1004E (video_id), PRIMARY KEY(secretariat_id, video_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secretariat_checklist (secretariat_id INT NOT NULL, checklist_id INT NOT NULL, INDEX IDX_E8F226EAA628C492 (secretariat_id), INDEX IDX_E8F226EAB16D08A7 (checklist_id), PRIMARY KEY(secretariat_id, checklist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE secretariat_document ADD CONSTRAINT FK_489C788AA628C492 FOREIGN KEY (secretariat_id) REFERENCES secretariat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE secretariat_document ADD CONSTRAINT FK_489C788AC33F7837 FOREIGN KEY (document_id) REFERENCES document (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE secretariat_medical_course ADD CONSTRAINT FK_61CF5C2CA628C492 FOREIGN KEY (secretariat_id) REFERENCES secretariat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE secretariat_medical_course ADD CONSTRAINT FK_61CF5C2CAC6F9728 FOREIGN KEY (medical_course_id) REFERENCES medical_course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE secretariat_medical_discipline ADD CONSTRAINT FK_B4CC2CEAA628C492 FOREIGN KEY (secretariat_id) REFERENCES secretariat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE secretariat_medical_discipline ADD CONSTRAINT FK_B4CC2CEA787AA6E3 FOREIGN KEY (medical_discipline_id) REFERENCES medical_discipline (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE secretariat_schema_content ADD CONSTRAINT FK_67F0E9E5A628C492 FOREIGN KEY (secretariat_id) REFERENCES secretariat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE secretariat_schema_content ADD CONSTRAINT FK_67F0E9E51DC54D21 FOREIGN KEY (schema_content_id) REFERENCES `schema_content` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE secretariat_video ADD CONSTRAINT FK_17657C3A628C492 FOREIGN KEY (secretariat_id) REFERENCES secretariat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE secretariat_video ADD CONSTRAINT FK_17657C329C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE secretariat_checklist ADD CONSTRAINT FK_E8F226EAA628C492 FOREIGN KEY (secretariat_id) REFERENCES secretariat (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE secretariat_checklist ADD CONSTRAINT FK_E8F226EAB16D08A7 FOREIGN KEY (checklist_id) REFERENCES checklist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD secretariat_id INT NOT NULL, CHANGE phonenumber phonenumber VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A628C492 FOREIGN KEY (secretariat_id) REFERENCES secretariat (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649A628C492 ON user (secretariat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A628C492');
        $this->addSql('ALTER TABLE secretariat_document DROP FOREIGN KEY FK_489C788AA628C492');
        $this->addSql('ALTER TABLE secretariat_document DROP FOREIGN KEY FK_489C788AC33F7837');
        $this->addSql('ALTER TABLE secretariat_medical_course DROP FOREIGN KEY FK_61CF5C2CA628C492');
        $this->addSql('ALTER TABLE secretariat_medical_course DROP FOREIGN KEY FK_61CF5C2CAC6F9728');
        $this->addSql('ALTER TABLE secretariat_medical_discipline DROP FOREIGN KEY FK_B4CC2CEAA628C492');
        $this->addSql('ALTER TABLE secretariat_medical_discipline DROP FOREIGN KEY FK_B4CC2CEA787AA6E3');
        $this->addSql('ALTER TABLE secretariat_schema_content DROP FOREIGN KEY FK_67F0E9E5A628C492');
        $this->addSql('ALTER TABLE secretariat_schema_content DROP FOREIGN KEY FK_67F0E9E51DC54D21');
        $this->addSql('ALTER TABLE secretariat_video DROP FOREIGN KEY FK_17657C3A628C492');
        $this->addSql('ALTER TABLE secretariat_video DROP FOREIGN KEY FK_17657C329C1004E');
        $this->addSql('ALTER TABLE secretariat_checklist DROP FOREIGN KEY FK_E8F226EAA628C492');
        $this->addSql('ALTER TABLE secretariat_checklist DROP FOREIGN KEY FK_E8F226EAB16D08A7');
        $this->addSql('DROP TABLE secretariat');
        $this->addSql('DROP TABLE secretariat_document');
        $this->addSql('DROP TABLE secretariat_medical_course');
        $this->addSql('DROP TABLE secretariat_medical_discipline');
        $this->addSql('DROP TABLE secretariat_schema_content');
        $this->addSql('DROP TABLE secretariat_video');
        $this->addSql('DROP TABLE secretariat_checklist');
        $this->addSql('DROP INDEX IDX_8D93D649A628C492 ON user');
        $this->addSql('ALTER TABLE user DROP secretariat_id, CHANGE phonenumber phonenumber INT NOT NULL');
    }
}
