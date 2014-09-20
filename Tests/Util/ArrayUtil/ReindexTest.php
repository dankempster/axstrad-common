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
 * Axstrad\Common\Tests\Util\ArrayUtil\ReindexTest
 *
 * @covers Axstrad\Common\Util\ArrayUtil::reindex
 * @group unittest
 */
class ReindexTest extends \PHPUnit_Framework_TestCase
{
    /**
     */
	public function testReindexArray()
	{
		$this->assertEquals(
			array(
				0 => 'one',
				1 => 'two',
				2 => 'three',
			),
			ArrayUtil::reindex(array(
				1 => 'one',
				3 => 'two',
				10 => 'three'
			))
		);
	}

    /**
     */
	public function testCanSpecifyIndexToStartFrom()
	{
		$this->assertEquals(
			array(
				10 => 'one',
				11 => 'two',
				12 => 'three',
			),
			ArrayUtil::reindex(array(
				1 => 'one',
				3 => 'two',
				10 => 'three'
			), 10)
		);
	}
}
