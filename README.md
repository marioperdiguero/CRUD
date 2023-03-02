<br/>
<p align="center">
  <h3 align="center">Simple CRUD <br/> (⚠️ Development in progress ⚠️)</h3>

  <p align="center">
    A simple CRUD to manage logistics centers and their products.
    <br/>
    <br/>
  </p>
</p>

## About The Project

This application allows you to create, view, update and delete both logistics centers and the products housed within them. 
It aims to have an intuitive and easy-to-use web interface for users.

## Built With

The web application has been built with PHP, HTML, CSS and the Bootstrap design framework.

## Getting Started

In order to execute a copy of the project you must read the prerequisites and the form of execution.

### Prerequisites

The first thing you will need is a database server (MariaDB) and a web server (Apache). To run this project easily you can install XAMPP.

In your database server you are going to execute the following SQL statements:

```sh
CREATE DATABASE IF NOT EXISTS `crud` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `crud`;

CREATE TABLE IF NOT EXISTS `centros_logisticos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(60) NOT NULL DEFAULT '0',
  `Ciudad` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ID`),
  KEY `Ciudad` (`Ciudad`),
  CONSTRAINT `Ciudad` FOREIGN KEY (`Ciudad`) REFERENCES `ciudades` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `ciudades` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(60) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `errors_logs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `URL` text NOT NULL,
  `HTTP_Code` int(11) NOT NULL DEFAULT 0,
  `Error` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `estanterias` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `centro_logistico` int(11) NOT NULL,
  `capacidad` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Centro Logistico` (`centro_logistico`),
  CONSTRAINT `Centro Logistico` FOREIGN KEY (`centro_logistico`) REFERENCES `centros_logisticos` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `productos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(60) NOT NULL,
  `Descripcion` varchar(255) DEFAULT NULL,
  `Cantidad` int(11) NOT NULL,
  `Estanteria` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Estanteria` (`Estanteria`),
  CONSTRAINT `Estanteria` FOREIGN KEY (`Estanteria`) REFERENCES `estanterias` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## Usage

Once the database and the necessary tables have been created, to run the project just turn on both the web server and the database server, and access the project.

## Authors

* **Mario Perdiguero** - *Junior web developer* - [Mario Perdiguero](https://github.com/marioperdiguero)
