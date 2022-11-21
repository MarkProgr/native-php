<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221118131747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            'CREATE TABLE site_users (id int PRIMARY KEY AUTO_INCREMENT NOT NULL, 
        login varchar(30) UNIQUE NOT NULL, password varchar(100) NOT NULL, last_visited varchar(12) DEFAULT null)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE site_users');
    }
}
