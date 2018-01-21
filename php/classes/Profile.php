<?php

namespace Edu\Cnm\DataDesign;

require_once("autoload.php");
require_once(dirname(__DIR__) . "autoload.php");

use Ramsey\Uuid\Uuid;

/**
 * Small cross section for the entity/class of the "Medium.com" Profile
 *
 * This class, Profile, can be explained as the template each user, reader and author can expect to fill out in order to participate on the Medium.com platform. It is a high class entity with a primary key, which will be used by other entiities.
 *
 * @author Esteban Martinez <fullstackmartinez@gmail.com> <https://github.com/fullStackMartinez/data_design>
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * @version 3.0.0
 **/
class Profile {
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
	 * @var string $profileLastName;
	 **/
	private $profileLastName;
	/**
	 * phone number of the profile owner
	 * @var string $profilePhone;
	 **/
	private $profilePhone;
	/**
	 * email of profile owner needed for confirmation and contact
	 * @var string $profileEmail;
	 **/
	private $profileEmail;
	/**
	 * chosen password of the Profile owner
	 * @var string $profilePassword;
	 **/
	private $profilePassword;

	/**
	 *  accessor method for getting the profile Id of user
	 *
	 * @return Uuid value of profileID
	 */
	public function getProfileId() : Uuid {
		return($this->profileId);
	}


/**
 * mutator method for the private property profileId
 *
 * Uuid/string $newProfileId new value of profile id
 * @throws \RangeException if $newProfileId is not positive
 * @throws \TypeError if $newProfileId is not a uuid or string
 */

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
 * accessor method for the profile name/display name of the profile
 * return string value of profile name
 */
	public function getProfileName() : string {
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
	public function setProfileName(string $newProfileName) : void {
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


/**
* accessor method for the profile Users' first name
* return string value of profile first name
*/
		public function getProfileFirstName() : string {
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
		public function setProfileFirstName(string $newProfileFirstName) : void {
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

			/**
			 * accessor method for the profile Users' last name
			 * return string value of profile last name
			 */
			public function getProfileLastName() : string {
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
			public function setProfileLastName(string $newProfileLastName) : void {
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

				/**
				 * accessor method for the profile Users' phone number
				 * return string value of profile phone number
				 */
				public function getProfilePhone() : string {
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
				public function setProfilePhone(string $newProfilePhone) : void {
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

					/**
					 * accessor method for the profile Users' email address
					 * return string value of profile email
					 */
					public function getProfileEmail() : string {
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
					public function setProfileEmail(string $newProfileEmail) : void {
						// verify the Users' entered last name is safe
						$newProfileEmail = trim($newProfileEmail);
						$newProfileEmail = filter_var($newProfileEmail, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
						if(empty($newProfileEmail) === true) {
							throw(new \InvalidArgumentException("sorry, Users' email is empty or insecure"));
						}

						// verify the email will fit in the database varchar128
						if(strlen($newProfileEmail) > 128) {
							throw(new \RangeException("sorry,Users' email is too large"));
						}

						// save the Users' email
						$this->profileEmail = $newProfileEmail;

						/**
						 * accessor method for the profile Users' password
						 * return string value of profile password
						 */
						public function getProfilePassword() : string {
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
						public function setProfilePassword(string $newProfilePassword) : void {
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