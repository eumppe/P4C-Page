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
    title NVARCHAR(100),
    article NVARCHAR(3000),
    files BLOB DEFAULT null,
    times timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);
select * from articles;