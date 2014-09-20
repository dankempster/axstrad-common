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
 * Axstrad\Common\Tests\Util\ArrayUtil\RaiseTest
 *
 * @covers Axstrad\Common\Util\ArrayUtil::raise
 * @group unittest
 * @uses Axstrad\Common\Util\ArrayUtil
 */
class RaiseTest extends \PHPUnit_Framework_TestCase
{
    /**
     */
	public function testRaisesArray()
	{
		$this->assertEquals(
			array(
				'one' => array(
					'two' => 'foo',
					'three' => array(
						'four' => 'bar',
					),
				),
			),
			ArrayUtil::raise(array(
				'one.two' => 'foo',
				'one.three.four' => 'bar'
			))
		);
	}
}
