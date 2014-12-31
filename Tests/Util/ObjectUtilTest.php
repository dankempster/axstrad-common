<?php
namespace Axstrad\Common\Tests\Util;

use Axstrad\Common\Util\ObjectUtil;
use stdClass;

/**
 * Axstrad\Common\Tests\Util\ObjectUtilTest
 */
class ObjectUtilTest extends \PHPUnit_Framework_TestCase
{
    public function testToArrayConvertsObjectToArray()
    {
        $obj = new stdClass;
        $obj->foo = 'bar';
        $obj->hello = 'world';


        $this->assertEquals(
            array(
                'foo' => 'bar',
                'hello' => 'world',
            ),
            ObjectUtil::toArray($obj)
        );
    }

    /**
     * @depends testToArrayConvertsObjectToArray
     */
    public function testToArrayConvertsObjectToArrayRecessively()
    {
        $obj = new stdClass;
        $obj->character = 'Iron Man';
        $obj->identity = new stdClass;
        $obj->identity->firstName = 'Tony';
        $obj->identity->lastName = 'Stark';
        $obj->films = array(
            'Iron Man', 'Iron Man 2', 'Avengers', 'Iron Man 3'
        );

        $this->assertEquals(
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
            ObjectUtil::toArray($obj)
        );
    }

    /**
     * @depends testToArrayConvertsObjectToArray
     */
    public function testToArrayConvertsArrayOfObjectsToArray()
    {
        $obj1 = new stdClass;
        $obj1->foo = 'bar';
        $obj1->hello = 'world';

        $obj2 = new stdClass;
        $obj2->foo = 'baz';

        $this->assertEquals(
            array(
                array(
                    'foo' => 'bar',
                    'hello' => 'world',
                ),
                array(
                    'foo' => 'baz',
                ),
            ),
            ObjectUtil::toArray(array($obj1, $obj2))
        );
    }

    /**
     * @depends testToArrayConvertsObjectToArrayRecessively
     * @depends testToArrayConvertsArrayOfObjectsToArray
     */
    public function testToArrayConvertsArrayOfObjectToArrayRecessively()
    {
        $obj1 = new stdClass;
        $obj1->character = 'Iron Man';
        $obj1->identity = new stdClass;
        $obj1->identity->firstName = 'Tony';
        $obj1->identity->lastName = 'Stark';
        $obj1->films = array(
            'Iron Man', 'Iron Man 2', 'Avengers', 'Iron Man 3'
        );

        $obj2 = new stdClass;
        $obj2->character = 'Captain America';
        $obj2->identity = new stdClass;
        $obj2->identity->firstName = 'Steve';
        $obj2->identity->lastName = 'Rogers';
        $obj2->films = array(
            'Captain America: The First Avenger',
            'Avengers',
            'Captain America 2: The Winter Solder'
        );

        $this->assertEquals(
            array(
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
            ),
            ObjectUtil::toArray(array($obj1, $obj2))
        );
    }
}
