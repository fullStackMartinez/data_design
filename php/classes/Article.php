<?php
namespace Edu\Cnm\DataDesign;
require_once(dirname(__DIR__) . "/classes/autoloader.php");
use Ramsey\Uuid\Uuid;
/**
 * I will use a trait to validate Uuid's
 * This Uuid trait will be able to validate the following formats
 * -human readable string (36 bytes)
 * -binary string (16 bytes)
 * -Ramsey\Uuid\Uuid object
 *
 * @author Esteban Martinez <fullstackmartinez@gmail.com>
 * @author Dylan McDonald <dmcdonald12@cnm.edu
 * @package Edu\Cnm\Misquote
 *
 **/
