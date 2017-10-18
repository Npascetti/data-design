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

INSERT INTO comment(commentId)
	VALUE(UNHEX(REPLACE("96096036-e35b-4e2e-8bf9-2f964fbb030b", "-", "")));

INSERT INTO post(postId)
	VALUE(UNHEX(REPLACE("25a61b98-2bd1-4875-9b74-8d8c6322b00b", "-", "")));


-- DELETE VERB SECTION

DELETE FROM post WHERE postTitle = "Does this look infected to you?";

DELETE FROM comment WHERE commentContent = "Barney Gumble is the MVP of Season 3";

DELETE FROM profile WHERE profileUserName = "nickynack";

-- UPDATE VERB SECTION

UPDATE profile
	SET profileUserName = "nickitynicknack";

UPDATE comment
	SET commentContent = "No Homers Allowed!!";

UPDATE post
	SET postTitle = "Updated: No, everything is okay";

-- SELECT VERB SECTION

SELECT commentContent
FROM comment
WHERE commentDateTime = "2016-12-31 23:59:59";

SELECT postTitle
FROM post
WHERE postId = "25a61b982bd148759b748d8c6322b00b";

SELECT profileId
FROM profile
WHERE profileUserName = "nickitynicknack";