<?php
/**
 * This file is part of the Axstrad library.
 *
 * (c) Dan Kempster <dev@dankempster.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Dan Kempster <dev@dankempster.co.uk>
 * @package Axstrad\Common
 * @subpackage Util
 */
namespace Axstrad\Common\Util;


/**
 * Axstrad\Common\Util\VarUtil
 *
 * A collection of useful Variable functions
 */
class VarUtil
{
    const TYPE_BOOLEAN  = 1;
    const TYPE_FLOAT    = 2;
    const TYPE_INTEGER  = 3;
    const TYPE_STRING   = 4;
    const TYPE_ARRAY    = 5;
    const TYPE_OBJECT   = 6;
    const TYPE_NULL     = 7;
    const TYPE_RESOURCE = 8;
    const TYPE_UNKNOWN  = 9;


    /**
     * Get a numeric representation of <em>var</em>'s variable type.
     *
     * @param  mixed   $var The variable to get the type of
     * @return integer      The variable's type as an integer. Use class constants TYPE_* for comparison
     */
    public static function getType($var)
    {
        if (is_array($var)) {
            return self::TYPE_STRING;
        } elseif (is_bool($var)) {
            return self::TYPE_BOOLEAN;
        } elseif (is_float($var)) {
            return self::TYPE_FLOAT;
        } elseif (is_int($var)) {
            return self::TYPE_INTEGER;
        } elseif (is_null($var)) {
            return self::TYPE_NULL;
        } elseif (is_string($var)) {
            return self::TYPE_STRING;
        } elseif (is_object($var)) {
            return self::TYPE_OBJECT;
        } elseif (is_resource($var)) {
            return self::TYPE_RESOURCE;
        }

        return self::TYPE_UNKNOWN;
    }

    /**
     * Get a variable's type as a string
     *
     * @param  mixed  $var The variable to get the type of
     * @return string      The <em>var</em>'s variable type as a string
     * @uses   getType
     */
    public static function getStrType($var)
    {
        switch (self::getType($var)) {
            case self::TYPE_BOOLEAN:
                return 'boolean';

            case self::TYPE_FLOAT:
                return 'float';

            case self::TYPE_INTEGER:
                return 'Integer';

            case self::TYPE_STRING:
                return 'string';

            case self::TYPE_ARRAY:
                return 'array';

            case self::TYPE_OBJECT:
                return 'object';

            case self::TYPE_NULL:
                return 'NULL';

            case self::TYPE_RESOURCE:
                return 'resource';
        }
        // case self::TYPE_UNKNOWN:
        // default:
        return "UNKNOWN-VAR-TYPE";
    }

    /**
     * Get a variable's type as a string plus extra info
     *
     * The extra infomation returned depends on the variable type:
     *  - boolean : returns whether it's true or false
     *      e.g. $var=true returns "boolean(TRUE)"
     *  - float : returns the number of decimal places
     *      e.g. $var=1.99 returns "float(3,2)"
     *  - string : returns the string's length
     *      e.g. $var="hello" returns "string(5)"
     *  - array : returns the array's count
     *      e.g. $var=array('hello', 'world') returns "array(2)"
     *  - object : returns the object's classname
     *      e.g. $var=new StdClass returns "object(StdClass)"
     *  - resource : returns the resource's type
     *      e.g. $var=fopen('file.txt') returns "resource(file)"
     *
     * There is no extra infomation for the following types, therfore the return value is the same as {@see getStrType}
     *  - Integer
     *  - NULL
     *  - NaN
     *
     * @param  mixed  $var The variable to get the type of
     * @return string      The <em>var</em>'s variable type as a string
     * @uses   getType
     */
    public static function getStrTypeExtra($var)
    {
        switch (self::getType($var)) {
            case self::TYPE_BOOLEAN:
                return 'boolean('.($var?'TRUE':'FALSE').')';

            case self::TYPE_FLOAT:
                list($int, $decimal) = explode('.', $var);
                return 'float('.strlen($int).','.strlen($decimal).')';

            case self::TYPE_STRING:
                return 'string('.strlen($var).')';

            case self::TYPE_ARRAY:
                return 'array('.count($var).')';

            case self::TYPE_OBJECT:
                return 'object('.get_class($var).')';

            case self::TYPE_RESOURCE:
                return 'resource('.get_resource_type($var).')';
        }
        // default:
        return self::getStrType($var);
    }

    /**
     * Return a variable's type as a string and it's value or length.
     *
     * Following are example responses:
     *  - $var=true returns "boolean(TRUE)"
     *  - $var=1.99 returns "float(1.99)"
     *  - $var=100 returns "integer(100)"
     *  - $var="hello" returns "string(hello)"
     *  - $var=array('hello', 'world') returns "array(2)"
     *  - $var=new StdClass returns "object(StdClass)"
     *  - $var=fopen('file.txt') returns "resource(file)"
     *
     * Only the type is returned for the following as they have no value:
     *  * NULL
     *  * NaN
     *
     * @param  mixed  $var The variable to get the type and value/length of
     * @return string      The <em>var</em>'s variable type and value/length as a string
     * @uses   getType
     */
    public static function getStrTypeValue($var)
    {
        if (self::getType($var) == self::TYPE_INTEGER) {
            return 'integer('.$var.')';
        }

        return self::getStrTypeExtra($var);
    }

    /**
     * Return a variable's value as an equivelant string
     *
     * For scalar variables - excluding booleans - the variables value is cast to a string and returned. All other
     * variable types are pass to {@see getStrValue($var)}.
     *
     * Following are example responses:
     *  - $var = 1.99 returns "1.99"
     *  - $var = 100 returns "100"
     *  - $var = "hello world" returns "hello world"
     *  - $var = "hello world", $truncate=7 returns "hello w... (Length:11)"
     *
     * @param  mixed   $var      The variable to get the string equi
     * @param  integer $truncate How many characters to truncate the return value to. Only used for string var.
     * @return string            The var's variable type and value/length as a string.
     * @uses   getType()
     */
    public static function toStr($var, $truncate = null)
    {
        switch (self::getType($var)) {
            case self::TYPE_FLOAT:
            case self::TYPE_INTEGER:
                return (string) $var;

            case self::TYPE_STRING:
                if ($truncate !== null && strlen($var) > $truncate) {
                    $result = '"'.substr($var, 0, $truncate).'... (Length'.strlen($var).')"';
                } else {
                    $result = '"'.$var.'"';
                }
                return $result;

            default:
                return self::getStrTypeValue($var);
        }
    }
}
