<?php declare(strict_types=1);

namespace YOC\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181107212315 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("INSERT INTO `cities` (`id`, `country_id`, `city_name`) VALUES
            (1, 51, 'Berlin'),
            (2, 51, 'Düsseldorf'),
            (3, 62, 'Madrid'),
            (4, 11, 'Vienna'),
            (5, 166, 'Warsaw'),
            (6, 153, 'Amsterdam'),
            (7, 71, 'London')");

    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql("SET FOREIGN_KEY_CHECKS = 0; 
                            TRUNCATE table cities; 
                            SET FOREIGN_KEY_CHECKS = 1;");

    }
}
