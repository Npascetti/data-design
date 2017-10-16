CREATE TABLE profile (
	profileId BINARY(16) NOT NULL,
	profileActivationToken CHAR(32),
	profileUserName VARCHAR(32) NOT NULL,
	profileAvatar MEDIUMBLOB(4e+6),
	profileHash CHAR(128) NOT NULL,
	profileSalt CHAR(64) NOT NULL,
	UNIQUE(profileUserName),
	PRIMARY KEY(profileId)
);