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
 * Axstrad\Common\Util\ObjectUtil
 */
class ObjectUtil
{
    /**
     * [toArray description]
     * @param  [type] $d [description]
     * @return [type]    [description]
     */
    public static function toArray($arg)
    {
        if (is_object($arg)) {
            $arg = get_object_vars($arg);
        }

        if (is_array($arg)) {
            return array_map(__METHOD__, $arg);
        }
        else {
            return $arg;
        }
    }
}
