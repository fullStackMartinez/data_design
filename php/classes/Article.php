<?php

namespace Edu\Cnm\DataDesign;

require_once("autoloader.php");
require_once(dirname(__DIR__, 2) . "classes/autoloader.php");

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

		// store the article date using the ValidateDate trait
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
	 * inserts Tweet into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {

		// create query template
		$query = "INSERT INTO article(articleId, articleProfileId, articleContent, articleTitle, articleDateTime) VALUES(:articleId, :articleProfileId, :articleContent, :articleTitle, :articleDateTime)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template
		$formattedDate = $this->articleDateTime->format("Y-m-d H:i:s.u");
		$parameters = ["articleId" => $this->articleId->getBytes(), "articleProfileId" => $this->articleProfileId->getBytes(), "articleContent" => $this->articleContent, "articleTitle" => $this->articleTitle, "articleDateTime" => $formattedDate];
		$statement->execute($parameters);
	}
	/**
	 * deletes article from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {

		// create query template
		$query = "DELETE FROM article WHERE articleId = :articleId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["articleId" => $this->articleId->getBytes()];
		$statement->execute($parameters);
	}
	/**
	 * updates article in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		// create query template
		$query = "UPDATE article SET articleProfileId = :articleProfileId, articleContent = :articleContent, articleTitle = :articleTitle, articleDateTime = :articleDateTime WHERE articleId = :articleId";
		$statement = $pdo->prepare($query);


		$formattedDate = $this->articleDateTime->format("Y-m-d H:i:s.u");
		$parameters = ["articleId" => $this->articleId->getBytes(),"articleProfileId" => $this->articleProfileId->getBytes(), "articleContent" => $this->articleContent, "articleTitle" => $this->articleTitle, "articleDateTime" => $formattedDate];
		$statement->execute($parameters);
	}
	/**
	 * gets the article by articleId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $articleId  the id we will use to search for this specific article
	 * @return Article|null if article found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getArticleByArticleId(\PDO $pdo, $articleId) : ?Article {
		// sanitize the articleId before searching
		try {
			$articleId = self::validateUuid($articleId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT articleId, articleProfileId, articleContent, articleTitle, articleDateTime FROM article WHERE articleId = :articleId";
		$statement = $pdo->prepare($query);

		// bind the article id to the place holder in the template
		$parameters = ["articleId" => $articleId->getBytes()];
		$statement->execute($parameters);

		// grab the article from mySQL
		try {
			$article = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$article = new Article($row["articleId"], $row["articleProfileId"], $row["articleContent"], $row["articleTitle"], $row["articleDateTime"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($article);
	}
	/**
	 * gets the article by the id of the profile user
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $articleProfileId profile id to search by
	 * @return \SplFixedArray SplFixedArray of Article found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getArticleByArticleProfileId(\PDO $pdo, $articleProfileId) : \SplFixedArray {

		try {
			$articleProfileId = self::validateUuid($articleProfileId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT articleId, articleProfileId, articleContent, articleTitle, articleDateTime FROM article WHERE articleProfileId = :articleProfileId";
		$statement = $pdo->prepare($query);
		// bind the article profile id to the place holder in the template
		$parameters = ["articleProfileId" => $articleProfileId->getBytes()];
		$statement->execute($parameters);
		// build an array of articles
		$articles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$article = new Article($row["articleId"], $row["articleProfileId"], $row["articleContent"], $row["articleTitle"], $row["articleDateTime"]);
				$articles[$articles->key()] = $article;
				$articles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($articles);
	}
	/**
	 * gets the article by content
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $articleContent article content that we will search for
	 * @return \SplFixedArray SplFixedArray of Articles found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getArticleByArticleContent(\PDO $pdo, string $articleContent) : \SplFixedArray {
		// sanitize the article content before searching
		$articleContent = trim($articleContent);
		$articleContent = filter_var($articleContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($articleContent) === true) {
			throw(new \PDOException("sorry, article content is invalid or unsafe"));
		}

		// escape any mySQL wild cards
		$articleContent = str_replace("_", "\\_", str_replace("%", "\\%", $articleContent));

		// create query template
		$query = "SELECT articleId, articleProfileId, articleContent, articleTitle, articleDateTime FROM article WHERE articleContent LIKE :articleContent";
		$statement = $pdo->prepare($query);

		// bind the article content to the place holder in the template
		$articleContent = "%$articleContent%";
		$parameters = ["articleContent" => $articleContent];
		$statement->execute($parameters);

		// build an array of articles
		$articles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$article = new Article($row["articleId"], $row["articleProfileId"], $row["articleContent"], $row["articleTitle"], $row["articleDateTime"]);
				$articles[$articles->key()] = $article;
				$articles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($articles);
	}
	/**
	 * gets the article by title
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $articleTitle article title that we will search for
	 * @return \SplFixedArray SplFixedArray of Articles found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getArticleByArticleTitle(\PDO $pdo, string $articleTitle) : \SplFixedArray {
		// sanitize the article title before searching
		$articleTitle = trim($articleTitle);
		$articleTitle = filter_var($articleTitle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($articleTitle) === true) {
			throw(new \PDOException("sorry, article title is invalid or unsafe"));
		}

		// escape any mySQL wild cards
		$articleTitle = str_replace("_", "\\_", str_replace("%", "\\%", $articleTitle));

		// create query template
		$query = "SELECT articleId, articleProfileId, articleContent, articleTitle, articleDateTime FROM article WHERE articleTitle LIKE :articleTitle";
		$statement = $pdo->prepare($query);

		// bind the article title to the place holder in the template
		$articleTitle = "%$articleTitle%";
		$parameters = ["articleTitle" => $articleTitle];
		$statement->execute($parameters);

		// build an array of articles
		$articles = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$article = new Article($row["articleId"], $row["articleProfileId"], $row["articleContent"], $row["articleTitle"], $row["articleDateTime"]);
				$articles[$articles->key()] = $article;
				$articles->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($articles);
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