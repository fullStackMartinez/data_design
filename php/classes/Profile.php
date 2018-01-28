<?php

namespace Edu\Cnm\DataDesign;

require_once("autoloader.php");
require_once(dirname(__DIR__, 2) . "classes/autoloader.php");

use Ramsey\Uuid\Uuid;

/**
 * Small cross section for the entity/class of the "Medium.com" Profile
 *
 * This class, which is named Profile, can be explained as the template each user, reader and author can expect to fill out in order to participate on the Medium.com platform. It is a high class entity with a primary key, which will be used by other entiities.
 *
 * @author Esteban Martinez <fullstackmartinez@gmail.com> <https://github.com/fullStackMartinez/data_design>
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * @version 3.0.0
 **/
class Profile implements \JsonSerializable {
	use ValidateUuid;
	/**
	 * This is the id for this Profile; this is the primary key and will be in UUID form
	 * @var Uuid $profileId
	 **/
	private $profileId;
	/**
	 * profileName is the chosen display name of the Profile owner
	 * @var string $profileName
	 **/
	private $profileName;
	/**
	 * actual first name of the profile owner
	 * @var string $profileFirstName
	 **/
	private $profileFirstName;
	/**
	 * actual last name of the profile owner
	 * @var string $profileLastName ;
	 **/
	private $profileLastName;
	/**
	 * phone number of the profile owner
	 * @var string $profilePhone ;
	 **/
	private $profilePhone;
	/**
	 * email of profile owner needed for confirmation and contact
	 * @var string $profileEmail ;
	 **/
	private $profileEmail;
	/**
	 * chosen password of the Profile owner
	 * @var string $profilePassword ;
	 **/
	private $profilePassword;
	/**
	 * hash for profile password
	 * @var string $profileHash;
	 **/
	private $profileHash;
	/**
	 * salt for Profile
	 * @var string $profileSalt;
	 **/
	private $profileSalt;

	/**
	 * __constructor method for this Profile class
	 *
	 * @param string|Uuid $newProfileId of this entity or null if a new user
	 * @param string $newProfileName string that contains the chosen display name of the profile owner
	 * @param string $newProfileFirstName string which contains the first name of the profile owner
	 * @param string $newProfileLastName string which contains the last name of the profile owner
	 * @param string $newProfilePhone string with the contact phone number of profile owner
	 * @param string $newProfileEmail string which contains the contact email of the profile owner
	 * @param string $newProfilePassword string with the chosen password to the profile
	 * @param string $newProfileHash string containing password hash for discretion
	 * @param string $newProfileSalt string containing password salt
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are outside of their allotted memory
	 * @throws \TypeError if a data type violates data limits
	 * @throws \Exception if other exceptions are needed
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newProfileId, string $newProfileName, string $newProfileFirstName, string $newProfileLastName, ?string $newProfilePhone, string $newProfileEmail, string $newProfilePassword, string $newProfileHash, string $newProfileSalt) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileName($newProfileName);
			$this->setProfileFirstName($newProfileFirstName);
			$this->setProfileLastName($newProfileLastName);
			$this->setProfilePhone($newProfilePhone);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfilePassword($newProfilePassword);
			$this->setProfileHash($newProfileHash);
			$this->setProfileSalt($newProfileSalt);
		} catch(\InvalidArgumentException | \RangeException |\TypeError | \Exception $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}


	/**
	 *  accessor method for getting the profile Id of user
	 *
	 * @return Uuid value of profileID
	 */
	public function getProfileId(): Uuid {
		return ($this->profileId);
	}


	/**
	 * mutator method for the private property profileId
	 *
	 * @param Uuid|string $newProfileId new value of profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if $newProfileId is not a uuid or string
	 */

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
	 * accessor method for the profile name/display name of the profile
	 * return string value of profile name
	 */
	public function getProfileName(): string {
		return ($this->profileName);
	}

	/**
	 * mutator method for profile name varchar 32
	 *
	 * @param string $newProfileName new value of profile name
	 * @throws \InvalidArgumentException if $newProfileName is not a string or insecure
	 * @throws \RangeException if $newProfileName is > 32 characters
	 * @throws \TypeError if $newProfileName is not a string
	 */
	public function setProfileName(string $newProfileName): void {
		// verify the chosen profile name is safe
		$newProfileName = trim($newProfileName);
		$newProfileName = filter_var($newProfileName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileName) === true) {
			throw(new \InvalidArgumentException("sorry, chosen profile name is empty or insecure"));
		}

		// verify the chosen profile name will fit in the database varchar32
		if(strlen($newProfileName) > 32) {
			throw(new \RangeException("sorry, chosen profile name is too large"));
		}

