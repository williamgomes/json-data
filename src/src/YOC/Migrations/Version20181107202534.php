<?php declare(strict_types=1);

namespace YOC\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181107202534 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('create table weather_record
            (
                id int auto_increment
                    primary key,
                timezone varchar(100) not null,
                country_id int not null,
                city_id int not null,
                record_date date not null,
                max_temp decimal(11,2) not null,
                min_temp decimal(11,2) not null,
                avg_temp decimal(11,2) not null,
                created_at varchar(45) not null,
                constraint id_UNIQUE
                    unique (id),
                constraint weather_record_countries_id_fk
                    foreign key (country_id) references sf3.countries (id),
                constraint weather_record_cities_id_fk
                    foreign key (city_id) references sf3.cities (id)
            )
            ;
            
            create index weather_record_cities_id_fk
                on weather_record (city_id)
            ;
            
            create index weather_record_countries_id_fk
                on weather_record (country_id)
            ;');

    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE  weather_record;');

    }
}
