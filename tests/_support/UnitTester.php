<?php
/**
 * craft-helpers plugin for Craft CMS 3.x
 *
 * The plugin provides functions, which allow to read and convert JSON, YAML, CSV and PHP file contents. Using the readText or inline function you can read an entire file into a string.
 *
 * @link      https://github.com/berraisabdelaziz
 * @copyright Copyright (c) 2020 Shakebiz
 */

use Codeception\Actor;
use Codeception\Lib\Friend;

/**
 * Inherited Methods
 *
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method Friend haveFriend($name, $actorClass = null)
 *
 * @SuppressWarnings(PHPMD)
 *
 */
class UnitTester extends Actor
{
    use _generated\UnitTesterActions;

}
