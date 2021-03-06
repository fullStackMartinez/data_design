<?php

namespace Edu\Cnm\DataDesign;

require_once("autoloader.php");
require_once(dirname(__DIR__, 2) . "classes/autoloader.php");

use Ramsey\Uuid\Uuid;
/**
 * Small cross section for the entity/class of claps given and received within Medium.com
 *
 * This class, which is named Clap, is a template that must be followed when saving data on claps, whether it be the profile making the clap, or the article receiving a clap, on the Medium.com platform.
 *
 * @author Esteban Martinez <fullstackmartinez@gmail.com>
 * @author Dylan McDonald <dmcdonald12@cnm.edu
 * @package Edu\Cnm\Misquote
 *
 **/
class Clap implements \JsonSerializable{
	use ValidateUuid;
	use ValidateDate;
	/**
	 * id for clap; this is the primary key
	 * @var Uuid $clapId
	 **/
	private $clapId;
	/**
	 * id of the Profile that initiated this clap; this is a foreign key
	 * @var Uuid $clapProfileId
	 **/
	private $clapProfileId;
	/**
	 * id of the article that contains the clap; this is a foreign key
	 * @var Uuid $clapArticleId
	 */
	private $clapArticleId;
	/**
	 * the time the clap was made, this is a dateTime data type
	 * @var \DateTime $clapDate
	 */
	private $clapDate;

