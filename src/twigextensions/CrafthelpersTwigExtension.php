<?php
/**
 * craft-helpers plugin for Craft CMS 3.x
 *
 * The plugin provides functions, which allow to read and convert JSON, YAML, CSV and PHP file contents. Using the readText or inline function you can read an entire file into a string.
 *
 * @link      https://github.com/berraisabdelaziz
 * @copyright Copyright (c) 2020 Shakebiz
 */

namespace berraisabdelaziz\crafthelpers\twigextensions;

use berraisabdelaziz\crafthelpers\Crafthelpers;

use Craft;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators,
 * global variables, and functions. You can even extend the parser itself with
 * node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 *
 * @author    Shakebiz
 * @package   Crafthelpers
 * @since     1.0.0
 */
class CrafthelpersTwigExtension extends AbstractExtension
{
    // Public Methods
    // =========================================================================

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'Crafthelpers';
    }

    /**
     * Returns an array of Twig filters, used in Twig templates via:
     *
     *      {{ 'something' | someFilter }}
     *
     * @return array
     */
    public function getFilters()
    {
        return [
            new Twig_SimpleFilter('truncate', [craft()->helpers_string, 'truncate'], ['is_safe' => ['html']]),
            new Twig_SimpleFilter('truncateHtml', [craft()->helpers_string, 'truncateHtml'], ['is_safe' => ['html']]),
            new Twig_SimpleFilter('highlight', [craft()->helpers_string, 'highlight'], ['is_safe' => ['html']]),
            new Twig_SimpleFilter('sentenceList', [craft()->helpers_string, 'sentenceList'], ['is_safe' => ['html']]),
            new Twig_SimpleFilter('titleize', [craft()->helpers_string, 'titleize'], ['is_safe' => ['html']]),
            new Twig_SimpleFilter('collapseWhitespace', [craft()->helpers_string, 'collapseWhitespace'], ['is_safe' => ['html']]),
            new Twig_SimpleFilter('stripWords', [craft()->helpers_string, 'stripWords'], ['is_safe' => ['html']]),
            new Twig_SimpleFilter('stripPunctuation', [craft()->helpers_string, 'stripPunctuation'], ['is_safe' => ['html']]),
            new Twig_SimpleFilter('htmlEntityDecode', [craft()->helpers_string, 'htmlEntityDecode'], ['is_safe' => ['html']]),

            new Twig_SimpleFilter('numbersToWords', [craft()->helpers_number, 'numbersToWords']),
            new Twig_SimpleFilter('currencyToWords', [craft()->helpers_number, 'currencyToWords']),

            new Twig_SimpleFilter('numeralSystem', [craft()->helpers_number, 'numeralSystem']),
            new Twig_SimpleFilter('unitPrefix', [craft()->helpers_number, 'unitPrefix']),
            new Twig_SimpleFilter('fractionToFloat', [craft()->helpers_number, 'fractionToFloat']),
            new Twig_SimpleFilter('floatToFraction', [craft()->helpers_number, 'floatToFraction']),

            new Twig_SimpleFilter('jsonDecode', [craft()->helpers_misc, 'jsonDecode']),
            new Twig_SimpleFilter('json_decode', [craft()->helpers_misc, 'jsonDecode']),
            new Twig_SimpleFilter('md5', [craft()->helpers_misc, 'md5']),
        ];
    }

    /**
     * Returns an array of Twig functions, used in Twig templates via:
     *
     *      {% set this = someFunction('something') %}
     *
    * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('readJson', [craft()->helpers_file, 'readJson']),
            new Twig_SimpleFunction('readYaml', [craft()->helpers_file, 'readYaml']),
            new Twig_SimpleFunction('readCsv', [craft()->helpers_file, 'readCsv']),
            new Twig_SimpleFunction('readPhp', [craft()->helpers_file, 'readPhp']),
            new Twig_SimpleFunction('readText', [craft()->helpers_file, 'readText'], ['is_safe' => ['all']]),
            new Twig_SimpleFunction('inline', [craft()->helpers_file, 'readText'], ['is_safe' => ['all']]),

            new Twig_SimpleFunction('randomString', [craft()->helpers_misc, 'randomString']),

            new Twig_SimpleFunction('setNotice', [craft()->helpers_misc, 'setNotice']),
            new Twig_SimpleFunction('setError', [craft()->helpers_misc, 'setError']),
        ];
    }

    /**
     * Our function called via Twig; it can do anything you want
     *
     * @param null $text
     *
     * @return string
     */
    public function someInternalFunction($text = null)
    {
        $result = $text . " in the way";

        return $result;
    }
}
