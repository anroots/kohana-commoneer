<?php

class InputTest extends Kohana_Unittest_TestCase
{

	function test_mysql_float()
	{
		// Test some invalid inputs
		$this->assertEquals(0.0, Input::mysql_float()); // Empty input
		$this->assertEquals(0.0, Input::mysql_float(FALSE));
		$this->assertEquals(0.0, Input::mysql_float(''));
		$this->assertEquals(0.0, Input::mysql_float(array()));

		// Do not round
		$this->assertEquals(-10.333333333, Input::mysql_float(-10.333333333)); // Negative value, must not get rounded
		$this->assertEquals(4.241, Input::mysql_float('4,241'));
		$this->assertEquals(-94.47, Input::mysql_float('-94,47'));

		// Test rounding
		$this->assertEquals(-94.47, Input::mysql_float('-94,4733', 2));
		$this->assertEquals(-94.473, Input::mysql_float('-94,4733', 3));
		$this->assertEquals(-94.0, Input::mysql_float('-94,4733', 0));
	}

	function test_null_or_value()
	{
		$this->assertNull(Input::null_or_value(''));
		$this->assertNull(Input::null_or_value(array()));
		$this->assertNull(Input::null_or_value(FALSE));

		$this->assertEquals(0, Input::null_or_value(0));
		$this->assertEquals('0', Input::null_or_value('0'));
		$this->assertEquals('Test123', Input::null_or_value('Test123'));
	}
}