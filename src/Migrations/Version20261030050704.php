<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261030050704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // Table already created (id only) by Version20261030045757
        $this->addSql('ALTER TABLE fitness_class ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE fitness_class ADD instructor VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE fitness_class ADD capacity INT NOT NULL');
        $this->addSql('ALTER TABLE fitness_class ADD starts_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE fitness_class DROP name');
        $this->addSql('ALTER TABLE fitness_class DROP instructor');
        $this->addSql('ALTER TABLE fitness_class DROP capacity');
        $this->addSql('ALTER TABLE fitness_class DROP starts_at');
    }
}
