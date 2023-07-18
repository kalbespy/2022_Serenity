<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221214211247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `schemaContent` (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, picture VARCHAR(255) NOT NULL, INDEX IDX_972640E412469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `schemaContent` ADD CONSTRAINT FK_972640E412469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('DROP TABLE `schema`');
        $this->addSql('DROP TABLE content');
        $this->addSql('ALTER TABLE checklist ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE checklist ADD CONSTRAINT FK_5C696D2F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_5C696D2F12469DE2 ON checklist (category_id)');
        $this->addSql('ALTER TABLE document ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_D8698A7612469DE2 ON document (category_id)');
        $this->addSql('ALTER TABLE medical_course ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE medical_course ADD CONSTRAINT FK_7DC0D81612469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_7DC0D81612469DE2 ON medical_course (category_id)');
        $this->addSql('ALTER TABLE medical_discipline ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE medical_discipline ADD CONSTRAINT FK_5EFFC7F312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_5EFFC7F312469DE2 ON medical_discipline (category_id)');
        $this->addSql('ALTER TABLE video ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_7CC7DA2C12469DE2 ON video (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `schema` (id INT AUTO_INCREMENT NOT NULL, picture VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, picture VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, is_checked TINYINT(1) NOT NULL, description LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_FEC530A912469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `schemaContent` DROP FOREIGN KEY FK_972640E412469DE2');
        $this->addSql('DROP TABLE `schemaContent`');
        $this->addSql('ALTER TABLE medical_course DROP FOREIGN KEY FK_7DC0D81612469DE2');
        $this->addSql('DROP INDEX IDX_7DC0D81612469DE2 ON medical_course');
        $this->addSql('ALTER TABLE medical_course DROP category_id');
        $this->addSql('ALTER TABLE checklist DROP FOREIGN KEY FK_5C696D2F12469DE2');
        $this->addSql('DROP INDEX IDX_5C696D2F12469DE2 ON checklist');
        $this->addSql('ALTER TABLE checklist DROP category_id');
        $this->addSql('ALTER TABLE medical_discipline DROP FOREIGN KEY FK_5EFFC7F312469DE2');
        $this->addSql('DROP INDEX IDX_5EFFC7F312469DE2 ON medical_discipline');
        $this->addSql('ALTER TABLE medical_discipline DROP category_id');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A7612469DE2');
        $this->addSql('DROP INDEX IDX_D8698A7612469DE2 ON document');
        $this->addSql('ALTER TABLE document DROP category_id');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C12469DE2');
        $this->addSql('DROP INDEX IDX_7CC7DA2C12469DE2 ON video');
        $this->addSql('ALTER TABLE video DROP category_id');
    }
}
