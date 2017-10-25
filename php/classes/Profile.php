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
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for profile id
	 *
	 * @return Uuid value of profile id
	 **/
	public function getProfileId(): Uuid {
		return ($this->profileId);
	}

	/**
	 * mutator method for profile id
	 *
	 * @param Uuid /string $newProfileId new value of profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if $newProfileId is not a uuid or string
	 **/
	public function setProfileId($newProfileId): void {
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
	public function getProfileUserName(): string {
		return ($this->profileUserName);
	}

	/**
	 * mutator method for profile username
	 *
	 * @param string $newProfileUserName new value of profile username
	 * @throws \InvalidArgumentException if $newProfileUserName is not a string or insecure
	 * @throws \RangeException if $newProfileUserName is > 32 characters
	 * @throws \TypeError if $newProfileUserName is not a string
	 */
	public function setProfileUserName(string $newProfileUserName): void {
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

	/**
	 * accessor method for the profile avatar
	 *
	 * @param string $newProfileAvatar new value of profile avatar
	 * @throws \InvalidArgumentException if $newProfileAvatar is not a string or insecure
	 * @throws \RangeException if $newProfileAvatar is > 32 characters
	 * @throws \TypeError if $newProfileAvatar is not a string
	 **/
	public function setProfileAvatar(string $newProfileAvatar): void {
		// verify the profile avatar is secure
		$newProfileAvatar = trim($newProfileAvatar);
		$newProfileAvatar = filter_var($newProfileAvatar, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileAvatar) === true) {
			throw(new \InvalidArgumentException("profile avatar is empty or insecure"));

		}

		// verify the profile avatar will fit in the database
		if(strlen($newProfileAvatar) > 32) {
			throw(new \RangeException("profile avatar link is too large"));
		}

		// store the profile avatar
		$this->profileAvatar = $newProfileAvatar;
	}

	/**
	 * accessor method for profile activation token
	 *
	 * @return string value of profile activation token
	 **/
	public function getProfileActivationToken(): string {
		return ($this->profileActivationToken);
	}

	/**
	 * mutator method for profile activation token
	 *
	 * @param string $newProfileActivationToken new value of profile activation token
	 * @throws \InvalidArgumentException if the activation token is not secure
	 * @throws \RangeException if $newProfileActivationToken is not 32 characters
	 * @throws \TypeError if $newProfileActivationToken is not a string
	 **/
	public function setProfileActivationToken(string $newProfileActivationToken) : void {
		if(empty($newProfileActivationToken) === true) {
			throw(new \InvalidArgumentException("profile activation token empty or insecure"));
		}

		//enforce that activation token is a string
		if(is_string($newProfileActivationToken) !== true) {
			throw(new \TypeError("acivation token is not a string"));
		}

		//enforce that activation token is exactly 32 characters
		if(strlen($newProfileActivationToken) !== 32) {
			throw(new \RangeException("profile activation token must be 32 characters"));
		}

		//store the activation token
		$this->profileActivationToken = $newProfileActivationToken;
	}

	/**
	 * accessor method for profile hash password
	 *
	 * @return string value of profile hash
	 **/
	public function getProfileHash() : string {
		return($this->profileHash);
	}

	/**
	 * mutator method for profile hash
	 *
	 * @param string $newProfileHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 128 characters
	 * @throws \TypeError if profile hash is not a string
	 **/
	public function setProfileHash(string $newProfileHash) : void {
		//enforce that the hash is properly formatted
		$newProfileHash = trim($newProfileHash);
		$newProfileHash = strtolower($newProfileHash);
		if(empty($newProfileHash) === true) {
			throw(new \InvalidArgumentException("profile password hash empty or insecure"));
		}

		//enforce that the hash is a string representation of a hexadecimal
		if(!ctype_xdigit($newProfileHash)) {
			throw(new \InvalidArgumentException("profile password hash is empty or insecure"));
		}

		//enforce that hash is exactly 128 characters
		if(strlen($newProfileHash) !== 128) {
			throw(new \RangeException("profile hash must be 128 characters"));
		}

		//store the hash
		$this->profileHash = $newProfileHash;
	}
	/**
	 * accessor method for profile password salt
	 *
	 * @return string value of profile salt
	 **/
	public function getProfileSalt() : string {
		return($this->profileSalt);
	}

	/**
	 * mutator method for profile password salt
	 *
	 * @return string $newProfileSalt
	 * @throws \InvalidArgumentException if the salt is not secure
	 * @throws \RangeException if the salt is not 64 characters
	 * @throws \TypeError if profile salt is not a string
	 **/
	public function setProfileSalt(string $newProfileSalt) : void {
		//enforce that the salt is properly formatted
		$newProfileSalt = trim($newProfileSalt);
		$newProfileSalt = strtolower($newProfileSalt);
		if(empty($newProfileSalt) === true) {
			throw(new \InvalidArgumentException("profile password salt empty or insecure"));
		}

		//enforce that the salt is a string representation of hexadecimal
		if(!ctype_xdigit($newProfileSalt)) {
			throw(new \InvalidArgumentException("profile password salt is empty or insecure"));
		}

		//enforce that the salt is exactly 64 characters
		if(strlen($newProfileSalt) !== 128) {
			throw(new \RangeException("profile salt must be 64 characters"));
		}

		//store the salt
		$this->profileSalt = $newProfileSalt;
	}

	/**
	 * Inserts this User into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {

		// create query template
		$query = "INSERT INTO profile(profileId, profileActivationToken, profileUserName, profileAvatar, profileHash, profileSalt) VALUES(:profileId, :profileActivationToken, :profileUserName, :profileAvatar, :profileHash, :profileSalt)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["profileId" => $this->profileId->getBytes(), "profileActivationToken" => $this->profileActivationToken, "profileUserName" => $this->profileUserName, "profileAvatar" => $this->profileAvatar, "profileHash" => $this->profileHash, "profileSalt" => $this->profileSalt];
		$statement->execute($parameters);
	}

	/**
	 * deletes this Profile from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {

		// create query template
		$query = "DELETE FROM profile WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["profileId" => $this->profileId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * update the Profile in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		// create query template
		$query = "UPDATE profile SET profileUserName = :profileUserName, profileAvatar = :profileAvatar, profileHash = :profileHash, profileSalt = :profileSalt, profileActivationToken = :profileActivationToken WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		$parameters = ["profileId" => $this->profileId->getBytes(), "profileUserName" => $this->profileUserName, "profileAvatar" => $this->profileAvatar, "profileHash" => $this->profileHash, "profileSalt" => $this->profileSalt, "profileActivationToken" => $this->profileActivationToken];
		$statement->execute($parameters);
	}

	/**
	 * gets the profile by profileId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid | string $profileId profile id to search for
	 * @return Profile | null Profile found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable is not the correct type
	 **/
	public static function getProfileByProfileId(\PDO $pdo, $profileId) : ?Profile {
		// sanitize the profileId before searching
		try {
			$profileId = self::validateUuid($profileId);
		} catch(\InvalidArgumentException | \RangeException | Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT profileId, profileUserName, profileAvatar, profileHash, profileSalt, profileActivationToken WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);

		// bind the profile id to the place holder in the template
		$parameters = ["profileId" => $profileId->getBytes()];
		$statement->execute($parameters);

		// grab the tweet from mySQL
		try {
			$profile = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$profile = new Profile($row["profileId"], $row["profileUserName"], $row["profileAvatar"], $row["profileHash"], $row["profileSalt"], $row["profileActivationToken"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw (new \PDOException($exception->getMessage(), 0 , $exception));
		}
		return($profile);
	}

	/**
	 * gets all Profiles
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Profiles found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllProfiles(\PDO $pdo) : \SplFixedArray {
		// create query template
		$query = "SELECT profileId, profileUserName, profileAvatar, profileHash, profileSalt, profileActivationToken FROM profile";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of profiles
		$profiles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$profile = new Profile($row["profileId"], $row["profileUserName"], $row["profileAvatar"], $row["profileHash"], $row["profileSalt"], $row["profileActivationToken"]);
				$profiles[$profiles->key()] = $profile;
				$profiles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($profiles);
	}

	/**
	 * foramts the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
}
?>