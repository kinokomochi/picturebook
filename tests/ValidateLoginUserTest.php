<?php
require_once 'login_function.php';
use PHPUnit\Framework\TestCase;

//$userの値に空欄がある場合、$errorに'blank'が入るかどうかテストする
class ValidateLoginUserTest extends TestCase
{
    //空の$userエンティティを返すヘルパーメソッド
    private function emptyUser()
    {
        return ['email'=>'', 'password'=>''];
    }

    //バリデーションエラーがないことを確認する、ヘルパーメソッド
    private function assertNoError($error)
    {
        $this->assertSame('', $error['email']);
        $this->assertSame('', $error['password']);
        $this->assertEquals(2, count(array_keys($error)));
    }


//blankエラーテスト
    public function testBlank()
    {
    //データを準備
    $user = $this->emptyUser();
    //呼び出し
    $error = validateLoginUser($user);
    //結果チェック
    $this->assertEquals('blank', $error['email']);
    $this->assertEquals('blank', $error['password']);
    $this->assertEquals(2, count(array_keys($error)));
    }


//エラーなしのテスト
    public function testNoError()
    {
        $user = 
        [
            'email'=>'abcd@email.com',
            'password'=>'ABcd1234'
        ];

        $error = validateLoginUser($user);
        $this->assertNoError($error);

    }
}