<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Nick Pascetti's Data Design Project</title>
		<link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
	</head>
	<header>
		<h1>Nick Pascetti's Data Design Project</h1>
		<nav>
			<ul>
				<li><a href="https://www.reddit.com/r/Albuquerque/comments/75q2kp/hows_verizon_tmobile_celldata_coverage_aibf_field/">Example Reddit Post</a></li>
				<li><a href="https://github.com/Npascetti/data-design">GitHub Data Design Repository</a></li>
			</ul>
		</nav>
	</header>
	<body>
		<h1>Persona</h1>
			<ul>
				<li><strong>Name:</strong> Karissa</li>
				<li><strong>Age:</strong>  25</li>
				<li><strong>Education:</strong>  BA Anthropology</li>
				<li><strong>Occupation:</strong>  Barista</li>
				<li><strong>Technology:</strong>  MacBook Air, iPhone 8</li>
				<li><strong>Hobbies:</strong>  Cycling, local music, craft beer</li>
				<li><strong>Relationship Status:</strong>  Single</li>
			</ul>
			<p>Karissa is a recent transplant to Albuquerque from Sioux Falls, South Dakota, and is looking to meet new people and find fun things to do locally.
				She is currently working as a barista at a local coffee shop, but is looking for employment in her field. She moved to Albuquerque
				after college mainly to get a "new perspective" and because she "needed a change of scenery." She is always tweeting quippy observations
				on her phone, noting the idiosyncracies of Albuquerque compared with the Midwest where she hails from.</p>
			<p>Karissa likes the people that she works with, but wants to branch out and meet new friends to be able to go see a concert with,
				have a beer, or find new fun local things to do. She is a registered user of Reddit, but mainly uses Reddit for entertainment,
				viewing funny posts and memes, or finding local events and happenings. She is primarily passive user, rarely posting herself, instead preferring to use her Twitter 				account for her personal musings. She does, however, ask questions in posts and comment threads when she has a specific question regarding an event she is 				interested in, i.e., should I arrive early to Geeks Who Drink to make sure I get a seat, or is it usually not too crowded?</p>
		<h1>User Story</h1>
		<p>As a registered user, Karissa wants to be able to respond to posts/comment threads about events, to ask questions about the event.</p>
		<h1>Use Case/Interaction Flow</h1>
			<ul>
				<li>Karissa clicks on the post about an event that she is interested in.</li>
				<li>Reddit loads the page with the post, displaying the full content of the post, and any comment threads.</li>
				<li>Karissa clicks on the comment text area to fill out the comment field with her question. If she is responding to a particular comment in a thread, she clicks 				the reply link beneath the respective comment.</li>
				<li>If she is replying to a comment, the site opens a comment field when reply button is clicked.</li>
				<li>Karissa fills out the comment field with her question. She clicks the save button to post her comment/question.</li>
				<li>The site then displays her comment in its own thread beneath the original post if it was responding directly to the original post. If her comment was repsonding 				to another comment thread, then her comment displays beneath the comment she was responding to.</li>
			</ul>
		<h1>Conceptual Model</h1>
			<h2>Entities & Attributes</h2>
				<h3>Profile</h3>
					<ul>
						<li>profileId (primary key)</li>
						<li>profileUserName</li>
						<li>profileAvatar</li>
						<li>profileHash</li>
						<li>profileSalt</li>
						<li>profileActivationToken</li>
					</ul>
				<h3>Post</h3>
					<ul>
						<li>postId (primary key)</li>
						<li>postProfileId (foreign key)</li>
						<li>postContent</li>
						<li>postDateTime</li>
						<li>postTitle</li>
					</ul>
				<h3>Comment</h3>
					<ul>
						<li>commentId (primary key)</li>
						<li>commentProfileId (foreign key)</li>
						<li>commentPostId (foreign key)</li>
						<li>commentCommentId (foreign key)</li>
						<li>commentDateTime</li>
						<li>commentContent</li>
					</ul>
			<h2>Relations</h2>
				<ul>
					<li>One profile can create many posts. (1 to n)</li>
					<li>One post can have many comments. (1 to n)</li>
					<li>One comment can have many comments. (1 to n)</li>
				</ul>
	</body>
</html>