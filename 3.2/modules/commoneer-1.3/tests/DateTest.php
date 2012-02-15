<?php

class DateTest extends Kohana_Unittest_TestCase
{

	function test_mysql_date()
	{
		$this->assertNull(Date::mysql_date(''));
		$this->assertNull(Date::mysql_date(array()));
		$this->assertNull(Date::mysql_date(FALSE));

		$time = time();
		$this->assertEquals(date('Y-m-d H:i:s', $time), Date::mysql_date($time)); // Convert time() to string
		$this->assertEquals(date('Y-m-d', $time), Date::mysql_date($time, FALSE)); // Convert time() to string

		$this->assertEquals(date('Y-m-d H:i:s', $time), Date::mysql_date(date('d.m.Y H:i:s', $time))); // Estonian format input
		$this->assertEquals(date('Y-m-d', $time), Date::mysql_date(date('d.m.Y H:i:s', $time), FALSE)); // Estonian format input
	}

	function test_localized_date() {
		$this->assertNull(Date::localized_date(''));
		$this->assertNull(Date::localized_date(array()));

		$date = date('m/d/Y H:i:s');
		$local = date('d.m.Y H:i', strtotime($date));
		$local_short = date('d.m.Y H', strtotime($date));

		$this->assertEquals($local, Date::localized_date($date, TRUE));

		Date::$_format_short = 'd.m.Y H';
		$this->assertEquals($local_short, Date::localized_date($date, FALSE));
	}


	function test_date_smaller_than() {
		$this->assertFalse(Date::date_smaller_than('a', 'b'));
		$this->assertFalse(Date::date_smaller_than(date('d.m.Y'), array()));
		$this->assertFalse(Date::date_smaller_than(100, 100)); // No equality!

		$this->assertTrue(Date::date_smaller_than(45, 100));

		$d1 = date('d.m.Y H:i:s', time());
		$d2 = date('d.m.Y H:i:s', time()+10);

		$this->assertTrue(Date::date_smaller_than($d1, $d2));
		$this->assertFalse(Date::date_smaller_than($d2, $d1));
	}


	function test_realistic_date() {
		$this->assertFalse(Date::realistic_date(''));
		$this->assertTrue(Date::realistic_date(date('d.m.Y', time())));
		$this->assertFalse(Date::realistic_date(strtotime('05.02.1982')));
		$this->assertTrue(Date::realistic_date('05.02.1982', strtotime('01.01.1981')));
	}
}