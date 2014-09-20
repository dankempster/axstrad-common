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
 * Axstrad\Common\Tests\Util\ArrayUtil\GetValueTest
 *
 * @covers Axstrad\Common\Util\ArrayUtil::getValue
 * @group unittest
 * @uses Axstrad\Common\Util\ArrayUtil
 */
class GetValueTest extends \PHPUnit_Framework_TestCase
{
	/**
	 */
	public function testReturnsValueFromKey()
	{
		$key = 'foo';
		$array = array($key => 'bar');
		$this->assertEquals(
			$array[$key],
			ArrayUtil::getValue($key, $array)
		);
	}

	/**
	 * @depends Axstrad\Common\Tests\Util\ArrayUtil\DecompilePathTest::testCanParseDotNotation
	 */
	public function testReturnsValueByPath()
	{
		$array = array('one' => array('two'=>'three'));
		$this->assertEquals(
			'three',
			ArrayUtil::getValue('one.two', $array)
		);
	}

	/**
	 */
	public function testReturnsNullWhenKeyDoesntExist()
	{
		$this->assertNull(
			ArrayUtil::getValue('one', array('foo'=>'bar'))
		);
	}

	/**
	 */
	public function testReturnsDefaultValueWhenKeyDoesntExist()
	{
		$this->assertFalse(
			ArrayUtil::getValue('one', array('foo'=>'bar'), false)
		);
	}
}
