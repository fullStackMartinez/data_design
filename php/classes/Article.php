<?php

namespace Edu\Cnm\DataDesign;
require_once ("autoloader.php");
require_once(dirname(__DIR__) . "/classes/autoloader.php");
use Ramsey\Uuid\Uuid;
/**
 * Small cross section for the entity/class of the "Medium.com" Profile
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
	public function getArticleId() : Uuid {
		return($this->articleId);
	}
	/**
	 * mutator method for the private property articleId
	 *
	 * @param Uuid|string $newArticleId new value of article id
	 * @throws \RangeException if $newArticleId is not positive
	 * @throws \TypeError if $newArticleId is not a uuid or string
	 */

	public function setArticleId( $newArticleId) : void {
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
	public function getArticlePofileId() : Uuid {
		return($this->articleProfileId);
	}

	/**
	 * mutator method for the private property articleProfileId
	 *
	 * @param Uuid|string $newArticleProfileId new value of article profile id
	 * @throws \RangeException if $newArticleProfileId is not positive
	 * @throws \TypeError if $newArticleProfileId is not a uuid or string
	 */

	public function setArticleProfileId( $newArticleProfileId) : void {
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
	public function getArticleContent() : string {
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
	public function setArticleContent(string $newArticleContent) : void {
		// verify the chosen profile name is safe
		$newArticleContent = trim($newArticleContent);
		$newArticleContent = filter_var($newArticleContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newArticleContente) === true) {
			throw(new \InvalidArgumentException("sorry, article content is empty or insecure"));
		}

		// verify the content of the article will fit in the database varchar12000
		if(strlen($newArticleContent) > 12000) {
			throw(new \RangeException("sorry, the content written exceeds the limit of characters allowed"));
		}

		// save the new content
		$this->articleContent = $newArticleContent;
	}


}