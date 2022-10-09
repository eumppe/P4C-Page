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
    email varchar(30) unique,
    randnum int unique,
    validfrom timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    verified bool default FALSE
);

CREATE table articles(
	idx INT PRIMARY KEY AUTO_INCREMENT,
    forum INT,
    author int,
    title VARCHAR(100) CHARACTER SET utf8mb4,
    article VARCHAR(3000) CHARACTER SET utf8mb4,
    files VARCHAR(300) CHARACTER SET utf8mb4,
    times timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    views INT not null default 0
);
