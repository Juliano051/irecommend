<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230402145857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recomendation (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, client_id INT NOT NULL, message LONGTEXT DEFAULT NULL, INDEX IDX_BE5A2BE74584665A (product_id), INDEX IDX_BE5A2BE719EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recomendation ADD CONSTRAINT FK_BE5A2BE74584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE recomendation ADD CONSTRAINT FK_BE5A2BE719EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recomendation DROP FOREIGN KEY FK_BE5A2BE74584665A');
        $this->addSql('ALTER TABLE recomendation DROP FOREIGN KEY FK_BE5A2BE719EB6921');
        $this->addSql('DROP TABLE recomendation');
    }
}
