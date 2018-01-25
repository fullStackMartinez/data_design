<?php

namespace Edu\Cnm\DataDesign;
require_once("autoloader.php");
require_once(dirname(__DIR__) . "/classes/autoloader.php");

use Ramsey\Uuid\Uuid;

/**
 * Small cross section for the entity/class of the "Medium.com" Article
 *
 * This class, which is named Article, can be explained as the template each user, reader and author can expect to fill out in order to write/read articles on the Medium.com platform.
 *
 * @author Esteban Martinez <fullstackmartinez@gmail.com>
 * @author Dylan McDonald <dmcdonald12@cnm.edu
 * @package Edu\Cnm\Misquote
 *
 **/
class Article implements \JsonSerializable {
	use ValidateDate;
	use ValidateUuid;
	/**
	 * id for this Article; this is the primary key
	 * @var Uuid $articleId
	 **/
	private $articleId;
	/**
	 * id of the Profile that wrote or read this article; this is a foreign key
	 * @var Uuid $articleProfileId
	 **/
	private $articleProfileId;
	/**
	 * actual textual content of the article
	 * @var string $articleContent
	 **/
	private $articleContent;
	/**
	 * date and time this article was published, in a PHP DateTime object
	 * @var \DateTime $articleDateTime
	 **/
	private $articleDateTime;
	/**
	 * title of the article
	 * @var string $articleTitle
	 **/
	private $articleTitle;

	/**
	 * accessor method for article id
	 *
	 * @return Uuid value of article id
	 **/
	public function getArticleId(): Uuid {
		return ($this->articleId);
	}

	/**
	 * constructor for the Article class
	 *
	 * @param string|Uuid $newArticleId the id for the specific article written
	 * @param string|Uuid $newArticleProfileId id of the Profile that wrote this specific article
	 * @param string $newArticleContent written string of the article content
	 * @param \DateTime|string|null $newArticleDateTime date and time the article was written
	 * @param string $newArticleTitle string title of the article
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values don't fit within their limits
	 * @throws \TypeError if data types violate type
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct($newArticleId, $newArticleProfileId, string $newArticleContent, \DateTime$newArticleDateTime = null, string $newArticleTitle) {
		try {
			$this->setArticleId($newArticleId);
			$this->setArticleProfileId($newArticleProfileId);
			$this->setArticleContent($newArticleContent);
			$this->setArticleDateTime($newArticleDateTime);
			$this->setArticleTitle($newArticleTitle);
		}
			//determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * mutator method for the private property articleId
	 *
	 * @param Uuid|string $newArticleId new value of article id
	 * @throws \RangeException if $newArticleId is not positive
	 * @throws \TypeError if $newArticleId is not a uuid or string
	 */

	public function setArticleId($newArticleId): void {
		try {
			$uuid = self::validateUuid($newArticleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the article id
		$this->articleId = $uuid;
	}

	/**
	 * accessor method for article profile id, the profile responsible for writing the article
	 *
	 * @return Uuid value of articleProfileid
	 **/
	public function getArticlePofileId(): Uuid {
		return ($this->articleProfileId);
	}

	/**
	 * mutator method for the private property articleProfileId
	 *
	 * @param Uuid|string $newArticleProfileId new value of article profile id
	 * @throws \RangeException if $newArticleProfileId is not positive
	 * @throws \TypeError if $newArticleProfileId is not a uuid or string
	 */

	public function setArticleProfileId($newArticleProfileId): void {
		try {
			$uuid = self::validateUuid($newArticleProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// convert and store the article profile id
		$this->articleProfileId = $uuid;
	}

	/**
	 * accessor method for the content of the article
	 * return string value of content in article
	 */
	public function getArticleContent(): string {
		return ($this->articleContent);
	}

	/**
	 * mutator method for article content varchar 12000
	 *
	 * @param string $newArticleContent new value of article content
	 * @throws \InvalidArgumentException if $newArticleContent is not a string or insecure
	 * @throws \RangeException if $newArticleContent is > 12000 characters
	 * @throws \TypeError if $newArticleContent is not a string
	 */
	public function setArticleContent(string $newArticleContent): void {
		// verify the chosen profile name is safe
		$newArticleContent = trim($newArticleContent);
		$newArticleContent = filter_var($newArticleContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newArticleContent) === true) {
			throw(new \InvalidArgumentException("sorry, article content is empty or insecure"));
		}

		// verify the content of the article will fit in the database varchar12000
		if(strlen($newArticleContent) > 12000) {
			throw(new \RangeException("sorry, the content written exceeds the limit of characters allowed"));
		}

		// save the new content
		$this->articleContent = $newArticleContent;
	}

	/**
	 * accessor method for article date and time
	 *
	 * @return \DateTime value of article date and time
	 **/
	public function getArticleDateTime(): \DateTime {
		return ($this->articleDateTime);
	}

	/**
	 * mutator method for article DateTime
	 *
	 * @param \DateTime|string|null $newArticleDateTime article date as a DateTime object or string (or null to load the current time)
	 * @throws \InvalidArgumentException if $newArticleDateTime is not a valid object or string
	 * @throws \RangeException if $newArticleDateTime is a date that does not exist
	 *
	 **/
	public function setArticleDateTime($newArticleDateTime = null): void {
		// base case: if the date is null, use the current date and time
		if($newArticleDateTime === null) {
			$this->articleDateTime = new \DateTime();
			return;
		}

		// store the like date using the ValidateDate trait
		try {
			$newArticleDateTime = self::validateDateTime($newArticleDateTime);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->articleDateTime = $newArticleDateTime;
	}

	/**
	 * accessor method for the title of the article
	 * return string value of title in article
	 */
	public function getArticleTitle(): string {
		return ($this->articleTitle);
	}

	/**
	 * mutator method for article title varchar 255
	 *
	 * @param string $newArticleTitle new value of article title
	 * @throws \InvalidArgumentException if $newArticleTitle is not a string or insecure
	 * @throws \RangeException if $newArticleTitle is > 255 characters
	 * @throws \TypeError if $newArticleTitle is not a string
	 */
	public function setArticleTitle(string $newArticleTitle): void {
		// verify the chosen profile title is safe
		$newArticleTitle = trim($newArticleTitle);
		$newArticleTitle = filter_var($newArticleTitle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newArticleTitle) === true) {
			throw(new \InvalidArgumentException("sorry, article title is empty or insecure"));
		}

		// verify the title of the article will fit in the database varchar 255
		if(strlen($newArticleTitle) > 255) {
			throw(new \RangeException("sorry, the title written exceeds the limit of characters allowed"));
		}

		// save the new title
		$this->articleTitle = $newArticleTitle;
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize(): array {
		$fields = get_object_vars($this);

		$fields["profileId"] = $this->articleId->toString();
		$fields["articleProfileId"] = $this->articleProfileId->toString();

		//format the date so that the front end can consume it
		$fields["articleDateTime"] = round(floatval($this->articleDateTime->format("U.u")) * 1000);
		return ($fields);
	}
}