DROP DATABASE IF EXISTS philippebeck;
CREATE DATABASE philippebeck CHARACTER SET 'utf8';

USE philippebeck;

-- ***** Tables for the Blog part *****

CREATE TABLE Article
(
  id            SMALLINT      UNSIGNED  PRIMARY KEY AUTO_INCREMENT,
  title         VARCHAR(50)   NOT NULL  UNIQUE,
  image         VARCHAR(50)   NOT NULL  UNIQUE,
  created_date  DATETIME      NOT NULL,
  updated_date  DATETIME      NOT NULL,
  link          VARCHAR(255)  NOT NULL  UNIQUE,
  content       TEXT          NOT NULL
)
ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE User
(
  id            SMALLINT      	UNSIGNED  PRIMARY KEY AUTO_INCREMENT,
  name    	VARCHAR(50)   	NOT NULL,
  image         VARCHAR(50)	UNIQUE,
  email         VARCHAR(100)  	NOT NULL  UNIQUE,
  pass          VARCHAR(100)  	NOT NULL
)
ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE Comment
(
  id            SMALLINT        UNSIGNED      PRIMARY KEY   AUTO_INCREMENT,
  content       TEXT            NOT NULL,
  created_date  DATETIME        NOT NULL,
  article_id    SMALLINT        UNSIGNED      NOT NULL,
  user_id       SMALLINT        UNSIGNED      NOT NULL,
  CONSTRAINT    fk_article_id   FOREIGN KEY   (article_id)  REFERENCES      Article(id),
  CONSTRAINT    fk_user_id      FOREIGN KEY   (user_id)     REFERENCES      User(id)
)
ENGINE=INNODB DEFAULT CHARSET=utf8;

-- ***** Tables for the Portfolio part *****

CREATE TABLE Project
(
  id           TINYINT       UNSIGNED  PRIMARY KEY   AUTO_INCREMENT,
  name         VARCHAR(50)   NOT NULL,
  image        VARCHAR(50)   NOT NULL  UNIQUE,
  link         VARCHAR(50)   NOT NULL  UNIQUE,
  year         YEAR          NOT NULL,
  description  VARCHAR(255)  NOT NULL
)
ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE Pen
(
  id              TINYINT       UNSIGNED  PRIMARY KEY   AUTO_INCREMENT,
  name            VARCHAR(50)   NOT NULL  UNIQUE,
  link            VARCHAR(50)   NOT NULL  UNIQUE,
  objective_link  VARCHAR(100)  NOT NULL  UNIQUE
)
ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE Route
(
  id           TINYINT       UNSIGNED  PRIMARY KEY   AUTO_INCREMENT,
  name         VARCHAR(100)  NOT NULL,
  certif_id    VARCHAR(20)   NOT NULL  UNIQUE,
  certif_link  VARCHAR(100)  NOT NULL  UNIQUE,
  certif_date  DATE          NOT NULL
)
ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE Course
(
  id           TINYINT       UNSIGNED  PRIMARY KEY   AUTO_INCREMENT,
  name         VARCHAR(100)  NOT NULL,
  link         VARCHAR(100)  NOT NULL  UNIQUE,
  certif_id    VARCHAR(20)   NOT NULL  UNIQUE,
  certif_link  VARCHAR(100)  NOT NULL  UNIQUE,
  certif_date  DATE          NOT NULL
)
ENGINE=INNODB DEFAULT CHARSET=utf8;

-- ***** Tables for the Photo part *****

CREATE TABLE Constellation
(
  id            TINYINT       UNSIGNED    PRIMARY KEY   AUTO_INCREMENT,
  name          VARCHAR(20)   NOT NULL,
  surname       VARCHAR(30)   NOT NULL,
  wiki          VARCHAR(40)   NOT NULL
)
ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE Object
(
  id            MEDIUMINT     UNSIGNED    PRIMARY KEY  AUTO_INCREMENT,
  name          VARCHAR(50),
  messier       VARCHAR(10),
  ngc           VARCHAR(20),
  ugc           VARCHAR(20),
  eso           VARCHAR(20),
  apg           VARCHAR(20),
  pgc           VARCHAR(20),
  distance      VARCHAR(20)   NOT NULL,
  leda          VARCHAR(20),
  ned           VARCHAR(20),
  cds           VARCHAR(20)   NOT NULL,
  wiki          VARCHAR(100)
)
ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE Photo
(
  id            MEDIUMINT     UNSIGNED     PRIMARY KEY  AUTO_INCREMENT,
  image         VARCHAR(20)   NOT NULL     UNIQUE,
  ra            VARCHAR(20)   NOT NULL,
  declination   VARCHAR(20)   NOT NULL,
  size          VARCHAR(20)   NOT NULL,
  view_field    VARCHAR(20),
  release_date  DATETIME      NOT NULL,
  const_id      TINYINT       UNSIGNED     NOT NULL,
  object_id     MEDIUMINT     UNSIGNED     NOT NULL,
  credit        TEXT          NOT NULL,
  CONSTRAINT    fk_const_id   FOREIGN KEY  (const_id)   REFERENCES      Constellation(id),
  CONSTRAINT    fk_object_id  FOREIGN KEY  (object_id)  REFERENCES      Object(id)
)
ENGINE=INNODB DEFAULT CHARSET=utf8;

-- ***** Tables for the Atlas part *****

CREATE TABLE Atlas
(
  id            TINYINT        UNSIGNED  PRIMARY KEY AUTO_INCREMENT,
  name          VARCHAR(50)    NOT NULL,
  wiki          VARCHAR(50),
  year          VARCHAR(5)     NOT NULL,
  author_name   VARCHAR(50)    NOT NULL,
  author_wiki   VARCHAR(100)
)
ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE TABLE Map
(
  id           SMALLINT      UNSIGNED     PRIMARY KEY  AUTO_INCREMENT,
  name         VARCHAR(20)   NOT NULL,
  description  VARCHAR(150)  NOT NULL,
  atlas_id     TINYINT       UNSIGNED     NOT NULL,
  CONSTRAINT   fk_atlas_id   FOREIGN KEY  (atlas_id)   REFERENCES       Atlas(id)
)
ENGINE=INNODB DEFAULT CHARSET=utf8;
