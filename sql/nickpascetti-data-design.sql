CREATE TABLE profile (
	profileId BINARY(16) NOT NULL,
	profileActivationToken CHAR(32),
	profileUserName VARCHAR(32) NOT NULL,
	profileAvatar VARCHAR(32),
	profileHash CHAR(128) NOT NULL,
	profileSalt CHAR(64) NOT NULL,
	UNIQUE(profileUserName),
	PRIMARY KEY(profileId)
);

CREATE TABLE post (
	postId BINARY(16) NOT NULL,
	postProfileId BINARY(16) NOT NULL,
	postContent VARCHAR(40000) NOT NULL,
	postDateTime DATETIME(6) NOT NULL,
	postTitle VARCHAR(500) NOT NULL,
	INDEX (postProfileId),
	FOREIGN KEY(postProfileId) REFERENCES profile(profileId),
	PRIMARY KEY (postId)
);

CREATE TABLE comment (
	commentId BINARY(16) NOT NULL,
	commentProfileId BINARY(16) NOT NULL,
	commentPostId BINARY(16) NOT NULL,
	commentCommentId BINARY(16) NOT NULL,
	commentDateTime DATETIME(6) NOT NULL,
	commentContent VARCHAR(40000) NOT NULL,
	INDEX(commentProfileId),
	INDEX(commentPostId),
	INDEX(commentCommentId),
	FOREIGN KEY(commentProfileId) REFERENCES profile(profileId),
	FOREIGN KEY(commentPostId) REFERENCES post(postId),
	FOREIGN KEY(commentCommentId) REFERENCES comment(commentId),
	PRIMARY KEY(commentId)
);
-- VERB PRACTICE ASSIGNMENT
-- INSERT VERB SECTION

INSERT INTO profile(profileUserName)
	VALUE("nickynack");

-- DELETE VERB SECTION

DELETE FROM post WHERE postTitle = "Does this look infected to you?";

-- UPDATE VERB SECTION

UPDATE profile
	SET profileUserName = nickitynicknack;

-- SELECT VERB SECTION

SELECT commentContent
FROM comment
WHERE commentDateTime = "2016-12-31 23:59:59";