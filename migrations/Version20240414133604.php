<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240414133604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE categorie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE etape_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE image_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE media_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE option_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE professionel_sante_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE source_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE article (id INT NOT NULL, titre VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, date_publication TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, auteur VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE article_source (article_id INT NOT NULL, source_id INT NOT NULL, PRIMARY KEY(article_id, source_id))');
        $this->addSql('CREATE INDEX IDX_354DE8F37294869C ON article_source (article_id)');
        $this->addSql('CREATE INDEX IDX_354DE8F3953C1C61 ON article_source (source_id)');
        $this->addSql('CREATE TABLE article_categorie (article_id INT NOT NULL, categorie_id INT NOT NULL, PRIMARY KEY(article_id, categorie_id))');
        $this->addSql('CREATE INDEX IDX_934886107294869C ON article_categorie (article_id)');
        $this->addSql('CREATE INDEX IDX_93488610BCF5E72D ON article_categorie (categorie_id)');
        $this->addSql('CREATE TABLE categorie (id INT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE etape (id INT NOT NULL, designation VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE image (id INT NOT NULL, article_id INT DEFAULT NULL, path VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C53D045F7294869C ON image (article_id)');
        $this->addSql('CREATE TABLE media (id INT NOT NULL, etape_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, lien VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6A2CA10C4A8CA2AD ON media (etape_id)');
        $this->addSql('CREATE TABLE option (id INT NOT NULL, etape_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5A8600B04A8CA2AD ON option (etape_id)');
        $this->addSql('CREATE TABLE professionel_sante (id INT NOT NULL, metier VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, contact TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN professionel_sante.contact IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE source (id INT NOT NULL, nom VARCHAR(255) NOT NULL, lien VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('ALTER TABLE article_source ADD CONSTRAINT FK_354DE8F37294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_source ADD CONSTRAINT FK_354DE8F3953C1C61 FOREIGN KEY (source_id) REFERENCES source (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT FK_934886107294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_categorie ADD CONSTRAINT FK_93488610BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F7294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C4A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE option ADD CONSTRAINT FK_5A8600B04A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE article_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE categorie_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE etape_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE image_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE media_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE option_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE professionel_sante_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE source_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE article_source DROP CONSTRAINT FK_354DE8F37294869C');
        $this->addSql('ALTER TABLE article_source DROP CONSTRAINT FK_354DE8F3953C1C61');
        $this->addSql('ALTER TABLE article_categorie DROP CONSTRAINT FK_934886107294869C');
        $this->addSql('ALTER TABLE article_categorie DROP CONSTRAINT FK_93488610BCF5E72D');
        $this->addSql('ALTER TABLE image DROP CONSTRAINT FK_C53D045F7294869C');
        $this->addSql('ALTER TABLE media DROP CONSTRAINT FK_6A2CA10C4A8CA2AD');
        $this->addSql('ALTER TABLE option DROP CONSTRAINT FK_5A8600B04A8CA2AD');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_source');
        $this->addSql('DROP TABLE article_categorie');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE etape');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE option');
        $this->addSql('DROP TABLE professionel_sante');
        $this->addSql('DROP TABLE source');
        $this->addSql('DROP TABLE "user"');
    }
}
