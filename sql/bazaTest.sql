-- MySQL Workbench Synchronization
-- Generated: 2018-01-04 13:07
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Študent EP

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `baza` ;

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `mydb`.`admin` (
  `idadmin` INT(11) NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NOT NULL,
  `priimek` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `geslo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idadmin`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`prodajalec` (
  `idprodajalec` INT(11) NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NOT NULL,
  `priimek` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `geslo` VARCHAR(45) NOT NULL,
  `aktiviran` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`idprodajalec`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`stranka` (
  `idstranka` INT(11) NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(45) NOT NULL,
  `priimek` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `geslo` VARCHAR(45) NOT NULL,
  `telefon` INT(11) NULL DEFAULT NULL,
  `naslov` VARCHAR(45) CHARACTER SET 'big5' NULL DEFAULT NULL,
  `aktiviran` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`idstranka`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`artikel` (
  `idartikel` INT(11) NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) NOT NULL,
  `opis` VARCHAR(45) NULL DEFAULT NULL,
  `cena` FLOAT(11) NOT NULL,
  `aktiviran` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`idartikel`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`narocilo` (
  `idnarocilo` INT(11) NOT NULL AUTO_INCREMENT,
  `cena` FLOAT(11) NOT NULL,
  `stranka_idstranka` INT(11) NOT NULL,
  `potrjeno` TINYINT(1) NOT NULL,
  `preklicano` TINYINT(1) NOT NULL,
  PRIMARY KEY (`idnarocilo`, `stranka_idstranka`),
  INDEX `fk_narocilo_stranka1_idx` (`stranka_idstranka` ASC),
  CONSTRAINT `fk_narocilo_stranka1`
    FOREIGN KEY (`stranka_idstranka`)
    REFERENCES `mydb`.`stranka` (`idstranka`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`kosarice` (
  `idartikel_kosarica` INT(11) NOT NULL,
  `idstranka_kosarica` INT(11) NOT NULL,
  `kolicina` INT(11) NOT NULL,
  PRIMARY KEY (`idartikel_kosarica`, `idstranka_kosarica`),
  INDEX `fk_artikel_has_stranka_stranka1_idx` (`idstranka_kosarica` ASC),
  INDEX `fk_artikel_has_stranka_artikel1_idx` (`idartikel_kosarica` ASC),
  CONSTRAINT `kosarice_artikel1`
    FOREIGN KEY (`idartikel_kosarica`)
    REFERENCES `mydb`.`artikel` (`idartikel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `kosarice_stranka1`
    FOREIGN KEY (`idstranka_kosarica`)
    REFERENCES `mydb`.`stranka` (`idstranka`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`ocene` (
  `idstranka_ocene` INT(11) NOT NULL,
  `idartikel_ocene` INT(11) NOT NULL,
  `ocena` INT(11) NOT NULL,
  INDEX `fk_stranka_has_artikel_artikel1_idx` (`idartikel_ocene` ASC),
  INDEX `fk_stranka_has_artikel_stranka1_idx` (`idstranka_ocene` ASC),
  PRIMARY KEY (`idartikel_ocene`, `idstranka_ocene`),
  CONSTRAINT `ocene_stranka1`
    FOREIGN KEY (`idstranka_ocene`)
    REFERENCES `mydb`.`stranka` (`idstranka`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `ocene_artikel1`
    FOREIGN KEY (`idartikel_ocene`)
    REFERENCES `mydb`.`artikel` (`idartikel`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
