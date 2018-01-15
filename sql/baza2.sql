-- MySQL Workbench Synchronization
-- Generated: 2018-01-04 13:07
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Študent EP

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

drop database if exists baza;
create database baza;
use baza;

CREATE TABLE IF NOT EXISTS `admin` (
  `idadmin` INT(11) NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NOT NULL,
  `priimek` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `geslo` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idadmin`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `prodajalec` (
  `idprodajalec` INT(11) NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NOT NULL,
  `priimek` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `geslo` VARCHAR(100) NOT NULL,
  `aktiviran` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`idprodajalec`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `stranka` (
  `idstranka` INT(11) NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NOT NULL,
  `priimek` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `geslo` VARCHAR(100) NOT NULL,
  `telefon` INT(15) NULL DEFAULT NULL,
  `naslov` VARCHAR(45) CHARACTER SET 'big5' NULL DEFAULT NULL,
  `aktiviran` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idstranka`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `artikel` (
  `idartikel` INT(11) NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) NOT NULL,
  `opis` VARCHAR(1000) NULL DEFAULT NULL,
  `cena` FLOAT(11) NOT NULL,
  `aktiviran` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`idartikel`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `narocilo` (
  `idnarocilo` INT(11) NOT NULL AUTO_INCREMENT,
  `cena` FLOAT(11) NOT NULL,
  `stranka_idstranka` INT(11) NOT NULL,
  `potrjeno` TINYINT(1) NOT NULL,
  `preklicano` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idnarocilo`, `stranka_idstranka`),
  INDEX `fk_narocilo_stranka1_idx` (`stranka_idstranka` ASC),
  CONSTRAINT `fk_narocilo_stranka1`
    FOREIGN KEY (`stranka_idstranka`)
    REFERENCES `stranka` (`idstranka`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `kosarice` (
  `idartikel_kosarica` INT(11) NOT NULL,
  `idstranka_kosarica` INT(11) NOT NULL,
  `kolicina` INT(11) NOT NULL,
  PRIMARY KEY (`idartikel_kosarica`, `idstranka_kosarica`),
  INDEX `fk_artikel_has_stranka_stranka1_idx` (`idstranka_kosarica` ASC),
  INDEX `fk_artikel_has_stranka_artikel1_idx` (`idartikel_kosarica` ASC),
  CONSTRAINT `kosarice_artikel1`
    FOREIGN KEY (`idartikel_kosarica`)
    REFERENCES `artikel` (`idartikel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `kosarice_stranka1`
    FOREIGN KEY (`idstranka_kosarica`)
    REFERENCES `stranka` (`idstranka`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `ocene` (
  `idstranka_ocene` INT(11) NOT NULL,
  `idartikel_ocene` INT(11) NOT NULL,
  `ocena` INT(11) NOT NULL,
  INDEX `fk_stranka_has_artikel_artikel1_idx` (`idartikel_ocene` ASC),
  INDEX `fk_stranka_has_artikel_stranka1_idx` (`idstranka_ocene` ASC),
  PRIMARY KEY (`idartikel_ocene`, `idstranka_ocene`),
  CONSTRAINT `ocene_stranka1`
    FOREIGN KEY (`idstranka_ocene`)
    REFERENCES `stranka` (`idstranka`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `ocene_artikel1`
    FOREIGN KEY (`idartikel_ocene`)
    REFERENCES `artikel` (`idartikel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

LOCK TABLES `stranka` WRITE;
INSERT INTO `stranka` VALUES
(1, 'Chuck', 'Norris', 'gmail1', '$2y$10$BWsl/xciUKjJVfDFQePgYucsg4/2iZW/2MccZgF4SYk0Tao47sqPO','051257231','Svetovna 15',1),
(2, 'Milka', 'Krava', 'gmail2', '$2y$10$BWsl/xciUKjJVfDFQePgYucsg4/2iZW/2MccZgF4SYk0Tao47sqPO','1462124','Pasnik v dolini 16',1),
(3, 'Majda', 'Novak', 'gmail3', '$2y$10$TP1ARBvEyZoMbdiwDFPN1.qP905dRASRag7PZyZygIFy6pi76IUBW','051123231','Subiceva 1',1);

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES 
(1, 'Super', 'Administrator', 'super.administrator@email.com', '$2y$10$PIgo6.KqtR/7gE8AsdJjGuBbVZNuLqsQv5WJmt8a/dvx8asKjdnay');

LOCK TABLES `prodajalec` WRITE;
INSERT INTO `prodajalec` VALUES
(1, 'Prodajalec', 'Ena', 'prodajalec.ena@email.com', '$2y$10$JDJ5JDEwJO25zOgn4rCSZOlvrzjgH52Qs5YPEiL4JhAO/0rdJnSzi', true),
(2, 'Prodajalec', 'Dva', 'prodajalec.dva@email.com', '$2y$10$GtMM.z7HdbrzXGvkPraUru0Lf91BHZV0.Q4APTCP/ZoVO9V6vV3RW', true),
(3, 'Prodajalec', 'Tri', 'prodajalec.tri@email.com', '$2y$10$QFlIxX8j3PlDGR7dd1TzDuiirUUxL5..2Kf/Rp4fa0qVtblXTCR.2', true);

LOCK TABLES `artikel` WRITE;
INSERT INTO `artikel` VALUES
(1, 'iZombie season 1 DVD', 'Opis artikla', 3.99, 1),
(2, 'Planet Earth Bluray', 'Opis artikla', 5.99, 1),
(3, 'Westworld season1 Bluray', 'Opis artikla', 7.99, 1);

LOCK TABLES `artikel` WRITE;
INSERT INTO `artikel` VALUES
(4, 'Diablo 3', 'Opis artikla', 39.99, 0),
(5, 'Starcraft 2', 'Opis artikla', 29.99, 0),
(6, 'Heroes of the storm', 'Opis artikla', 9.99, 0);

LOCK TABLES `artikel` WRITE;
INSERT INTO `artikel` VALUES
(7, 'iPhone X', 'Opis artikla', 999.99, 1),
(8, 'iPhone 8 Plus', 'Opis artikla', 799.99, 1),
(9, 'iPhone 8', 'Opis artikla', 699.99, 0);


LOCK TABLES `narocilo` WRITE;
INSERT INTO `narocilo` VALUES
(1, 100.00, 1, false, false),
(2, 621.00, 1, false, false),
(3, 25.85, 1, false, true),
(4, 39.43, 2, true, false);

LOCK TABLES `kosarice` WRITE;
INSERT INTO `kosarice` VALUES
(4, 2, 1),
(5, 2, 2),
(8, 3, 1),
(9, 3, 2),
(5, 3, 1);

LOCK TABLES `ocene` WRITE;
INSERT INTO `ocene` VALUES
(1, 6, 4),
(1, 7, 4),
(3, 7, 3),
(3, 8, 2),
(3, 9, 4);



