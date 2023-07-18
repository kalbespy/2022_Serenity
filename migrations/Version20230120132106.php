<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230120132106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE welfare_user (welfare_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_C73D263F5B8B8A14 (welfare_id), INDEX IDX_C73D263FA76ED395 (user_id), PRIMARY KEY(welfare_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE welfare_user ADD CONSTRAINT FK_C73D263F5B8B8A14 FOREIGN KEY (welfare_id) REFERENCES welfare (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE welfare_user ADD CONSTRAINT FK_C73D263FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE welfare_user DROP FOREIGN KEY FK_C73D263F5B8B8A14');
        $this->addSql('ALTER TABLE welfare_user DROP FOREIGN KEY FK_C73D263FA76ED395');
        $this->addSql('DROP TABLE welfare_user');
    }
}