	/**
	 * constructor for the clap class
	 *
	 * @param string|Uuid $newClapId id of a specific clap
	 * @param string|Uuid $newClapProfileId id of the profile that made the clap
	 * @param string|Uuid $newClapArticleId id of the article that received the clap
	 * @param \DateTime|null $newClapDate date the clap was made
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are not within the limits
	 * @throws \TypeError if data types violate data types
	 * @throws \Exception if some other exception is thrown
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 */
	public function __construct( $newClapId, $newClapProfileId, $newClapArticleId, $newClapDate = null) {
		try {
			$this->setClapId($newClapId);
			$this->setClapProfileId($newClapProfileId);
			$this->setClapArticleId($newClapArticleId);
			$this->setClapDate($newClapDate);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			// determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for clap id
	 *
	 * @return Uuid value of clap id
	 **/
	public function getClapId(): Uuid {
		return ($this->clapId);
	}
	/**
	 * mutator method for the private property clapId
	 *
	 * @param Uuid|string $newClapId new value of clap id
	 * @throws \RangeException if $newClapId is not positive
	 * @throws \TypeError if $newClapId is not a uuid or string
	 */

	public function setClapId($newClapId): void {
		try {
			$uuid = self::validateUuid($newClapId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the clap id
		$this->clapId = $uuid;
	}
	/**
	 * accessor method for clap profile id
	 *
	 * @return Uuid value of clap profile id
	 */
	public function getClapProfileId() : Uuid{
		return ($this->clapProfileId);
	}
	/**
	 * mutator method for the private property clap profile id
	 *
	 * @param Uuid|string $newClapProfileId new value of clap profile id
	 * @throws \RangeException if $newClapProfileId is not positive
	 * @throws \TypeError if $newClapProfileId is not a uuid or string
	 */
	public function setClapProfileId($newClapProfileId): void {
		try {
			$uuid = self::validateUuid($newClapProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the clap profile id
		$this->clapProfileId = $uuid;
	}
	/**
	 * accessor method for clap article id
	 *
	 * @return Uuid value of clap article id
	 */
	public function getClapArticleId() : Uuid {
		return ($this->clapArticleId);
	}
	/**
	 * mutator method for the private property clap article id
	 *
	 * @param Uuid|string $newClapArticleId new value of clap article id
	 * @throws \RangeException if $newClapArticleId is not positive
	 * @throws \TypeError if $newClapArticleId is not a uuid or string
	 */
	public function setClapArticleId($newClapArticleId): void {
		try {
			$uuid = self::validateUuid($newClapArticleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the clap article id
		$this->clapArticleId = $uuid;
	}
	/**
	 * accessor method for clap date and time
	 *
	 * @return \DateTime value of clap date
	 **/
	public function getClapDate(): \DateTime {
		return ($this->clapDate);
	}

	/**
	 * mutator method for clap DateTime
	 *
	 * @param \DateTime|string|null $newClapDate clap date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newClapDate is not a valid object or string
	 * @throws \RangeException if $newClapDate is a date that does not exist
	 *
	 **/
	public function setClapDate($newClapDate = null): void {
		// base case: if the date is null, use the current date and time
		if($newClapDate === null) {
			$this->clapDate = new \DateTime();
			return;
		}

		// store the like date using the ValidateDate trait
		try {
			$newClapDate = self::validateDateTime($newClapDate);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->clapDate = $newClapDate;
	}
	/**
	 * inserts this clap into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 **/
	public function insert(\PDO $pdo) : void {
		// create query template
		$query = "INSERT INTO clap(clapId, clapProfileId, clapArticleId, clapDate) VALUES(:clapId, :clapProfileId, :clapArticleId, :clapDate)";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holders in the template
		$formattedDate = $this->clapDate->format("Y-m-d H:i:s.u");
		$parameters = ["clapId" => $this->clapId->getBytes(), "clapProfileId" => $this->clapProfileId->getBytes(), "clapArticleId" => $this->clapArticleId->getBytes(), "clapDate" => $formattedDate];
		$statement->execute($parameters);
	}
	/**
	 * deletes clap from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 **/
	public function delete(\PDO $pdo) : void {
		// create query template
		$query = "DELETE FROM clap WHERE clapId = :clapId AND clapProfileId = :clapProfileId AND clapArticleId = :clapArticleId";
		$statement = $pdo->prepare($query);
		//bind the member variables to the placeholders in the template
		$parameters = ["clapId" => $this->clapId->getBytes(), "clapProfileId" => $this->clapProfileId->getBytes(), "clapArticleId" => $this->clapArticleId->getBytes()];
		$statement->execute($parameters);
	}
	/**
	 * gets the clap by clap id, the profile id that gave the clap, and the article id that contains the clap
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $clapProfileId profile id that gave the clap
	 * @param string $clapId actual clap id to put into our search
	 * @param string $clapArticleId article that contains the clap we are searching for
	 * @return clap|null clap found or null if not found
	 */
	public static function getClapByClapIdAndClapProfileIdAndClapArticleId(\PDO $pdo, string $clapProfileId, string $clapId, string $clapArticleId) : ?Clap {
		//
		try {
			$clapProfileId = self::validateUuid($clapProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		try {
			$clapId = self::validateUuid($clapId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		try{
		$clapArticleId = self::validateUuid($clapArticleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
}
		// create query template
		$query = "SELECT clapProfileId, clapId, clapArticleId, clapDate FROM clap WHERE clapProfileId = :clapProfileId AND clapId = :clapId AND $clapArticleId = :$clapArticleId";
		$statement = $pdo->prepare($query);
		// bind the clap profile id, clap id and article id to the place holder in the template
		$parameters = ["clapProfileId" => $clapProfileId->getBytes(), "clapId" => $clapId->getBytes(), "clapArticleId" => $clapArticleId->getBytes()];
		$statement->execute($parameters);
		// search for and retrieve clap from mySQL
		try {
			$clap = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$clap = new Clap($row["clapProfileId"], $row["clapId"], $row["clapArticleId"], $row["clapDate"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($clap);
	}
	/**
	 * gets the clap by the profile id that made the clap
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $clapProfileId profile id of the clap maker
	 * @return \SplFixedArray SplFixedArray of claps found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 **/
	public static function getClapByClapProfileId(\PDO $pdo, string $clapProfileId) : \SPLFixedArray {
		try {
			$clapProfileId = self::validateUuid($clapProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		// create query template
		$query = "SELECT clapProfileId, clapId, clapArticleId, clapDate FROM clap WHERE clapProfileId = :clapProfileId";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holders in the template
		$parameters = ["clapProfileId" => $clapProfileId->getBytes()];
		$statement->execute($parameters);
		// build an array of claps
		$claps = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$clap = new Clap($row["clapProfileId"], $row["clapId"], $row["clapArticleId"], $row["clapDate"]);
				$claps[$claps->key()] = $clap;
				$claps->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($claps);
	}
	/**
	 * gets the clap by clap id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $clapId clap id
	 * @return \SplFixedArray array of Likes found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 **/
	public static function getClapByClapId(\PDO $pdo, string $clapId) : \SplFixedArray {
		try {
			$clapId = self::validateUuid($clapId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		// create query template
		$query = "SELECT clapProfileId, clapId, clapArticleId, clapDate FROM clap WHERE clapId = :clapId";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holders in the template
		$parameters = ["clapId" => $clapId->getBytes()];
		$statement->execute($parameters);
		// build the array of claps
		$claps = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$clap = new Clap($row["clapProfileId"], $row["clapId"], $row["clapArticleId"], $row["clapDate"]);
				$claps[$claps->key()] = $clap;
				$claps->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($claps);
	}
	/**
	 * gets the clap by the id of the article that contains the clap
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $clapArticleId article id
	 * @return \SplFixedArray array of Likes found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 **/
	public static function getClapByClapArticleId(\PDO $pdo, string $clapArticleId) : \SplFixedArray {
		try {
			$clapArticleId = self::validateUuid($clapArticleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		// create query template
		$query = "SELECT clapProfileId, clapId, clapArticleId, clapDate FROM clap WHERE clapArticleId = :clapArticleId";
		$statement = $pdo->prepare($query);
		// bind the member variables to the place holders in the template
		$parameters = ["clapArticleId" => $clapArticleId->getBytes()];
		$statement->execute($parameters);
		// build the array of likes
		$claps = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$clap = new Clap($row["clapProfileId"], $row["clapId"], $row["clapArticleId"], $row["clapDate"]);
				$claps[$claps->key()] = $clap;
				$claps->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($claps);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize(): array {
		$fields = get_object_vars($this);

		$fields["clapId"] = $this->clapId->toString();
		$fields["clapProfileId"] = $this->clapProfileId->toString();
		$fields["clapArticleId"] = $this->clapArticleId->toString();

		//format the date so that the front end can consume it
		$fields["clapDate"] = round(floatval($this->clapDate->format("U.u")) * 1000);
		return ($fields);
	}

}