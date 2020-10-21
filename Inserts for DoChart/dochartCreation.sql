-- MySQL Workbench Synchronization
-- Generated: 2020-10-20 17:43
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Jamecia Marlynsia

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

ALTER TABLE `mydb`.`Patient` 
CHANGE COLUMN `patientID` `patientID` INT(11) NOT NULL ,
CHANGE COLUMN `fName` `fName` VARCHAR(45) NOT NULL ,
CHANGE COLUMN `mInitial` `mInitial` VARCHAR(45) NOT NULL ,
CHANGE COLUMN `lName` `lName` VARCHAR(45) NOT NULL ,
CHANGE COLUMN `birthDate` `birthDate` VARCHAR(45) NOT NULL ,
ADD UNIQUE INDEX `pUsername_UNIQUE` (`pUsername` ASC) VISIBLE,
ADD UNIQUE INDEX `patientID_UNIQUE` (`patientID` ASC) VISIBLE;
;

CREATE TABLE IF NOT EXISTS `mydb`.`Health` (
  `Patient_patientID` INT(11) NULL DEFAULT NULL,
  `responseHealth` VARCHAR(200) NOT NULL,
  CONSTRAINT `fk_Health_Patient`
    FOREIGN KEY (`Patient_patientID`)
    REFERENCES `mydb`.`Patient` (`patientID`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`Result` (
  `Patient_patientID` INT(11) NULL DEFAULT NULL,
  `resultTicket` VARCHAR(200) NOT NULL,
  CONSTRAINT `fk_Result_Patient1`
    FOREIGN KEY (`Patient_patientID`)
    REFERENCES `mydb`.`Patient` (`patientID`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

ALTER TABLE `mydb`.`Doctor` 
CHANGE COLUMN `doctorID` `doctorID` INT(11) NOT NULL ,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`doctorID`),
ADD UNIQUE INDEX `dUsername_UNIQUE` (`dUsername` ASC) VISIBLE,
ADD UNIQUE INDEX `doctorID_UNIQUE` (`doctorID` ASC) VISIBLE;
;

CREATE TABLE IF NOT EXISTS `mydb`.`Patient_has_Doctor` (
  `Patient_patientID` INT(11) NULL DEFAULT NULL,
  `Doctor_doctorID` INT(11) NULL DEFAULT NULL,
  INDEX `fk_Patient_has_Doctor_Doctor1_idx` (`Doctor_doctorID` ASC) VISIBLE,
  INDEX `fk_Patient_has_Doctor_Patient1_idx` (`Patient_patientID` ASC) VISIBLE,
  CONSTRAINT `fk_Patient_has_Doctor_Patient1`
    FOREIGN KEY (`Patient_patientID`)
    REFERENCES `mydb`.`Patient` (`patientID`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Patient_has_Doctor_Doctor1`
    FOREIGN KEY (`Doctor_doctorID`)
    REFERENCES `mydb`.`Doctor` (`doctorID`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`Prescription` (
  `DIN` INT(11) NOT NULL,
  `pillName` VARCHAR(45) NOT NULL,
  `pillType` VARCHAR(45) NOT NULL,
  `pillTemp` VARCHAR(45) NOT NULL,
  `pillCompany` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`DIN`),
  UNIQUE INDEX `DIN_UNIQUE` (`DIN` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`Patient_has_Prescription` (
  `Patient_patientID` INT(11) NULL DEFAULT NULL,
  `Prescription_DIN` INT(11) NULL DEFAULT NULL,
  INDEX `fk_Patient_has_Prescription_Prescription1_idx` (`Prescription_DIN` ASC) VISIBLE,
  INDEX `fk_Patient_has_Prescription_Patient1_idx` (`Patient_patientID` ASC) VISIBLE,
  CONSTRAINT `fk_Patient_has_Prescription_Patient1`
    FOREIGN KEY (`Patient_patientID`)
    REFERENCES `mydb`.`Patient` (`patientID`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Patient_has_Prescription_Prescription1`
    FOREIGN KEY (`Prescription_DIN`)
    REFERENCES `mydb`.`Prescription` (`DIN`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`Appointment` (
  `appID` INT(11) NOT NULL,
  `reason` VARCHAR(100) NOT NULL,
  `height` VARCHAR(45) NOT NULL,
  `weight` FLOAT(11) NOT NULL,
  `symptoms` VARCHAR(45) NOT NULL,
  `time` VARCHAR(4) NOT NULL,
  `date` VARCHAR(45) NOT NULL,
  `Prescription_DIN` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`appID`),
  INDEX `fk_Appointment_Prescription1_idx` (`Prescription_DIN` ASC) VISIBLE,
  UNIQUE INDEX `appID_UNIQUE` (`appID` ASC) VISIBLE,
  CONSTRAINT `fk_Appointment_Prescription1`
    FOREIGN KEY (`Prescription_DIN`)
    REFERENCES `mydb`.`Prescription` (`DIN`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`contactDoctor` (
  `messageResponse` VARCHAR(200) NOT NULL,
  `Patient_patientID` INT(11) NULL DEFAULT NULL,
  `Doctor_doctorID` INT(11) NULL DEFAULT NULL,
  INDEX `fk_contactDoctor_Patient1_idx` (`Patient_patientID` ASC) VISIBLE,
  INDEX `fk_contactDoctor_Doctor1_idx` (`Doctor_doctorID` ASC) VISIBLE,
  CONSTRAINT `fk_contactDoctor_Patient1`
    FOREIGN KEY (`Patient_patientID`)
    REFERENCES `mydb`.`Patient` (`patientID`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contactDoctor_Doctor1`
    FOREIGN KEY (`Doctor_doctorID`)
    REFERENCES `mydb`.`Doctor` (`doctorID`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `mydb`.`Patient_has_Appointment` (
  `Patient_patientID` INT(11) NULL DEFAULT NULL,
  `Doctor_doctorID` INT(11) NULL DEFAULT NULL,
  `Appointment_appID` INT(11) NULL DEFAULT NULL,
  INDEX `fk_Patient_has_Appointment_Patient1_idx` (`Patient_patientID` ASC) VISIBLE,
  CONSTRAINT `fk_Patient_has_Appointment_Patient1`
    FOREIGN KEY (`Patient_patientID`)
    REFERENCES `mydb`.`Patient` (`patientID`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Patient_has_Appointment_Doctor1`
    FOREIGN KEY (`Doctor_doctorID`)
    REFERENCES `mydb`.`Doctor` (`doctorID`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Patient_has_Appointment_Appointment1`
    FOREIGN KEY (`Appointment_appID`)
    REFERENCES `mydb`.`Appointment` (`appID`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