		// save the new profile name
		$this->profileName = $newProfileName;
	}


	/**
	 * accessor method for the profile Users' first name
	 * return string value of profile first name
	 */
	public function getProfileFirstName(): string {
		return ($this->profileFirstName);
	}

	/**
	 * mutator method for profile first name varchar 128
	 *
	 * @param string $newProfileFirstName new value of Users' first name
	 * @throws \InvalidArgumentException if $newProfileFirstName is not a string or insecure
	 * @throws \RangeException if $newProfileFirstName is > 128 characters
	 * @throws \TypeError if $newProfileFirstName is not a string
	 */
	public function setProfileFirstName(string $newProfileFirstName): void {
		// verify the Users' entered first name is safe
		$newProfileFirstName = trim($newProfileFirstName);
		$newProfileFirstName = filter_var($newProfileFirstName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileFirstName) === true) {
			throw(new \InvalidArgumentException("sorry, Users' first name is empty or insecure"));
		}


		// verify the first name will fit in the database varchar128
		if(strlen($newProfileFirstName) > 128) {
			throw(new \RangeException("sorry,Users' first name is too large"));
		}

		// save the Users' first name
		$this->profileFirstName = $newProfileFirstName;
	}

	/**
	 * accessor method for the profile Users' last name
	 * return string value of profile last name
	 */
	public function getProfileLastName(): string {
		return ($this->profileLastName);
	}

	/**
	 * mutator method for profile last name varchar 128
	 *
	 * @param string $newProfileLastName new value of Users' last name
	 * @throws \InvalidArgumentException if $newProfileLastName is not a string or insecure
	 * @throws \RangeException if $newProfileLastName is > 128 characters
	 * @throws \TypeError if $newProfileLastName is not a string
	 */
	public function setProfileLastName(string $newProfileLastName): void {
		// verify the Users' entered last name is safe
		$newProfileLastName = trim($newProfileLastName);
		$newProfileLastName = filter_var($newProfileLastName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileLastName) === true) {
			throw(new \InvalidArgumentException("sorry, Users' last name is empty or insecure"));
		}

		// verify the last name will fit in the database varchar128
		if(strlen($newProfileLastName) > 128) {
			throw(new \RangeException("sorry,Users' last name is too large"));
		}

		// save the Users' last name
		$this->profileLastName = $newProfileLastName;
	}

	/**
	 * accessor method for the profile Users' phone number
	 * return string value of profile phone number
	 */
	public function getProfilePhone(): string {
		return ($this->profilePhone);
	}

	/**
	 * mutator method for profile phone number varchar 32
	 *
	 * @param string $newProfilePhone new value of Users' phone number
	 * @throws \InvalidArgumentException if $newProfilePhone is not a string or insecure
	 * @throws \RangeException if $newProfilePhone is > 32 characters
	 * @throws \TypeError if $newProfilePhone is not a string
	 */
	public function setProfilePhone(string $newProfilePhone): void {
		// verify the Users' entered phone number is safe
		$newProfilePhone = trim($newProfilePhone);
		$newProfilePhone = filter_var($newProfilePhone, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfilePhone) === true) {
			throw(new \InvalidArgumentException("sorry, Users' phone number is empty or insecure"));
		}

		// verify the phone number will fit in the database varchar128
		if(strlen($newProfilePhone) > 32) {
			throw(new \RangeException("sorry, Users' phone number is too large"));
		}

		// save the Users' phone number
		$this->profilePhone = $newProfilePhone;
	}

	/**
	 * accessor method for the profile Users' email address
	 * return string value of profile email
	 */
	public function getProfileEmail(): string {
		return ($this->profileEmail);
	}

	/**
	 * mutator method for profile email varchar 128
	 *
	 * @param string $newProfileEmail new value of Users' email
	 * @throws \InvalidArgumentException if $newProfileEmail is not a string or insecure
	 * @throws \RangeException if $newProfileEmail is > 128 characters
	 * @throws \TypeError if $newProfileEmail is not a string
	 */
	public function setProfileEmail(string $newProfileEmail): void {
		// verify the Users' entered last name is safe
		$newProfileEmail = trim($newProfileEmail);
		$newProfileEmail = filter_var($newProfileEmail, FILTER_SANITIZE_EMAIL, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileEmail) === true) {
			throw(new \InvalidArgumentException("sorry, Users' email is empty or insecure"));
		}

		// verify the email will fit in the database varchar128
		if(strlen($newProfileEmail) > 128) {
			throw(new \RangeException("sorry,Users' email is too large"));
		}

		// save the Users' email
		$this->profileEmail = $newProfileEmail;
	}

	/**
	 * accessor method for the profile Users' password
	 * return string value of profile password
	 */
	public
	function getProfilePassword(): string {
		return ($this->profilePassword);
	}

	/**
	 * mutator method for profile password varchar 128
	 *
	 * @param string $newProfilePassword new value of Users' password
	 * @throws \InvalidArgumentException if $newProfilePassword is not a string or insecure
	 * @throws \RangeException if $newProfilePassword is > 128 characters
	 * @throws \TypeError if $newProfilePassword is not a string
	 */
	public
	function setProfilePassword(string $newProfilePassword): void {
		// verify the Users' entered password is safe
		$newProfilePassword = trim($newProfilePassword);
		$newProfilePassword = filter_var($newProfilePassword, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfilePassword) === true) {
			throw(new \InvalidArgumentException("sorry, Users' password is empty or insecure"));
		}

		// verify the password will fit in the database varchar128
		if(strlen($newProfilePassword) > 128) {
			throw(new \RangeException("sorry, Users' password is too large"));
		}

		// save the Users' password
		$this->profilePassword = $newProfilePassword;
	}
	/**
	 * accessor method for the hash for the profile password
	 * return string value for hash
	 */
	public function getProfileHash(): string {
		return ($this->profileHash);
	}
	/**
	 * mutator method for profile hash password
	 *
	 * @param string $newProfileHash
	 * @throws \InvalidArgumentException if $newProfileHash for the profile password is not secure
	 * @throws \RangeException if the password $newProfileHash is not 128 characters
	 * @throws \TypeError if password $newProfileHash is not a string
	 */
	public function setProfileHash(string $newProfileHash): void {
		//make sure hash is safe and formatted correctly
		$newProfileHash = trim($newProfileHash);
		$newProfileHash = strtolower($newProfileHash);
		if(empty($newProfileHash) === true) {
			throw(new \InvalidArgumentException("sorry, the password hash is either empty or insecure"));
		}
		//make sure the hash is a string representation of a hexadecimal
		if(!ctype_xdigit($newProfileHash)) {
			throw(new \InvalidArgumentException("sorry, the password hash is either empty or insecure"));
		}
		//make sure that the password hash is exactly 128 characters.
		if(strlen($newProfileHash) !== 128) {
			throw(new \RangeException("sorry, password hash must be exactly 128 characters"));
		}
		//save the Profiles password hash
		$this->profileHash = $newProfileHash;
	}
	/**
	 *accessor method for profile salt
	 *
	 * @return string for salt
	 */
	public function getProfileSalt(): string {
		return $this->profileSalt;
	}
	/**
	 * mutator method for profile salt
	 *
	 * @param string $newProfileSalt
	 * @throws \InvalidArgumentException if $newProfileSalt is not secure
	 * @throws \RangeException if $newProfileSalt is not 64 characters
	 * @throws \TypeError if $newProfileSalt is not a string
	 */
	public function setProfileSalt(string $newProfileSalt): void {
		//make sure that profile salt is formatted
		$newProfileSalt = trim($newProfileSalt);
		$newProfileSalt = strtolower($newProfileSalt);
		//make sure that the profile salt is a string
		if(!ctype_xdigit($newProfileSalt)) {
			throw(new \InvalidArgumentException("sorry, profile salt is empty or insecure"));
		}
		//make sure that the salt is exactly 64 characters.
		if(strlen($newProfileSalt) !== 64) {
			throw(new \RangeException("sorry, profile salt must be 128 characters"));
		}
		//save the profile salt
		$this->profileSalt = $newProfileSalt;
	}
	/**
	 * inserts this Profile class into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo): void {
		// create the INSERT INTO query template
		$query = "INSERT INTO profile(profileId, profileName, profileFirstName, profileLastName,  profilePhone, profileEmail, profilePassword, profileHash, profileSalt) VALUES (:profileId, :profileName, :profileFirstName, :profileLastName, :profilePhone, :profileEmail, :profilePassword, :profileHash, :profileSalt)";
		$statement = $pdo->prepare($query);
		$parameters = ["profileId" => $this->profileId->getBytes(), "profileName" => $this->profileName, "profileFirstName" => $this->profileFirstName, "profileLastName" => $this->profileLastName, "profilePhone" => $this->profilePhone, "profileEmail" => $this->profileEmail, "profilePassword" => $this->profilePassword, "profileHash" => $this->profileHash, "profileSalt" => $this->profileSalt];
		$statement->execute($parameters);
	}
	/**
	 * deletes this Profile class from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {
		// create DELETE FROM query template
		$query = "DELETE FROM profile WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);
		//bind the member variables to the place holders in the template
		$parameters = ["profileId" => $this->profileId->getBytes()];
		$statement->execute($parameters);
	}
	/**
	 * updates this Profile class from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 **/
	public function update(\PDO $pdo): void {
		// create UPDATE query template
		$query = "UPDATE profile SET profileId = :profileId, profileName = :profileName, profileFirstName = :profileFirstName, profileLastName = :profileLastName, profilePhone = :profilePhone, profileEmail = :profileEmail, profilePassword = :profilePassword, profileHash = :profileHash, profileSalt = :profileSalt WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holders in the template
		$parameters = ["profileId" => $this->profileId->getBytes(), "profileName" => $this->profileName, "profileFirstName" => $this->profileFirstName, "profileLastName" => $this->profileLastName, "profilePhone" => $this->profilePhone, "profileEmail" => $this->profileEmail, "profilePassword" => $this->profilePassword, "profileHash" => $this->profileHash, "profileSalt" => $this->profileSalt];
		$statement->execute($parameters);
	}
	/**
	 * gets the Profile by profile id
	 *
	 * @param \PDO $pdo $pdo PDO connection object
	 * @param string $profileId profile Id to search for
	 * @return Profile|null Profile or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getProfileByProfileId(\PDO $pdo, string $profileId):?Profile {
		// sanitize the profile id before searching
		try {
			$profileId = self::validateUuid($profileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		// create query template
		$query = "SELECT profileId, profileName, profileFirstName, profileLastName, profilePhone, profileEmail, profilePassword, profileHash, profileSalt FROM profile WHERE profileId = :profileId";
		$statement = $pdo->prepare($query);
		// bind the profile id to the place holder in the template
		$parameters = ["profileId" => $profileId->getBytes()];
		$statement->execute($parameters);
		// grab the Profile from mySQL database
		try {
			$profile = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$profile = new Profile($row["profileId"], $row["profileName"], $row["profileFirstName"], $row["profileLastName"],$row["profilePhone"], $row["profileEmail"], $row["profilePassword"], $row["profileHash"], $row["profileSalt"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($profile);
	}
	/**
	 * gets the Profile by chosen profile display name
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $profileName at handle to search for
	 * @return \SPLFixedArray of all profiles found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProfileByProfileName(\PDO $pdo, string $profileName) : \SPLFixedArray {
		// sanitize the profile name before searching
		$profileName = trim($profileName);
		$profileName = filter_var($profileName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($profileName) === true) {
			throw(new \PDOException("sorry, not a valid profile name"));
		}
		// create query template
		$query = "SELECT  profileId, profileName, profileFirstName, profileLastName, profilePhone, profileEmail, profilePassword, profileHash, profileSalt FROM profile WHERE profileName = :profileName";
		$statement = $pdo->prepare($query);
		// bind the profile at handle to the place holder in the template
		$parameters = ["profileName" => $profileName];
		$statement->execute($parameters);
		$profiles = new \SPLFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while (($row = $statement->fetch()) !== false) {
			try {
				$profile = new Profile($row["profileId"], $row["profileName"], $row["profileFirstName"], $row["profileLastName"], $row["profilePhone"], $row["profileEmail"], $row["profilePassword"], $row["profileHash"], $row["profileSalt"]);
				$profiles[$profiles->key()] = $profile;
				$profiles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($profiles);
	}
	/**
	 * gets the Profile by profile email
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $profileEmail user email to search for
	 * @return Profile|null Profile or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getProfileByProfileEmail(\PDO $pdo, string $profileEmail): ?Profile {
		// sanitize the email before searching
		$profileEmail = trim($profileEmail);
		$profileEmail = filter_var($profileEmail, FILTER_VALIDATE_EMAIL);
		if(empty($profileEmail) === true) {
			throw(new \PDOException("sorry, this is not a valid email"));
		}
		// create query template
		$query = "SELECT profileId, profileName, profileFirstName, profileLastName, profilePhone, profileEmail, profilePassword, profileHash, profileSalt FROM profile WHERE profileEmail = :profileEmail";
		$statement = $pdo->prepare($query);
		// bind the profile email to the place holder in the template
		$parameters = ["profileEmail" => $profileEmail];
		$statement->execute($parameters);
		// grab the Profile from mySQL
		try {
			$profile = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$profile = new Profile($row["profileId"], $row["profileName"], $row["profileFirstName"], $row["profileLastName"], $row["profilePhone"], $row["profileEmail"], $row["profilePassword"], $row["profileHash"], $row["profileSalt"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($profile);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize(): array {
		$fields = get_object_vars($this);

		$fields["profileId"] = $this->profileId->toString();

		return ($fields);
	}
}