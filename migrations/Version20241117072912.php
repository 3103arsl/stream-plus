<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241117072912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `user_address` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', line1 VARCHAR(255) NOT NULL, line2 VARCHAR(255) DEFAULT NULL, city VARCHAR(50) NOT NULL, state VARCHAR(50) NOT NULL, postal_code VARCHAR(15) NOT NULL, country VARCHAR(3) NOT NULL, INDEX IDX_5543718BA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `user_address` ADD CONSTRAINT FK_5543718BA76ED395 FOREIGN KEY (user_id) REFERENCES `users` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user_address` DROP FOREIGN KEY FK_5543718BA76ED395');
        $this->addSql('DROP TABLE `user_address`');
    }
}
