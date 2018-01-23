<?php

namespace Edu\Cnm\DataDesign;
require_once("autoloader.php");
require_once(dirname(__DIR__) . "/classes/autoloader.php");

use Ramsey\Uuid\Uuid;
/**
 * Small cross section for the entity/class of the "Medium.com" Profile
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
			$newArticleDateTime = self::validateDateTime($newClapDate);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->clapDate = $newClapDate;
	}

}