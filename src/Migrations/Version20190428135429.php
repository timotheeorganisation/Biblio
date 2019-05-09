<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190428135429 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE subscribe (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscribe_user (subscribe_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_3A629B71C72A4771 (subscribe_id), INDEX IDX_3A629B71A76ED395 (user_id), PRIMARY KEY(subscribe_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscribe_subscription (subscribe_id INT NOT NULL, subscription_id INT NOT NULL, INDEX IDX_AC1B261AC72A4771 (subscribe_id), INDEX IDX_AC1B261A9A1887DC (subscription_id), PRIMARY KEY(subscribe_id, subscription_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE subscribe_user ADD CONSTRAINT FK_3A629B71C72A4771 FOREIGN KEY (subscribe_id) REFERENCES subscribe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscribe_user ADD CONSTRAINT FK_3A629B71A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscribe_subscription ADD CONSTRAINT FK_AC1B261AC72A4771 FOREIGN KEY (subscribe_id) REFERENCES subscribe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscribe_subscription ADD CONSTRAINT FK_AC1B261A9A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE subscribe_user DROP FOREIGN KEY FK_3A629B71C72A4771');
        $this->addSql('ALTER TABLE subscribe_subscription DROP FOREIGN KEY FK_AC1B261AC72A4771');
        $this->addSql('DROP TABLE subscribe');
        $this->addSql('DROP TABLE subscribe_user');
        $this->addSql('DROP TABLE subscribe_subscription');
    }
}
