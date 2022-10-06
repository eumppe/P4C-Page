CREATE database eumppedb;

USE eumppedb;
CREATE table users(
	idx INT PRIMARY KEY AUTO_INCREMENT,
    userid VARCHAR(30) NOT NULL UNIQUE,
    password VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL UNIQUE
);

CREATE table emailverify(
	idx INT PRIMARY KEY AUTO_INCREMENT,
    email varchar(30),
    randnum int unique,
    validfrom timestamp,
    verified bool default FALSE
);

CREATE table articles(
	idx INT PRIMARY KEY AUTO_INCREMENT,
    forum INT,
    author int,
    title VARCHAR(100) CHARACTER SET utf8mb4,
    article VARCHAR(3000) CHARACTER SET utf8mb4,
    files BLOB DEFAULT null,
    times timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);
