<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Data Design Project| Phase 1</title>
	</head>
	<body>
		<header>
			<h1>Data Design Project | Phase 0</h1>
			<nav>
				<ul>
					<li>Persona</li>
					<li>User Story</li>
					<li>Use Case/Interaction Flow</li>
					<li>Conceptual Model</li>
				</ul>
			</nav>
		</header>
		<section>
			<h3>Persona</h3>
			<p>Name: Andrew Candelaria<br>Age: 34<br>Male<br>Albuquerque, NM</p><br>
			<p>Andrew is a 28 year old male painter who lives in downtown Albuquerque. He is surrounded by the heart and soul
				of the city, feeling every breath and using it to fuel his art. Andrew is interested in building a community
				of like minded artists by reading, learning and blogging about &quot;Hispanic Art in New Mexico&quot;. He currently works at a
				a brewery serving local beers.</p>
			<p>Andrew loves art, and loves to be involved with all kinds or artists, but prefers to paint. He's likeable, he's social
				and serious about his art, and serious about expressing this love online.</p>
			<p><strong>Technology:</strong> Andrew has a Macbook that he purchased about 2 years ago. I's littered with design programs, prefers
				Illustrator, and it has stickers of local breweries. He loves it, takes it everywhere. He can whip up a logo or print
				in an hour.</p>
		</section>
		<section>
			<h3>User Stories</h3>
			<ul>
				<li>As a new user, I'd like to register for a profile</li>
				<li>As a registered user, I'd like to build my profile</li>
				<li>As an author, I'd like to write articles</li>
				<li>As a profile, I'd like to search tags</li>
				<li>As a reader, I'd like to write responses</li>
				<li>As a reader, I'd like to make bookmarks for later use/reading</li>
				<li>As a profile, I'd like to clap</li>
				<li>As a profile, I'd like to share articles</li>
			</ul>
		</section>
		<section>
			<h3>Use Case and Interaction Flow</h3>
			<h4>Use Case</h4>
			<p>Andrew just got back from a trip to San Francisco where he met with local artists in their
				Hispanic community. Having had a great and informative trip, Andrew wants to write a post about his trip and &quot;clap&quot; to that article.</p>
			<p>Precondition: Andrew is registered and signed into his Medium.com account</p>
			<p>Post-condition: Andrew's clap is displayed with other claps on Medium.com</p>
			<h4>Interaction Flow</h4>
			<ol>
				<li>Andrew goes to article writing box</li>
				<li>MEDIUM DISPLAYS PREVIOUSLY WRITTEN ARTICLES BY ANDREW</li>
				<li>Andrew writes his article</li>
				<li>MEDIUM SAVES THE ARTICLE</li>
				<li>Andrew  clicks the clap button</li>
				<li>MEDIUM RECORDS CLAP</li>
			</ol>
		</section>
		<section>
			<h3>Conceptual Model</h3>
			<h4>Example of Entity and its' Attributes</h4>
			<dl>
				<dt>Entity</dt>
				<dd>-Attribute</dd>
				<dd>-Attribute</dd>
			</dl>
			<dl>
				<dt>Profile</dt>
				<dd>profileId</dd>
				<dd>profileName</dd>
				<dd>profileFirstName</dd>
				<dd>profileLastName</dd>
				<dd>profilePhone</dd>
				<dd>profileEmail</dd>
				<dd>profilePassword</dd>
				<dd>profileHash</dd>
				<dd>profileSalt</dd>
			</dl>

			<dl>
				<dt>Article</dt>
				<dd>articleId</dd>
				<dd>articleTitle</dd>
				<dd>articleContent</dd>
				<dd>articleDate</dd>
				<dd>articleLength</dd>
				<dd>articleProfileId</dd>
			</dl>
			<dl>
				<dt>Clap</dt>
				<dd>clapId</DD>
				<dd>clapProfileId</dd>
				<dd>clapArticleId</dd>
				<dd>clapDate</dd>
			</dl>
		</section>
		<section>
			<h1>Phase 1</h1>
			<h3>Entity-Relationship Diagram</h3>
			<img src="images/erd.png" alt="ERD Image">
		</section>
	</body>
</html>