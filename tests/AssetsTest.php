<?php 

class AssetsTest extends Kohana_Unittest_TestCase
{
    function test_null_values()
    {
        $this->assertEmpty(Assets::render(), 'Rendering nothing should be empty');
        Assets::use_style(NULL);
        $this->assertEmpty(Assets::render(), 'Rendering nothing should be empty');
        Assets::use_script(NULL);
        $this->assertEmpty(Assets::render(), 'Rendering nothing should be empty');

        Assets::use_script(array());
        $this->assertEmpty(Assets::render(), 'Rendering nothing should be empty');
    }

    function test_clearing() {
        Assets::use_script('tablesorter');

        $this->assertContains('assets/js/libs/tablesorter-1.min.js', Assets::render(), 'Using JS aliases doesn\'t work');
        $this->assertEmpty(Assets::render(), 'Clearing after rendering doesn\'t work');
    }


    function test_duplicates() {
        Assets::use_script('tablesorter');
        Assets::use_script('tablesorter');

        $this->assertEquals(1, count(Assets::render()),'Duplicates are included');
    }
}