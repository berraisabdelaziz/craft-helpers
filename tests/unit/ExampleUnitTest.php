<?php
/**
 * craft-helpers plugin for Craft CMS 3.x
 *
 * The plugin provides functions, which allow to read and convert JSON, YAML, CSV and PHP file contents. Using the readText or inline function you can read an entire file into a string.
 *
 * @link      https://github.com/berraisabdelaziz
 * @copyright Copyright (c) 2020 Shakebiz
 */

namespace berraisabdelaziz\crafthelperstests\unit;

use Codeception\Test\Unit;
use UnitTester;
use Craft;
use berraisabdelaziz\crafthelpers\Crafthelpers;

/**
 * ExampleUnitTest
 *
 *
 * @author    Shakebiz
 * @package   Crafthelpers
 * @since     1.0.0
 */
class ExampleUnitTest extends Unit
{
    // Properties
    // =========================================================================

    /**
     * @var UnitTester
     */
    protected $tester;

    // Public methods
    // =========================================================================

    // Tests
    // =========================================================================

    /**
     *
     */
    public function testPluginInstance()
    {
        $this->assertInstanceOf(
            Crafthelpers::class,
            Crafthelpers::$plugin
        );
    }

    /**
     *
     */
    public function testCraftEdition()
    {
        Craft::$app->setEdition(Craft::Pro);

        $this->assertSame(
            Craft::Pro,
            Craft::$app->getEdition()
        );
    }
}
