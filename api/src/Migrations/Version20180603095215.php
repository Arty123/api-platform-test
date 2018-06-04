<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180603095215 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE greeting_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE driver_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE order_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE truck_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE city_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE way_point_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE way_point_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE driver_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE truck_state_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "order" (id INT NOT NULL, status_id INT DEFAULT NULL, truck_id INT DEFAULT NULL, unique_id VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F5299398E3C68343 ON "order" (unique_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F52993986BF700BD ON "order" (status_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F5299398C6957CCE ON "order" (truck_id)');
        $this->addSql('CREATE TABLE way_points_orders (order_id INT NOT NULL, way_point_id INT NOT NULL, PRIMARY KEY(order_id, way_point_id))');
        $this->addSql('CREATE INDEX IDX_11343F018D9F6D38 ON way_points_orders (order_id)');
        $this->addSql('CREATE INDEX IDX_11343F01B8E0D6D2 ON way_points_orders (way_point_id)');
        $this->addSql('CREATE TABLE driver (id INT NOT NULL, status_id INT DEFAULT NULL, city_id INT DEFAULT NULL, order_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, hours INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_11667CD96BF700BD ON driver (status_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_11667CD98BAC62AF ON driver (city_id)');
        $this->addSql('CREATE INDEX IDX_11667CD98D9F6D38 ON driver (order_id)');
        $this->addSql('CREATE TABLE drivers_trucks (driver_id INT NOT NULL, truck_id INT NOT NULL, PRIMARY KEY(driver_id, truck_id))');
        $this->addSql('CREATE INDEX IDX_69031E1CC3423909 ON drivers_trucks (driver_id)');
        $this->addSql('CREATE INDEX IDX_69031E1CC6957CCE ON drivers_trucks (truck_id)');
        $this->addSql('CREATE TABLE order_status (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE truck (id INT NOT NULL, state_id INT DEFAULT NULL, registration_number VARCHAR(7) NOT NULL, drivers_count INT NOT NULL, capacity INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CDCCF30A5D83CC1 ON truck (state_id)');
        $this->addSql('CREATE TABLE city (id INT NOT NULL, name VARCHAR(255) NOT NULL, distance INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE way_point_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE way_point (id INT NOT NULL, city_id INT DEFAULT NULL, way_point_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9B2531748BAC62AF ON way_point (city_id)');
        $this->addSql('CREATE INDEX IDX_9B253174B8E0D6D2 ON way_point (way_point_id)');
        $this->addSql('CREATE TABLE driver_status (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE truck_state (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F52993986BF700BD FOREIGN KEY (status_id) REFERENCES order_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "order" ADD CONSTRAINT FK_F5299398C6957CCE FOREIGN KEY (truck_id) REFERENCES truck (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE way_points_orders ADD CONSTRAINT FK_11343F018D9F6D38 FOREIGN KEY (order_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE way_points_orders ADD CONSTRAINT FK_11343F01B8E0D6D2 FOREIGN KEY (way_point_id) REFERENCES way_point (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE driver ADD CONSTRAINT FK_11667CD96BF700BD FOREIGN KEY (status_id) REFERENCES driver_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE driver ADD CONSTRAINT FK_11667CD98BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE driver ADD CONSTRAINT FK_11667CD98D9F6D38 FOREIGN KEY (order_id) REFERENCES "order" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE drivers_trucks ADD CONSTRAINT FK_69031E1CC3423909 FOREIGN KEY (driver_id) REFERENCES driver (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE drivers_trucks ADD CONSTRAINT FK_69031E1CC6957CCE FOREIGN KEY (truck_id) REFERENCES truck (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE truck ADD CONSTRAINT FK_CDCCF30A5D83CC1 FOREIGN KEY (state_id) REFERENCES truck_state (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE way_point ADD CONSTRAINT FK_9B2531748BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE way_point ADD CONSTRAINT FK_9B253174B8E0D6D2 FOREIGN KEY (way_point_id) REFERENCES way_point_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE greeting');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE way_points_orders DROP CONSTRAINT FK_11343F018D9F6D38');
        $this->addSql('ALTER TABLE driver DROP CONSTRAINT FK_11667CD98D9F6D38');
        $this->addSql('ALTER TABLE drivers_trucks DROP CONSTRAINT FK_69031E1CC3423909');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F52993986BF700BD');
        $this->addSql('ALTER TABLE "order" DROP CONSTRAINT FK_F5299398C6957CCE');
        $this->addSql('ALTER TABLE drivers_trucks DROP CONSTRAINT FK_69031E1CC6957CCE');
        $this->addSql('ALTER TABLE driver DROP CONSTRAINT FK_11667CD98BAC62AF');
        $this->addSql('ALTER TABLE way_point DROP CONSTRAINT FK_9B2531748BAC62AF');
        $this->addSql('ALTER TABLE way_point DROP CONSTRAINT FK_9B253174B8E0D6D2');
        $this->addSql('ALTER TABLE way_points_orders DROP CONSTRAINT FK_11343F01B8E0D6D2');
        $this->addSql('ALTER TABLE driver DROP CONSTRAINT FK_11667CD96BF700BD');
        $this->addSql('ALTER TABLE truck DROP CONSTRAINT FK_CDCCF30A5D83CC1');
        $this->addSql('DROP SEQUENCE order_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE driver_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE order_status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE truck_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE city_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE way_point_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE way_point_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE driver_status_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE truck_state_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE greeting_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE greeting (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE "order"');
        $this->addSql('DROP TABLE way_points_orders');
        $this->addSql('DROP TABLE driver');
        $this->addSql('DROP TABLE drivers_trucks');
        $this->addSql('DROP TABLE order_status');
        $this->addSql('DROP TABLE truck');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE way_point_type');
        $this->addSql('DROP TABLE way_point');
        $this->addSql('DROP TABLE driver_status');
        $this->addSql('DROP TABLE truck_state');
    }
}
