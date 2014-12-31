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
 * @subpackage Tests
 */

namespace Axstrad\Common\Tests\Util\ArrayUtil;

use Axstrad\Common\Util\ArrayUtil;
use stdClass;

/**
 * Axstrad\Common\Tests\Util\ArrayUtil\ToObjectTests
 */
class ToObjectTests extends \PHPUnit_Framework_TestCase
{
    public function testToObjectConvertsArrayToObject()
    {
        $obj = new stdClass;
        $obj->foo = 'bar';
        $obj->hello = 'world';


        $this->assertEquals(
            $obj,
            ArrayUtil::toObject(array(
                'foo' => 'bar',
                'hello' => 'world',
            ))
        );
    }

    /**
     * @depends testToObjectConvertsArrayToObject
     */
    public function testToObjectConvertsArrayToObjectRecessively()
    {
        $obj = new stdClass;
        $obj->character = 'Iron Man';
        $obj->identity = new stdClass;
        $obj->identity->firstName = 'Tony';
        $obj->identity->lastName = 'Stark';
        $obj->films = (object) array(
            'Iron Man', 'Iron Man 2', 'Avengers', 'Iron Man 3'
        );

        $this->assertEquals(
            $obj,
            ArrayUtil::toObject(array(
                'character' => 'Iron Man',
                'identity' => array(
                    'firstName' => 'Tony',
                    'lastName' => 'Stark',
                ),
                'films' => array(
                    'Iron Man', 'Iron Man 2', 'Avengers', 'Iron Man 3'
                )
            ))
        );
    }

    /**
     * @depends testToObjectConvertsArrayToObject
     */
    public function testToObjectConvertsArrayOfArraysToArrayOfObjects()
    {
        $obj1 = new stdClass;
        $obj1->foo = 'bar';
        $obj1->hello = 'world';

        $obj2 = new stdClass;
        $obj2->foo = 'baz';

        $this->assertEquals(
            (object) array($obj1, $obj2),
            ArrayUtil::toObject(array(
                array(
                    'foo' => 'bar',
                    'hello' => 'world',
                ),
                array(
                    'foo' => 'baz',
                ),
            ))
        );
    }

    /**
     * @depends testToObjectConvertsArrayToObjectRecessively
     * @depends testToObjectConvertsArrayOfArraysToArrayOfObjects
     */
    public function testToObjectConvertsArrayOfArraysToArrayOfObjectsRecessively()
    {
        $obj1 = new stdClass;
        $obj1->character = 'Iron Man';
        $obj1->identity = new stdClass;
        $obj1->identity->firstName = 'Tony';
        $obj1->identity->lastName = 'Stark';
        $obj1->films = (object) array(
            'Iron Man', 'Iron Man 2', 'Avengers', 'Iron Man 3'
        );

        $obj2 = new stdClass;
        $obj2->character = 'Captain America';
        $obj2->identity = new stdClass;
        $obj2->identity->firstName = 'Steve';
        $obj2->identity->lastName = 'Rogers';
        $obj2->films = (object) array(
            'Captain America: The First Avenger',
            'Avengers',
            'Captain America 2: The Winter Solder'
        );

        $this->assertEquals(
            (object) array($obj1, $obj2),
            ArrayUtil::toObject(array(
                array(
                    'character' => 'Iron Man',
                    'identity' => array(
                        'firstName' => 'Tony',
                        'lastName' => 'Stark',
                    ),
                    'films' => array(
                        'Iron Man', 'Iron Man 2', 'Avengers', 'Iron Man 3'
                    )
                ),
                array(
                    'character' => 'Captain America',
                    'identity' => array(
                        'firstName' => 'Steve',
                        'lastName' => 'Rogers',
                    ),
                    'films' => array(
                        'Captain America: The First Avenger',
                        'Avengers',
                        'Captain America 2: The Winter Solder'
                    )
                ),
            ))
        );
    }
}
