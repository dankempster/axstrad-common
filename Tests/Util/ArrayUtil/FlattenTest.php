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
 * Axstrad\Common\Tests\Util\ArrayUtil\FlattenTest
 *
 * @covers Axstrad\Common\Util\ArrayUtil::flatten
 * @group unittest
 */
class FlattenTest extends \PHPUnit_Framework_TestCase
{
    /**
     */
	public function testFlattenAssociateArray()
	{
		$this->assertEquals(
			array(
				'one.two' => 'foo',
				'one.three.four' => 'bar',
				'five' => 'nah',
			),
			ArrayUtil::flatten(array(
				'one' => array(
					'two' => 'foo',
					'three' => array(
						'four' => 'bar',
					),
				),
				'five' => 'nah',
			))
		);
	}

	/**
	 */
	public function testFlattensNumericArray()
	{
		$this->assertEquals(
			array(
				'0' => 'some-string',
				'1.0' => 'foo',
				'1.1.0' => 'bar',
				'1.1.1' => 'moon',
				'2.0' => 'nah',
			),
			ArrayUtil::flatten(array(
				'some-string',
				array(
					'foo',
					array('bar','moon'),
				),
				array('nah')
			))
		);
	}

	/**
	 * Exposes bug: If the first value of a numericly index array is a
	 * multidimensioanl array, the first zero index would be dropped from the
	 * new key.
	 */
	public function testFlattensNumericArrayWithIndexZeroAsMultidimensionalArray()
	{
		$testArray = array(
			array(
				'foo',
				array('bar','moon'),
			),
			'bar',
		);

		// what should be returned from the funciton
		$this->assertEquals(
			array(
				'0.0' => 'foo',
				'0.1.0' => 'bar',
				'0.1.1' => 'moon',
				'1' => 'bar',
			),
			ArrayUtil::flatten($testArray)
		);
	}

    /**
     */
	public function testPrefixArrayKeys()
	{
		$this->assertEquals(
			array(
				'zero.one.two' => 'foo',
				'zero.one.three.four' => 'bar'
			),
			ArrayUtil::flatten(array(
				'one' => array(
					'two' => 'foo',
					'three' => array(
						'four' => 'bar',
					),
				),
			), 'zero')
		);
	}

    /**
     */
	public function testCanChangeSeperator()
	{
		$this->assertEquals(
			array(
				'one-two' => 'foo',
				'one-three-four' => 'bar'
			),
			ArrayUtil::flatten(array(
				'one' => array(
					'two' => 'foo',
					'three' => array(
						'four' => 'bar',
					),
				),
			), null, '-')
		);
	}
}
