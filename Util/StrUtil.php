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
 * @subpackage Utillities
 */
namespace Axstrad\Common\Util;


/**
 * Axstrad\Common\Util\StrUtil
 */
class StrUtil
{
    /**
     * Wraps $needle in $wrapEle HTML tags if found in $haystack.
     *
     * @param string $haystack
     * @param string $needle
     * @param string $wrapEle
     * @param boolean $wrapHaystackOnFailure
     * @return string
     */
    public static function wrapSubstr(
        $haystack,
        $needle,
        $wrapEle = null,
        $wrapHaystackOnFailure = false
    ) {
        empty($wrapEle) && $wrapEle = "span";

        if (stripos($haystack, $needle) === false &&
            strtolower(substr($needle, -1)) == 's'
        ) {
            $needle = substr($needle, 0, -1);
        }


        if (stripos($haystack, $needle) !== false) {
            $replace = '<'.$wrapEle.'>$0</'.$wrapEle.'>';

            $return = preg_replace('/'.$needle.'/i', $replace, $haystack);
        }

        if (empty($return)) {
            $return = $haystack;

            if ($wrapHaystackOnFailure) {
                $return = sprintf('<%1$s>%2$s</%1$s>', $wrapEle, $haystack);
            }
        }

        return $return;
    }
}
