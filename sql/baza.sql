-- MySQL Workbench Synchronization
-- Generated: 2017-12-26 13:22
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Študent EP

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

drop database if exists baza;
create database baza;
use baza;

CREATE TABLE IF NOT EXISTS `admin` (
  `idadmin` INT(11) NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NOT NULL,
  `priimek` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `geslo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idadmin`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `artikel` (
  `idartikel` INT(11) NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) NOT NULL,
  `slika` VARCHAR(45) NULL DEFAULT NULL,
  `cena` FLOAT(11) NOT NULL,
  `kolicina` INT(11) NOT NULL,
  `prodajalec_idprodajalec` INT(11) NOT NULL,
  PRIMARY KEY (`idartikel`),
  INDEX `fk_artikel_prodajalec1_idx` (`prodajalec_idprodajalec` ASC),
  CONSTRAINT `fk_artikel_prodajalec1`
    FOREIGN KEY (`prodajalec_idprodajalec`)
    REFERENCES `prodajalec` (`idprodajalec`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `artikel_has_stranka` (
  `artikel_idartikel` INT(11) NOT NULL,
  `stranka_idstranka` INT(11) NOT NULL,
  PRIMARY KEY (`artikel_idartikel`, `stranka_idstranka`),
  INDEX `fk_artikel_has_stranka_stranka1_idx` (`stranka_idstranka` ASC),
  INDEX `fk_artikel_has_stranka_artikel1_idx` (`artikel_idartikel` ASC),
  CONSTRAINT `fk_artikel_has_stranka_artikel1`
    FOREIGN KEY (`artikel_idartikel`)
    REFERENCES `artikel` (`idartikel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_artikel_has_stranka_stranka1`
    FOREIGN KEY (`stranka_idstranka`)
    REFERENCES `stranka` (`idstranka`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `narocilo` (
  `idnarocilo` INT(11) NOT NULL AUTO_INCREMENT,
  `cena` FLOAT(11) NOT NULL,
  `prodajalec_idprodajalec` INT(11) NULL DEFAULT NULL,
  `stranka_idstranka` INT(11) NOT NULL,
  `kolicina` INT(11) NOT NULL,
  `potrjeno` TINYINT(1) NOT NULL,
  `preklicano` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idnarocilo`, `stranka_idstranka`),
  INDEX `fk_narocilo_prodajalec1_idx` (`prodajalec_idprodajalec` ASC),
  INDEX `fk_narocilo_stranka1_idx` (`stranka_idstranka` ASC),
  CONSTRAINT `fk_narocilo_prodajalec1`
    FOREIGN KEY (`prodajalec_idprodajalec`)
    REFERENCES `prodajalec` (`idprodajalec`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_narocilo_stranka1`
    FOREIGN KEY (`stranka_idstranka`)
    REFERENCES `stranka` (`idstranka`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `prodajalec` (
  `idprodajalec` INT(11) NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NOT NULL,
  `priimek` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `geslo` VARCHAR(45) NOT NULL,
  `admin_idadmin` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idprodajalec`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_prodajalec_admin_idx` (`admin_idadmin` ASC),
  CONSTRAINT `fk_prodajalec_admin`
    FOREIGN KEY (`admin_idadmin`)
    REFERENCES `admin` (`idadmin`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `stranka` (
  `idstranka` INT(11) NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NOT NULL,
  `priimek` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `geslo` VARCHAR(45) NOT NULL,
  `telefon` INT(11) NULL DEFAULT NULL,
  `naslov` VARCHAR(45) CHARACTER SET 'big5' NULL DEFAULT NULL,
  `prodajalec_idprodajalec` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idstranka`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  INDEX `fk_stranka_prodajalec1_idx` (`prodajalec_idprodajalec` ASC),
  CONSTRAINT `fk_stranka_prodajalec1`
    FOREIGN KEY (`prodajalec_idprodajalec`)
    REFERENCES `prodajalec` (`idprodajalec`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


LOCK TABLES `stranka` WRITE;
INSERT INTO `stranka` VALUES
(1, 'Chuck', 'Norris', 'gmail@chuck.norris', 'geslojezapicke','051257231','Povsod',null ),
(2, 'Milka', 'Krava', 'krava@milka.mu', 'muuuuuu','1462124','Pasnik v dolini 16',null ),
(3, 'Majda', 'Pešec', 'fizka@majda.prešec', 'astelahkoprosimtiho','051123231','Subiceva 1',null);

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES 
(1, 'Super', 'Administrator', 'super.administrator@email.com', 'password');

LOCK TABLES `prodajalec` WRITE;
INSERT INTO `prodajalec` VALUES
(1, 'Prodajalec', 'Ena', 'prodajalec.ena@email.com', 'password', 1),
(2, 'Prodajalec', 'Dva', 'prodajalec.dva@email.com', 'password', 1),
(3, 'Prodajalec', 'Tri', 'prodajalec.tri@email.com', 'password', 1);

LOCK TABLES `artikel` WRITE;
INSERT INTO `artikel` VALUES
(1, 'DVD', NULL, 3.99,10, 1),
(2, 'Bluray', NULL, 5.99,10, 1),
(3, 'CD', NULL, 2.99,10, 1);

LOCK TABLES `artikel` WRITE;
INSERT INTO `artikel` VALUES
(4, 'Diablo 3', NULL, 39.99,7, 2),
(5, 'Starcraft 2', NULL, 29.99,10, 2),
(6, 'Heroes of the storm', NULL, 9.99,2, 2);

LOCK TABLES `artikel` WRITE;
INSERT INTO `artikel` VALUES
(7, 'iPhone X', NULL, 999.99,3, 3),
(8, 'iPhone 8 Plus', NULL, 799.99,4, 3),
(9, 'iPhone 8', NULL, 699.99,5, 3);


LOCK TABLES `narocilo` WRITE;
INSERT INTO `narocilo` VALUES
(1, 100.00, 1,1,10,-1,-1),
(2, 621.00, 1,2,21,-1,-1),
(3, 0.99, 1,3,1,-1,-1);


