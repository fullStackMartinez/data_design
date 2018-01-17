DROP TABLE IF EXISTS clap;
DROP TABLE IF EXISTS article;
DROP TABLE IF EXISTS profile;


CREATE TABLE profile (
	profileId BINARY(16) NOT NULL,
	profileName VARCHAR(32) NOT NULL,
	firstName VARCHAR(128) NOT NULL,
	lastName VARCHAR(128) NOT NULL,
	profilePhone VARCHAR(32),
	profileEmail VARCHAR(128) NOT NULL,
	profilePassword VARCHAR(128) NOT NULL,
	UNIQUE (profileEmail),
	PRIMARY KEY (profileId)

);

CREATE TABLE article(
	articleId BINARY(16) NOT NULL,
	articleProfileId BINARY(16) NOT NULL ,
	articleContent VARCHAR(12000) NOT NULL,
	articleTitle VARCHAR(255) NOT NULL ,
	articleDateTime DATETIME(6) NOT NULL ,
	INDEX (articleProfileId),
	FOREIGN KEY (articleProfileId) REFERENCES profile(profileId),
	PRIMARY KEY (articleId)

);

CREATE TABLE clap (
	clapId BINARY (16) NOT NULL,
	clapProfileId BINARY(16) NOT NULL ,
	clapArticleId BINARY(16) NOT NULL ,
	clapDate DATETIME(6) not NULL ,
	INDEX (clapProfileId),
	INDEX (clapArticleId),
	FOREIGN KEY (clapProfileId) REFERENCES profile(profileId),
	FOREIGN KEY (clapArticleId) REFERENCES article(articleId),
	PRIMARY KEY (clapId)

);