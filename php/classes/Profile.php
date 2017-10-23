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
	 * activation token for the profile
	 * @var string $profileActivationToken
	 **/
	private $profileActivationToken;

	/**
	 * constructor for this Profile
	 *
	 * @param string | Uuid $newProfileId id of this Profile or null if a new profile
	 * @param string $newProfileUserName string containing the profile username
	 * @param string $newProfileAvatar string containing link to profile avatar image or null if unused
	 * @param string | null $newProfileHash string containing the profile password hash
	 * @param string $newProfileSalt string containing the profile password salt
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., string too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @documentation php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newProfileId, string $newProfileUserName, string $newProfileAvatar = null, string $newProfileHash, string $newProfileSalt, string $newProfileActivationToken) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileUserName($newProfileUserName);
			$this->setProfileAvatar($newProfileAvatar);
			$this->setProfileHash($newProfileHash);
			$this->setProfileSalt($newProfileSalt);
			$this->setProfileActivationToken($newProfileActivationToken);
		}
		//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | Exception | \TypeError $exception)
		{
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for profile id
	 *
	 * @return Uuid value of profile id
	 **/
	public function getProfileId() : Uuid {
		return($this->profileId);
	}

	/**
	 * mutator method for profile id
	 *
	 * @param Uuid/string $newProfileId new value of profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if $newProfileId is not a uuid or string
	 **/
	public function setProfileId( $newProfileId) : void {
		try {
			$uuid = self::validateUuid($newProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the profile id
		$this->profileId = $uuid;
	}

	/**
	 * accessor method for profile username
	 *
	 * @return string value of profile username
	 **/
	public function getProfileUserName() : string {
		return($this->profileUserName);
	}

	/**
	 * mutator method for profile username
	 *
	 * @param string $newProfileUserName new value of profile username
	 * @throws \InvalidArgumentException if $newProfileUserName is not a string or insecure
	 * @throws \RangeException if $newProfileUserName is > 32 characters
	 * @throws \TypeError if $newProfileUserName is not a string
	 */
	public function setProfileUserName(string $newProfileUserName) : void {
		//verify the profile username is secure
		$newProfileUserName = trim($newProfileUserName);
		$newProfileUserName = filter_var($newProfileUserName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileUserName) === true) {
			throw (new \InvalidArgumentException("profile username is empty or insecure"));
		}
		// verify the profile username will fit in database
		if(strlen($newProfileUserName) > 32) {
			throw(new \RangeException("profile username is too large"));
		}

		// store the profile username
		$this->profileUserName = $newProfileUserName;
	}
}
?>