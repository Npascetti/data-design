<?php
/**
 * A class representing a profile on Reddit
 *
 * @author Nick Pascetti <Npascetti@gmail.com>
 * @version 1.0.0
 **/

class Profile {
	/**
	 * id for the user Profile; this is the primary key
	 * @var Uuid $profileId
	 **/
	private $profileId;
	/**
	 * the username of the profile
	 * @var string $profileUserName
	 **/
	private $profileUserName;
	/**
	 * a link to the avatar image of the profile
	 * @var string $profileAvatar
	 **/
	private $profileAvatar;
	/**
	 * hash for the profile password
	 * @var  string $profileHash
	 **/
	private $profileHash;
	/**
	 * salt for the profile password
	 * @var string $profileSalt
	 **/
	private $profileSalt;

	/**
	 * constructor for this Profile
	 *
	 * @param string | Uuid $newProfileId id of this Profile or null if a new profile
	 * @param string $newProfileUserName string containing the profile username
	 * @param string $newProfileAvatar string containing link to profile avatar image or null if unused
	 * @param string $newProfileHash string containing the profile password hash
	 * @param string $newProfileSalt string containing the profile password salt
	 */
}
?>