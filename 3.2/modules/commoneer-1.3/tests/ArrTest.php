<?php

class ArrTest extends Kohana_Unittest_TestCase
{
    function test_check_keys()
    {

        $input = array('r' => 2, 'n' => 6);

        // Empty expected
        $this->assertTrue(Arr::check_keys($input, array()));
        $this->assertTrue(Arr::check_keys($input, array(), TRUE));

        // Test return false
        $this->assertFalse(Arr::check_keys($input, array('sd')));
        $this->assertFalse(Arr::check_keys($input, array('n', 'r', 't')));


        $this->assertTrue(Arr::check_keys($input, array('n')));
        $this->assertTrue(Arr::check_keys($input, array('n', 'r')));

        // Fill key
        $this->assertFalse(array_key_exists('h', $input));
        $this->assertTrue(Arr::check_keys($input, array('n', 'r', 'h'), TRUE));
        $this->assertTrue(array_key_exists('h', $input));
        $this->assertEquals(3, count($input));


    }
}