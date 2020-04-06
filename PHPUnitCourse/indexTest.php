<?php
require_once('vendor/autoload.php');
require_once('PHPUnitCourse/src/app/index.php');
class LoginBoolTest extends PHPUnit\Framework\TestCase {
    public function test_login(){
        $test = new index\LoginBool();
        $this->assertIsBool($test->login());
    }
}