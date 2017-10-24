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
	 * constructor
	 */
}

?>

