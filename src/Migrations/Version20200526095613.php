<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200526095613 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pizza DROP baking_time, CHANGE price price NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE recipe ADD price NUMERIC(10, 2) NOT NULL, CHANGE cooking_time cooking_time NUMERIC(5, 2) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pizza ADD baking_time INT NOT NULL, CHANGE price price NUMERIC(5, 2) NOT NULL');
        $this->addSql('ALTER TABLE recipe DROP price, CHANGE cooking_time cooking_time INT NOT NULL');
    }
}
