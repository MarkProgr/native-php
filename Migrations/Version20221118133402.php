<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221118133402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE users (id int PRIMARY KEY AUTO_INCREMENT NOT NULL, 
            email varchar(25) UNIQUE NOT NULL, name varchar(30) NOT NULL, 
                gender varchar(10) NOT NULL, status varchar(10) NOT NULL, image_name varchar(40) DEFAULT null)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE users');
    }
}
