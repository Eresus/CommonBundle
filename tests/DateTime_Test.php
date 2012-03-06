<?php
require_once __DIR__ . '/bootstrap.php';
require_once SRC_ROOT . '/DateTime.php';

use
	Eresus\CommonBundle\DateTime;

class DateTime_Test extends PHPUnit_Framework_TestCase
{
	/**
	 * @covers \Eresus\CommonBundle\DateTime::__construct
	 */
	public function test_construct()
	{
		$test = new DateTime();
		$this->assertTrue(
			$test->format('H') != 0 || $test->format('i') != 0 || $test->format('s') != 0
		);
		$test = new DateTime('today');
		$this->assertTrue(
			$test->format('H') == 0 && $test->format('i') == 0 && $test->format('s') == 0
		);
	}
	//-----------------------------------------------------------------------------

	/**
	 * @covers \Eresus\CommonBundle\DateTime::copyFrom
	 */
	public function test_copyFrom()
	{
		$test1 = new DateTime('2000-01-01');
		$test2 = new DateTime();

		$this->assertNotEquals($test1->getTimestamp(), $test2->getTimestamp());
		$test2->copyFrom($test1);
		$this->assertEquals($test1->getTimestamp(), $test2->getTimestamp());
	}
	//-----------------------------------------------------------------------------

	/**
	 * @covers \Eresus\CommonBundle\DateTime::offsetExists
	 */
	public function test_offsetExists()
	{
		$test = new DateTime();
		$this->assertTrue(isset($test['timestamp']));
		$this->assertFalse(isset($test['foo']));
	}
	//-----------------------------------------------------------------------------

	/**
	 * @covers \Eresus\CommonBundle\DateTime::offsetGet
	 */
	public function test_offsetGet()
	{
		$test = new DateTime();
		$this->assertEquals($test->getTimestamp(), $test['timestamp']);

		$test = new DateTime('2000-01-01');
		$this->assertEquals('01.01.00', $test['date']);
	}
	//-----------------------------------------------------------------------------

	/**
	 * @covers \Eresus\CommonBundle\DateTime::offsetGet
	 * @expectedException LogicException
	 */
	public function test_offsetGet_unknown()
	{
		$test = new DateTime();
		$x = $test['foo'];
	}
	//-----------------------------------------------------------------------------

	/**
	 * @covers \Eresus\CommonBundle\DateTime::offsetSet
	 * @expectedException LogicException
	 */
	public function test_offsetSet()
	{
		$test = new DateTime();
		$test['foo'] = 'bar';
	}
	//-----------------------------------------------------------------------------

	/**
	 * @covers \Eresus\CommonBundle\DateTime::offsetUnset
	 * @expectedException LogicException
	 */
	public function test_offsetUnset()
	{
		$test = new DateTime();
		unset($test['foo']);
	}
	//-----------------------------------------------------------------------------

	/* */
}