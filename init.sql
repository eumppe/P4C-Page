CREATE database eumppedb;

USE eumppedb;
CREATE table users(
	idx INT PRIMARY KEY AUTO_INCREMENT,
    userid VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL UNIQUE
);