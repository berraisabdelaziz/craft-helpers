<?php
/**
 * craft-helpers plugin for Craft CMS 3.x
 *
 * The plugin provides functions, which allow to read and convert JSON, YAML, CSV and PHP file contents. Using the readText or inline function you can read an entire file into a string.
 *
 * @link      https://github.com/berraisabdelaziz
 * @copyright Copyright (c) 2020 Shakebiz
 */

namespace berraisabdelaziz\crafthelpers\services;

use berraisabdelaziz\crafthelpers\Crafthelpers;

use Craft;
use craft\base\Component;

/**
 * HelpersMiscService Service
 *
 * All of your plugin’s business logic should go in services, including saving data,
 * retrieving data, etc. They provide APIs that your controllers, template variables,
 * and other plugins can interact with.
 *
 * https://craftcms.com/docs/plugins/services
 *
 * @author    Shakebiz
 * @package   Crafthelpers
 * @since     1.0.0
 */
class HelpersMiscService extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * Decodes a JSON string.
     *
     * @param string $value
     * @param bool $assoc
     * @param int $depth
     * @param int $options
     *
     * @return array
     */
    public function jsonDecode($value, $assoc = false, $depth = 512, $options = 0)
    {
        return json_decode(html_entity_decode($value), $assoc, $depth, $options);
    }

    /**
     * Generates a random string of a given length.
     *
     * @param int  $length
     * @param bool $extendedChars
     *
     * @return string
     */
    public function randomString($length = 36, $extendedChars = false)
    {
        return StringHelper::randomString($length, $extendedChars);
    }

    /**
     * Returns the md5 hash of a string.
     *
     * @param string $value
     *
     * @return string
     */
    public function md5($value)
    {
        return md5($value);
    }

    /**
     * Stores a notice in the user’s flash data.
     *
     * @param string $message
     *
     * @return null
     */
    public function setNotice($message)
    {
        craft()->userSession->setFlash('notice', $message);
    }

    /**
     * Stores an error message in the user’s flash data.
     *
     * @param string $message
     *
     * @return null
     */
    public function setError($message)
    {
        craft()->userSession->setFlash('error', $message);
    }
}
