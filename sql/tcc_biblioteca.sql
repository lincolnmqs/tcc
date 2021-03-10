-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema tcc_biblioteca
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema tcc_biblioteca
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `tcc_biblioteca` DEFAULT CHARACTER SET utf8 ;
USE `tcc_biblioteca` ;

-- -----------------------------------------------------
-- Table `tcc_biblioteca`.`autores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_biblioteca`.`autores` (
  `id_autores` INT NOT NULL AUTO_INCREMENT,
  `nome_autores` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_autores`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc_biblioteca`.`livros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_biblioteca`.`livros` (
  `id_livros` INT NOT NULL AUTO_INCREMENT,
  `nome_livros` VARCHAR(100) NOT NULL,
  `ano_livros` VARCHAR(4) NOT NULL,
  `id_autores` INT NOT NULL,
  PRIMARY KEY (`id_livros`, `id_autores`),
  INDEX `fk_livros_autores1_idx` (`id_autores` ASC),
  CONSTRAINT `fk_livros_autores1`
    FOREIGN KEY (`id_autores`)
    REFERENCES `tcc_biblioteca`.`autores` (`id_autores`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc_biblioteca`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_biblioteca`.`categorias` (
  `id_categorias` INT NOT NULL,
  `nome_categorias` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_categorias`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tcc_biblioteca`.`categorias_livros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tcc_biblioteca`.`categorias_livros` (
  `id_categorias` INT NOT NULL,
  `id_livros` INT NOT NULL,
  PRIMARY KEY (`id_categorias`, `id_livros`),
  INDEX `fk_categorias_has_livros_livros1_idx` (`id_livros` ASC),
  INDEX `fk_categorias_has_livros_categorias_idx` (`id_categorias` ASC),
  CONSTRAINT `fk_categorias_has_livros_categorias`
    FOREIGN KEY (`id_categorias`)
    REFERENCES `tcc_biblioteca`.`categorias` (`id_categorias`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_categorias_has_livros_livros1`
    FOREIGN KEY (`id_livros`)
    REFERENCES `tcc_biblioteca`.`livros` (`id_livros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
