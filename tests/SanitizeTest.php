<?php
require_once 'function.php';
use PHPUnit\Framework\TestCase;

// h()とhbr()のテスト
class SanitizeTest extends TestCase
{
    // &
    public function testAmp()
    {
        // 期待する出力を宣言
        $this->expectOutputString('&amp;');

        // 呼び出し
        h('&');
    }

    // "
    public function testDoubleQuote()
    {
        // 期待する出力を宣言
        $this->expectOutputString('&quot;');

        // 呼び出し
        h('"');
    }

    // '
    public function testSingleQuote()
    {
        $this->expectOutputString('&#039;');
        h("'");
    }

    // <
    public function testLessThan()
    {
        $this->expectOutputString('&lt;');
        h('<');
    }

    // >
    public function testGreaterThan()
    {
        $this->expectOutputString('&gt;');
        h('>');
    }

    // 普通の文字列
    public function testNormal()
    {
        $this->expectOutputString("普通の文字列");
        h("普通の文字列");
    }

    // mix
    public function testMix()
    {
        $this->expectOutputString('&lt;Black &amp; White&gt;');
        h('<Black & White>');
    }

    // 改行
    public function testMultiLine()
    {
        $this->expectOutputString("abc<br />\ndef");
        hbr("abc\ndef");
    }
}

