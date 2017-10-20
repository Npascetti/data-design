-- INSERT table statements

-- Represents someones profile

INSERT INTO profile(profileId, profileActivationToken, profileUserName, profileAvatar, profileHash, profileSalt)
VALUES(
	UNHEX(REPLACE("18a80122-847c-454f-8248-0b6eb6fe36ad", "-", "")),
	"11cccb9bf715af1c5a00330a88470fa0",
	"Nickynack",
	"https://tinyurl.com/yalw3l9f",
	"063b6645cdb3042291015982db2e30d5df9746a772fb0b42c8ba108bcc8326ba5fd587a8fb8ad6b08d434d9bb3a1fe92270d06ce836de0dadbc56469ffa31360",
	"8b20cee20d192945db6fc76b9674d7d0fab776b9416e74e4715f296f2e77b1fc"
);

-- Represents a profile creating a post

INSERT INTO post(postId, postProfileId, postContent, postDateTime, postTitle)
	VALUES(
		UNHEX(REPLACE("5313feb5-6adc-487d-99ec-b1e804843c1e", "-", "")),
		UNHEX(REPLACE("18a80122-847c-454f-8248-0b6eb6fe36ad", "-", "")),
		"Hey all, new to ABQ, and I was wondering what some of your favorite hiking trails on the Sandias are? Thanks!",
		101112,
		"New To ABQ, Hiking Trail Suggestions?"
	);

-- Represents a profile commenting on initial post, starting their own comment thread

INSERT INTO comment(commentId, commentProfileId, commentPostId, commentCommentId, commentDateTime, commentContent)
VALUES(
	UNHEX(REPLACE("fe0e30e6-dbe8-4a44-b2eb-9dfa4d9708c7", "-", "")),
	UNHEX(REPLACE("a202c6e6-5430-43b2-aa57-8eac448f80e7", "-", "")),
	UNHEX(REPLACE("5313feb5-6adc-487d-99ec-b1e804843c1e", "-", "")),
	UNHEX(REPLACE("fe0e30e6-dbe8-4a44-b2eb-9dfa4d9708c7", "-", "")),
	101112,
	"I like the Elena Gallegos trails."
);

-- Represents a profile commenting, responding to the comment thread above

INSERT INTO comment(commentId, commentProfileId, commentPostId, commentCommentId, commentDateTime, commentContent)
VALUES(
	UNHEX(REPLACE("7dcf23d3-6b59-403a-a60d-ecec19776e98", "-", "")),
	UNHEX(REPLACE("35051b76-8b11-4f29-9e74-b6a9ea665cf0", "-", "")),
	UNHEX(REPLACE("5313feb5-6adc-487d-99ec-b1e804843c1e", "-", "")),
	UNHEX(REPLACE("fe0e30e6-dbe8-4a44-b2eb-9dfa4d9708c7", "-", "")),
	101112,
	"Personally, I like 3 Gun Spring by Carnuel."
);