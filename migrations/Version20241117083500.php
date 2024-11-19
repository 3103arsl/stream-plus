<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241117083500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `user_payment_methods` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', card_number VARCHAR(16) NOT NULL, expiration_date VARCHAR(5) NOT NULL, cvv VARCHAR(3) NOT NULL, INDEX IDX_5D77950CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `user_payment_methods` ADD CONSTRAINT FK_5D77950CA76ED395 FOREIGN KEY (user_id) REFERENCES `users` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user_payment_methods` DROP FOREIGN KEY FK_5D77950CA76ED395');
        $this->addSql('DROP TABLE `user_payment_methods`');
    }
}
