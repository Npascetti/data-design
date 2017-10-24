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
	public function __construct($newCommentId, $newCommentProfileId, $newCommentPostId, $newCommentCommentId, string $newCommentContent, $newCommentDateTime) {
	}
}

?>

