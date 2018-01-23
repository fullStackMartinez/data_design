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
	 * accessor method for  id
	 *
	 * @return Uuid value of tweet id
	 **/
	public function getTweetId() : Uuid {
		return($this->tweetId);
	}
}