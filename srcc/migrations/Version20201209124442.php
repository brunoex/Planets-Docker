<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20201209124442 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE DATABASE IF NOT EXISTS symfony');
        $this->addSql('CREATE TABLE planets (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, day INT DEFAULT NULL, month INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql("INSERT INTO `symfony`.`planets` (`name`, `day`, `month`) VALUES ('Red planet', '42', '10'), ('Blue planet', '18', '18')");        
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE planets');
    }
}
