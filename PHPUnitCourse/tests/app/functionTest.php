<?php
require_once('vendor/autoload.php');
require_once('PHPUnitCourse/src/app/function.php');
class FunctionsTest extends PHPUnit\Framework\TestCase {

    public function test_h(){
        $test = new functions\Functions;
        $this->assertTrue($test->h($str));
    }

    public function test_emptyError(){
        $test = new functions\Functions;
        $this->assertIsArray($test->emptyError());
    }

    public function test_hasError(){
        $test = new functions\Functions($error);
        $this->assertTrue($test->hasError($error));
    }

}