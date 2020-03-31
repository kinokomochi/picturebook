<?php
require_once('vendor/autoload.php');
require_once('PHPUnitCourse/src/app/PictureBook.php');
class PictureBookTest extends PHPUnit\Framework\TestCase {
    public function test_add() {
        $sample = new PictureBook\PictureBook();
        $this->assertEquals(10, $sample->Add(4, 6));
    }

    public function test_sub() {
        $sample = new PictureBook\PictureBook();
        $this->assertEquals(1, $sample->Sub(7, 6));
    }
}
