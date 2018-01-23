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
	public function get
}