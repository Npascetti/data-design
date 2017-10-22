<?php
require "../../vendor/autoload.php";

use Ramsey\Uuid\Uuid;
/**
 *A post on Reddit
 *
 * @author Nick Pascetti <npascetti@gmail.com>
 * @version 1.0.0
 * */
class Post {
	/**
	 * id for the Post; this is the primary key
	 * @var Uuid $postId
	 **/
	private $postId;
	/**
	 * id for the Profile that posted the Post; this is a foreign key
	 * @var Uuid $postProfileId
	 **/
	private $postProfileId;
	/**
	 * actual textual content of the body of the Post
	 * @var string $postContent
	 **/
	private $postContent;
	/**
	 * actual textual content of the title of the Post
	 * @var string $postTitle
	 **/
	private $postTitle;
	/**
	 * date and time the Post was posted, in a PHP DateTime object
	 * @var \DateTime $postDateTime
	 **/
	private $postDateTime;

	/**
	 * constructor for this Post
	 *
	 * @param string|Uuid $newPostId id of this Post or null if a new Post
	 * @param string|Uuid $newPostProfileId id of the Profile that posted this post
	 * @param string $newPostContent string containing actual post content data
	 * @param string $newPostTitle string containing actual post title data
	 * @param \DateTime|string|null $newPostDateTime date and time Post was posted, or set to current date and time
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @documentation php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newPostId, $newPostProfileId, string $newPostContent, string $newPostTitle, $newPostDateTime = null) {
		try {
			$this->setPostId($newPostId);
			$this->setPostProfileId($newPostProfileId);
			$this->setPostContent($newPostContent);
			$this->setPostTitle($newPostTitle);
			$this->setPostDateTime($newPostDateTime);
		}
		//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | Exception | \TypeError $exception)
		{
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for post id
	 *
	 * @return Uuid value of post id
	 **/
	public function getPostId() : Uuid {
		return ($this->postId);
	}

	/**
	 * mutator method for post id
	 *
	 * @param Uuid/string $newPostId new value of tweet id
	 * @throws \RangeException if $newPostId is not positive
	 * @throws \TypeError if $newPostId is not a uuid or string
	 **/
	public function setPostId( $newPostId) : void {
		try {
			$uuid = self::validateUuid($newPostId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception)
		{
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		//convert and store the post id
		$this->postId = $uuid;
	}

	/**
	 * accessor method for post profile id
	 *
	 * @return Uuid value of post profile id
	 **/
	public function getPostProfileId() : Uuid {
		return($this->postProfileId);
	}

	/**
	 * mutator method for post profile id
	 *
	 * @param string | Uuid $newPostProfileId new value of post profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if $newPostProfileId is not an integer
	 **/
	public function setPostProfileId($newPostProfileId) : void {
		try {
			$uuid = self::validateUuid($newPostProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception)
		{
			/*exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));*/
		}

		//convert and store the profile id
		$this->postProfileId = $uuid;
	}

	/**
	 * accessor method for post content
	 *
	 * @return string value of post content
	 **/
	public function getPostContent() : string {
		return($this->postContent);
	}

	/**
	 * mutator method for post content
	 *
	 * @param string $newPostContent new value of post content
	 * @throws \InvalidArgumentException if $newPostContent is not a string or insecure
	 * @throws \RangeException if $newPostContent is > 40000 characters
	 * @throws \TypeError if $newPostContent is not a string
	 **/

	public function setPostContent(string $newPostContent) : void {
		//verify the post content is secure
		$newPostContent = trim($newPostContent);
		$newPostContent = filter_var($newPostContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newTweetContent) === true) {
			throw(new \InvalidArgumentException("tweet content is empty or insecure"));
		}

		//verify the post content will fit in the database
		if(strlen($newPostContent) > 40000) {
			throw(new \RangeException("post content too large"));
		}

		//store the post content
		$this->postContent = $newPostContent;
	}

	/**
	 * accessor method for post title
	 *
	 * @return string value of post content
	 **/
	public function getPostTitle() : string {
		return($this->postTitle);
	}

	/**
	 * mutator method for post title
	 *
	 * @param string $newPostTitle new value of post title
	 * @throws \InvalidArgumentException if $newPostTitle is not a string or insecure
	 * @throws \RangeException if $newPostTitle is > 500 characters
	 * @throws \TypeError if $newPostTitle is not a string
	 **/
	public function setPostTitle(string $newPostTitle) : void {
		//verify the post title is secure
		$newPostTitle = trim($newPostTitle);
		$newPostTitle = filter_var($newPostTitle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newPostTitle) === true) {
			throw(new \InvalidArgumentException("post title is empty or insecure"));
		}

		//verify the post title will fit in the database
		if(strlen($newPostTitle) > 500) {
			throw(new \RangeException("post title is too large"));
		}

		//store the post title
		$this->postTitle = $newPostTitle;
	}

	/**
	 * accessor method for post datetime
	 *
	 * @return \DateTime value of post datetime
	 **/
	public function getPostDateTime() : \DateTime {
		return($this->postDateTime);
	}

	/**
	 * mutator method for post datetime
	 *
	 * @param \DateTime | string | null $newPostDateTime post datetime as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newPostDateTime is not a valid object or string
	 * @throws \RangeException if $newPostDateTime is a date that does not exist
	 **/
	public function setPostDateTime($newPostDateTime = null) : void {
		//base case: if the date is null, use the current date and time
		if($newPostDateTime === null) {
			$this->postDateTime = new \DateTime();
			return;
		}

		//store the post datetime using the ValidateDate trait
		try {
			$newPostDateTime = self::validateDateTime($newPostDateTime);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			/*$exceptionType = get_class($exception:)
			throw(new $exceptionType($exception->getMessage(), 0, $exception));*/
		}
		$this->postDateTime = $newPostDateTime;
	}
}
?>