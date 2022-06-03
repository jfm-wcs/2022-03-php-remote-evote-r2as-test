<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220602190159 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(1024) DEFAULT NULL, uuid VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, state TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE proposal (id INT AUTO_INCREMENT NOT NULL, event_id_id INT NOT NULL, type INT NOT NULL, name VARCHAR(512) NOT NULL, INDEX IDX_BFE594723E5F2F7B (event_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE response_type1 (id INT AUTO_INCREMENT NOT NULL, event_id_id INT NOT NULL, user_id_id INT NOT NULL, proposal_id_id INT NOT NULL, positive INT DEFAULT NULL, negative INT DEFAULT NULL, abstention INT DEFAULT NULL, INDEX IDX_D19472DC3E5F2F7B (event_id_id), INDEX IDX_D19472DC9D86650F (user_id_id), INDEX IDX_D19472DCB8B357F6 (proposal_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, event_id_id INT NOT NULL, mail VARCHAR(255) NOT NULL, factor INT NOT NULL, uuid VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_1483A5E93E5F2F7B (event_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET UTF8 COLLATE `UTF8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE proposal ADD CONSTRAINT FK_BFE594723E5F2F7B FOREIGN KEY (event_id_id) REFERENCES events (id)');
        $this->addSql('ALTER TABLE response_type1 ADD CONSTRAINT FK_D19472DC3E5F2F7B FOREIGN KEY (event_id_id) REFERENCES events (id)');
        $this->addSql('ALTER TABLE response_type1 ADD CONSTRAINT FK_D19472DC9D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE response_type1 ADD CONSTRAINT FK_D19472DCB8B357F6 FOREIGN KEY (proposal_id_id) REFERENCES proposal (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E93E5F2F7B FOREIGN KEY (event_id_id) REFERENCES events (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE proposal DROP FOREIGN KEY FK_BFE594723E5F2F7B');
        $this->addSql('ALTER TABLE response_type1 DROP FOREIGN KEY FK_D19472DC3E5F2F7B');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E93E5F2F7B');
        $this->addSql('ALTER TABLE response_type1 DROP FOREIGN KEY FK_D19472DCB8B357F6');
        $this->addSql('ALTER TABLE response_type1 DROP FOREIGN KEY FK_D19472DC9D86650F');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE proposal');
        $this->addSql('DROP TABLE response_type1');
        $this->addSql('DROP TABLE users');
    }
}
