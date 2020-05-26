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
use League\Csv\Reader;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

/**
 * HelpersFileService Service
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
class HelpersFileService extends Component
{
    // Public Methods
    // =========================================================================

    /**
     * This function can literally be anything you want, and you can have as many service
     * functions as you want
     *
     * From any other plugin file, call it like this:
     *
     *     Crafthelpers::$plugin->helpersFileService->exampleService()
     *
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';

        return $result;
    }

    /**
     * Reads a JSON file, parses and converts its contents.
     *
     * @param string $path
     *
     * @return mixed|null
     */
    public function readJson($path)
    {
        $filePath = $this->getFilePath($path);
        $file = @file_get_contents($filePath);

        if ($file === false) {
            Craft::info('Couldn’t read file: '.$filePath,  __METHOD__);
            return null;
        }

        $data = @json_decode($file, true);

        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            Craft::info('Couldn’t read file: '.$filePath.'. '.json_last_error_msg(),  __METHOD__);
            return null;
        }

        return $data;
    }

    /**
     * Reads a YAML file, parses and converts its contents.
     *
     * @param string $path
     *
     * @return mixed|null
     */
    public function readYaml($path)
    {
        $filePath = $this->getFilePath($path);
        $file = @file_get_contents($filePath);

        if ($file === false) {
            Craft::info('Couldn’t read file: '.$filePath,  __METHOD__);
            return null;
        }

        try {
            $data = Yaml::parse($file);
        } catch (ParseException $e) {
            Craft::info('Couldn’t read file: '.$filePath.'. '.$e->getMessage(),  __METHOD__);
            return null;
        }

        return $data;
    }

    /**
     * Reads a CSV file, parses and converts its contents.
     *
     * @param string $path
     * @param bool $associative
     *
     * @return array|null
     */
    public function readCsv($path, $associative = true)
    {
        if (!ini_get('auto_detect_line_endings')) {
            @ini_set('auto_detect_line_endings', true);
        }

        $filePath = $this->getFilePath($path);

        try {
            $reader = Reader::createFromPath($filePath);

            $delimiters = $reader->fetchDelimitersOccurrence([',', ';', '|'], 10);
            $reader->setDelimiter(array_keys($delimiters)[0]);

            if ($associative) {
                $results = $reader->fetchAssoc(0, function($row) {
                    return array_map('trim', $row);
                });

                $data = iterator_to_array($results);
            } else {
                $data = $reader->fetchAll();
            }

        } catch (\Exception $e) {
            Craft::info('Couldn’t read file: '.$filePath.'. '.$e->getMessage(),  __METHOD__);
            return null;
        }

        return $data;
    }

    /**
     * Executes a PHP file’s return statement and returns the value.
     *
     * @param string $path
     *
     * @return mixed|null
     */
    public function readPhp($path)
    {
        $filePath = $this->getFilePath($path);
        $file = @include $filePath;

        if ($file === false) {
            Craft::info('Couldn’t read file: '.$filePath,  __METHOD__);
            return null;
        }

        if ($file === 1) {
            Craft::info('Return statement missing in PHP file: '.$filePath,  __METHOD__);
            return null;
        }

        return $file;
    }

    /**
     * Reads a file’s contents into a string.
     *
     * @param string $path
     *
     * @return string|null
     */
    public function readText($path)
    {
        $filePath = $this->getFilePath($path);
        $file = @file_get_contents($filePath);

        if ($file === false) {
            Craft::info('Couldn’t read file: '.$filePath,  __METHOD__);
            return null;
        }

        return $file;
    }

    // Protected Methods
    // =========================================================================

    /**
     * Resolves relative paths corresponding to the configuration.
     *
     * @param string $path
     *
     * @return string
     */
    protected function getFilePath($path)
    {
        if ($this->isAbsolutePath($path)) {
            return $path;
        }

        $basePath = craft()->config->get('basePath', 'helpers');

        return rtrim($basePath, '/').'/'.$path;
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    protected function isAbsolutePath($path)
    {
        return strspn($path, '/\\', 0, 1)
            || (strlen($path) > 3 && ctype_alpha($path[0])
                && substr($path, 1, 1) === ':'
                && strspn($path, '/\\', 2, 1))
            || null !== parse_url($path, PHP_URL_SCHEME);
    }
}
