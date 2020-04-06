<?php
require_once 'function.php';
use PHPUnit\Framework\TestCase;

// validatePbook()のテスト
class ValidatePbookTest extends TestCase
{
    // 空っぽのpbookエンティティを返す、ヘルパーメソッド
    private function emptyPbook() {
        return [
            'user_id'=>'',
            'sp_name'=>'',
            'team'=>'',
            'picture'=>'',
            'description'=>'',
        ];
    }

    // バリデーションエラーがないことを確認する、ヘルパーメソッド
    private function assertNoError($error) {
        $this->assertSame('', $error['sp_name']);
        $this->assertSame('', $error['team']);
        $this->assertSame('', $error['picture']);
        $this->assertSame('', $error['description']);
        $this->assertEquals(4, count(array_keys($error)));
    }

    // Blankエラーのテスト
    public function testBlank()
    {
        // データを準備
        $pbook = $this->emptyPbook();

        // 呼び出し
        $error = validatePbook($pbook);

        // 結果チェック
        $this->assertEquals('blank', $error['sp_name']);
        $this->assertEquals('blank', $error['team']);
        $this->assertEquals('blank', $error['picture']);
        $this->assertEquals('blank', $error['description']);
        $this->assertEquals(4, count(array_keys($error)));
    }

    // Lengthエラーのテスト
    public function testLength()
    {
        // データを準備
        $pbook = $this->emptyPbook();
        $pbook['sp_name'] = str_repeat('A', 51);

        // 呼び出し
        $error = validatePbook($pbook);

        // 結果チェック
        $this->assertEquals('length', $error['sp_name']);
    }

    // 写真ファイル拡張子エラーのテスト
    public function testFileType()
    {
        $pbook = $this->emptyPbook();

        $pbook['picture'] = 'pic.bmp';
        $error = validatePbook($pbook);
        $this->assertEquals('type', $error['picture']);

        $pbook['picture'] = 'pic.jpeg';
        $error = validatePbook($pbook);
        $this->assertEquals('type', $error['picture']);

        $pbook['picture'] = 'pic.gif';
        $error = validatePbook($pbook);
        $this->assertEquals('type', $error['picture']);
    }

    // エラーなしのテスト
    public function testNoError()
    {
        $pbook = [
            'user_id'=>'a',
            'sp_name'=>'b',
            'team'=>'c',
            'picture'=>'d.jpg',
            'description'=>'e',
        ];

        $error = validatePbook($pbook);
        $this->assertNoError($error);

        $pbook['sp_name'] = str_repeat('A', 50);
        $error = validatePbook($pbook);
        $this->assertNoError($error);

        $pbook['picture'] = 'd.JPG';
        $error = validatePbook($pbook);
        $this->assertNoError($error);

        $pbook['picture'] = 'd.png';
        $error = validatePbook($pbook);
        $this->assertNoError($error);
    }
}

