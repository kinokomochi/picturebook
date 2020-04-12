<?php
require_once 'login_function.php';
use PHPUnit\Framework\TestCase;

//validateSignupUser()のテスト
class ValidateSignupUserTest extends TestCase
{
    //空っぽのuserエンティティを返す、ヘルパーメソッド
    private function emptySignupUser(){
        return[
            'name' => '',
            'image' => '',
            'introduction' => '',
            'birthday'=>'',
            'gender' => '',
            'team' => ''
        ];
    }

    //バリデーションエラーがないことを確認する、ヘルパーメソッド
    private function assertNoError($error){
        $this->assertSame('', $error['name']);
        $this->assertSame('', $error['image']);
        $this->assertSame('', $error['introduction']);
        $this->assertSame('', $error['birthday']);
        $this->assertSame('', $error['gender']);
        $this->assertSame('', $error['team']);
        $this->assertEquals(6, count(array_keys($error)));
    }

    //blankエラーテスト
    public function testBlank()
    {
        //データを準備
        $user = $this->emptySignupUser();

        //呼び出し
        $error = validateSignupUser($user);

        //結果チェック
        $this->assertEquals('blank', $error['name']);
        $this->assertEquals('blank', $error['image']);
        $this->assertEquals('blank', $error['introduction']);
        $this->assertEquals('failed', $error['birthday']);
        $this->assertEquals('blank', $error['gender']);
        $this->assertEquals('blank', $error['team']);
        $this->assertEquals(6, count(array_keys($error)));
    }

    //Lengthエラーのテスト
    public function testLength()
    {
        //データ準備
        $user = $this->emptySignupUser();
        $user['name'] = str_repeat('A', 21);

        //呼び出し
        $error = validateSignupUser($user);

        //結果チェック
        $this->assertEquals('length',$error['name']);
    }

    public function testFailed()
    {
        //データ準備
        $user = ['month'=>00, 'day'=>00, 'year'=>0000];

        //呼び出し
        $error = validateSignupUser($user);

        //結果チェック
        $this->assertEquals('failed', $error['birthday']);
    }

    public function testFileType()
    {
        //データ準備
        $user = $this->emptySignupUser();

        $user['image'] = 'img.bmp';
        $error = validateSignupUser($user);
        $this->assertEquals('type', $error['image']);

        $user['image'] = 'img.gif';
        $error = validateSignupUser($user);
        $this->assertEquals('type', $error['image']);

        $user['image'] = 'img.txt';
        $error = validateSignupUser($user);
        $this->assertEquals('type', $error['image']);
    }

    //エラーなしのテスト
    public function testNoError()
    {
        $user = [
            'name' => 'a',
            'image' => 'b.jpg',
            'introduction' => 'c',
            'month'=>'01',
            'day'=>'01',
            'year'=>'2020',
            'gender' => 'd',
            'team' => 'e'
        ];

        $error = validateSignupUser($user);
        $this->assertNoError($error);

        $user['name'] = str_repeat('A', 20);
        $error = validateSignupUser($user);
        $this->assertNoError($error);

        $user['image'] = 'b.jpg';
        $error = validateSignupUser($user);
        $this->assertNoError($error);

        $user['image'] = 'b.PNG';
        $error = validateSignupUser($user);
        $this->assertNoError($error);

    }


}