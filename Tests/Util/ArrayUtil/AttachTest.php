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


/**
 * Axstrad\Common\Tests\Util\ArrayUtil\AttachTest
 *
 * @covers Axstrad\Common\Util\ArrayUtil::attach
 * @group unittest
 * @uses Axstrad\Common\Util\ArrayUtil
 */
class AttachTest extends \PHPUnit_Framework_TestCase
{
    /**
     */
	public function testCreatesArray()
	{
		$this->assertEquals(
			array(
				'foo' => 'bar',
			),
			ArrayUtil::attach('foo', 'bar')
		);
	}

    /**
     * @depends Axstrad\Common\Tests\Util\ArrayUtil\DecompilePathTest::testCanParseDotNotation
     */
	public function testCreatesMultidimensionalArray()
	{
		$this->assertEquals(
			array(
				'hello' => array(
					'world' => 'Hello World',
				),
			),
			ArrayUtil::attach('hello.world', 'Hello World')
		);
	}

	/**
	 */
	public function testCanAttachToExistingArray()
	{
		$this->assertEquals(
			array('one' => 'two', 'hello' => 'world'),
			ArrayUtil::attach('hello', 'world', array('one'=>'two'))
		);
	}

	/**
     * @depends Axstrad\Common\Tests\Util\ArrayUtil\DecompilePathTest::testCanParseDotNotation
	 */
	public function testCanAttachToExistingMultidimensionalArray()
	{
		$this->assertEquals(
			array(
				'one' => array(
					'two' => 'three',
					'hello' => 'world',
				),
			),
			ArrayUtil::attach('one.hello', 'world', array('one'=>array('two'=>'three')))
		);
	}
}
