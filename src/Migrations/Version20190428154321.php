<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190428154321 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE subscribe_subscription');
        $this->addSql('DROP TABLE subscribe_user');
        $this->addSql('ALTER TABLE subscribe ADD user_id INT NOT NULL, ADD subscription_id INT NOT NULL');
        $this->addSql('ALTER TABLE subscribe ADD CONSTRAINT FK_68B95F3EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE subscribe ADD CONSTRAINT FK_68B95F3E9A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id)');
        $this->addSql('CREATE INDEX IDX_68B95F3EA76ED395 ON subscribe (user_id)');
        $this->addSql('CREATE INDEX IDX_68B95F3E9A1887DC ON subscribe (subscription_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE subscribe_subscription (subscribe_id INT NOT NULL, subscription_id INT NOT NULL, INDEX IDX_AC1B261AC72A4771 (subscribe_id), INDEX IDX_AC1B261A9A1887DC (subscription_id), PRIMARY KEY(subscribe_id, subscription_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE subscribe_user (subscribe_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_3A629B71C72A4771 (subscribe_id), INDEX IDX_3A629B71A76ED395 (user_id), PRIMARY KEY(subscribe_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE subscribe_subscription ADD CONSTRAINT FK_AC1B261A9A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscribe_subscription ADD CONSTRAINT FK_AC1B261AC72A4771 FOREIGN KEY (subscribe_id) REFERENCES subscribe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscribe_user ADD CONSTRAINT FK_3A629B71A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscribe_user ADD CONSTRAINT FK_3A629B71C72A4771 FOREIGN KEY (subscribe_id) REFERENCES subscribe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscribe DROP FOREIGN KEY FK_68B95F3EA76ED395');
        $this->addSql('ALTER TABLE subscribe DROP FOREIGN KEY FK_68B95F3E9A1887DC');
        $this->addSql('DROP INDEX IDX_68B95F3EA76ED395 ON subscribe');
        $this->addSql('DROP INDEX IDX_68B95F3E9A1887DC ON subscribe');
        $this->addSql('ALTER TABLE subscribe DROP user_id, DROP subscription_id');
    }
}
