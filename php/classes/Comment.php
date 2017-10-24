<?php

/**
 * A comment on Reddit
 *
 * @author Nick Pascetti <npascetti@gmail.com>
 * @version 1.0.0
 **/
class Comment {

	/**
	 * id for this comment; this is a primary key
	 * @var Uuid $commentId
	 **/
	private $commentId;
	/**
	 * id for the comment profile id; this is a foreign key
	 * @var Uuid $commentProfileId
	 **/
	private $commentProfileId;
	/**
	 * id for the post the comment is originating from; this is a foreign key
	 * @var Uuid $commentPostId
	 **/
	private $commentPostId;
	/**
	 * id for the comment that the comment is a child of; this is a foreign key
	 * @var Uuid $commentCommentId
	 **/
	private $commentCommentId;
	/**
	 * actual textual content of the comment
	 * @var string $commentContent
	 **/
	private $commentContent;
	/**
	 * date and time the comment was made, in a PHP DateTime object
	 * @var \DateTime $commentDateTime
	 **/
	private $commentDateTime;

	/**
	 * constructor for this Comment
	 *
	 * @param string | Uuid $newCommentId id of this Comment or null if a new Comment
	 * @param string | Uuid $newCommentProfileId id of the profile that created this Comment
	 * @param string | Uuid $newCommentPostId id of the Post that the comment originates from
	 * @param string | Uuid $newCommentCommentId id of the Comment that is the parent of the created comment
	 * @param \DateTime | string | null $newCommentDateTime date and time Comment was created or null if set to current date and time
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @documentation https://php.net/manua;/en/language.oop5.decon.php
	 **/
	public function __construct($newCommentId, $newCommentProfileId, $newCommentPostId, $newCommentCommentId, string $newCommentContent, $newCommentDateTime = null) {
		try {
			$this->setCommentId($newCommentId);
			$this->setCommentProfileId($newCommentProfileId);
			$this->setCommentPostId($newCommentPostId);
			$this->setCommentCommentId($newCommentCommentId);
			$this->setCommentContent($newCommentContent);
			$this->setCommentDateTime($newCommentDateTime);
		}
		//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 *accessor method for comment id
	 *
	 * @return Uuid value of comment id
	 **/
	public function getCommentId() : Uuid {
		return($this->commentId);
	}

	/**
	 * mutator method for comment id
	 *
	 * @param Uuid/string $newCommentId new value of comment id
	 * @throws \RangeException if $newCommentId is not positive
	 * @throws \TypeError if $newPostId is not a uuid or string
	 **/
	public function setCommentId($newCommentId) : void {
		try {
			$uuid = self::validateUuid($newCommentId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the comment id
		$this->commentId = $uuid;
	}

	/**
	 * accessor method for comment profile id
	 *
	 * @return Uuid value of comment profile id
	 **/
	public function getCommentProfileId() : Uuid {
		return($this->commentProfileId);
	}

	/**
	 * mutator method for comment profile id
	 *
	 * @param string | Uuid $newCommentProfileId new value of comment profile id
	 * @throws \RangeException if $newCommentProfileId is not positive
	 * @throws \TypeError if $newCommentProfileId is not an integer
	 **/
	public function setCommentProfileId($newCommentProfileId) : void {
		try {
			$uuid = self::validateUuid($newCommentProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		//convert and store the comment profile id
		$this->commentProfileId = $uuid;
	}

	/**
	 * accessor method for comment post id
	 *
	 * @return Uuid value of comment post id
	 **/
	public function getCommentPostId() : Uuid{
		return($this->commentPostId);
	}

	/**
	 * mutator method for comment post id
	 *
	 * @param string | Uuid $newCommentPostId new value of comment post id
	 * @throws \RangeException if $newCommentPostId is not positive
	 * @throws \TypeError if $newCommentPostId is not an integer
	 **/
	public function setCommentPostId($newCommentPostId) : void {
		try {
			$uuid = self::validateUuid($newCommentPostId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		//convert and store the comment profile id
		$this->commentPostId = $uuid;
	}

	/**
	 * accessor method for comment comment id
	 *
	 * @return Uuid value of comment comment id
	 **/
	public function getCommentCommentId() : Uuid{
		return($this->commentCommentId);
	}

	/**
	 * mutator method for comment comment id
	 *
	 * @param string | Uuid $newCommentCommentId new value of comment comment id
	 * @throws \RangeException if $newCommentCommentId is not positive
	 * @throws \TypeError if $newCommentCommentId is not an integer
	 **/
	public function setCommentCommentId($newCommentCommentId) : void {
		try {
			$uuid = self::validateUuid($newCommentCommentId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the comment comment id
		$this->commentCommentId = $uuid;
	}

	/**
	 * accessor method for comment content
	 *
	 * @return string value of comment content
	 **/
	public function getCommentContent() : string {
		return($this->commentContent);
	}

	/**
	 * mutator method for comment content
	 *
	 * @param string $newCommentContent new value of comment content
	 * @throws \InvalidArgumentException if $newCommentContent is not a string or insecure
	 * @throws \RangeException if $newCommentContent is > 40000 characters
	 * @throws \TypeError if $newCommentContent is not a string
	 **/
	public function setCommentContent(string $newCommentContent) : void {
		// verify the comment content is secure
		$newCommentContent = trim($newCommentContent);
		$newCommentContent = filter_var($newCommentContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newCommentContent) === true) {
			throw(new \InvalidArgumentException("comment content is empty or insecure"));
		}

		// verify the comment content will fit in the database
		if(strlen($newCommentContent) > 40000) {
			throw(new \RangeException("comment content too large"));
		}

		// store the comment content
		$this->commentContent = $newCommentContent;
	}

	/**
	 * accessor method for comment date time
	 *
	 * @return \DateTime value of comment date time
	 **/
	public function getCommentDateTime() : \DateTime {
		return($this->commentDateTime);
	}

	/**
	 * mutator method for comment date time
	 *
	 * @param \DateTime | string | null $newCommentDateTime comment date time as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newCommentDateTime is not a valid object or string
	 * @throws \RangeException if $newCommentDateTime is a date that does not exist
	 **/
	public fun


}

?>

