<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210707022653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prices (pizza_id UUID NOT NULL, property_id UUID NOT NULL, name VARCHAR(255), price INT NOT NULL, PRIMARY KEY(pizza_id, property_id))');
        $this->addSql('CREATE INDEX IDX_E4CB6D59D41D1D42 ON prices (pizza_id)');
        $this->addSql('CREATE INDEX IDX_E4CB6D59549213EC ON prices (property_id)');
        $this->addSql('COMMENT ON COLUMN prices.pizza_id IS \'(DC2Type:pizza_id)\'');
        $this->addSql('ALTER TABLE prices ADD CONSTRAINT FK_E4CB6D59D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizzas (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prices ADD CONSTRAINT FK_E4CB6D59549213EC FOREIGN KEY (property_id) REFERENCES properties (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE properties ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE properties ALTER id DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE prices');
        $this->addSql('ALTER TABLE properties ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE properties ALTER id DROP DEFAULT');
    }
}
