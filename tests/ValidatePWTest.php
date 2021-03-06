<?php
require_once 'login_function.php';
use PHPUnit\Framework\TestCase;

//passwordが空だったら'blank'が入るかどうか
//型が違ったらillegalが入るかどうか
//password_re_enterが空だったら'blank'
//2つが一致しなかったら'failed'
class ValidatePWTest extends TestCase
{
    private function emptyPW()
    {
        $user = ['password'=>'', 'password_re_enter'=>''];
    }
    
    private function assertNoError($passwordError)
    {
        $this->assertSame('', $passwordError['password']);
        $this->assertSame('', $passwordError['password_re_enter']);
        $this->assertEquals(2, count(array_keys($passwordError)));
    }

    //blankテスト
    public function testBlank()
    {
        $user = $this->emptyPW();
        $passwordError = validatePW($user);
        $this->assertEquals('blank', $passwordError['password']);
        $this->assertEquals('blank', $passwordError['password_re_enter']);
        $this->assertEquals(2, count(array_keys($passwordError)));
    }

    //illegalテスト
    public function testEnglishCalacter()
    {
        $user = 
        [
            'password'=>'あいうえおアイウエオ',
            'password_re_enter'=> 'あいうえおアイウエオ'
        ];
        $passwordError = validatePW($user);
        $this->assertEquals('illegal', $passwordError['password']);        
    }

    public function testLowerCharacter()
    {
        $user = 
        [
            'password'=>'ABCD1234',
            'password_re_enter'=> 'ABCD1234'
        ];
        $passwordError = validatePW($user);
        $this->assertEquals('illegal', $passwordError['password']);        
    }
    public function testUpperCharacter()
    {
        $user = 
        [
            'password'=>'abcd1234',
            'password_re_enter'=> 'abcd1234'
        ];

        $passwordError = validatePW($user);
        $this->assertEquals('illegal', $passwordError['password']);        
    }
    public function testNumericalCharacter()
    {
        $user = 
        [
            'password'=>'ABCDefgh',
            'password_re_enter'=> 'ABCDefgh'
        ];
        $passwordError = validatePW($user);
        $this->assertEquals('illegal', $passwordError['password']);        
    }
    public function testMinimunLength()
    {
        $user = 
        [
            'password'=>'ABcd123',
            'password_re_enter'=>'ABcd123'
        ];
        $passwordError = validatePW($user);
        $this->assertEquals('illegal', $passwordError['password']);        
    }
    public function testMaximLength()
    {
        $user = 
        [
            'password'=>str_repeat('Abc12',4 ).'A',
            'password_re_enter'=>str_repeat('Abc12',4 ).'A'
        ];
        $passwordError = validatePW($user);
        $this->assertEquals('illegal', $passwordError['password']);        
    }

    //failedテスト
    public function testFailed()
    {
        $user = 
        [
            'password'=>'ABcd1234',
            'password_re_enter'=>'abCD1234'
        ];
        $passwordError = validatePW($user);
        $this->assertNotEquals($user['password'], $user['password_re_enter']);
        $this->assertEquals('failed', $passwordError['password']);
    }

    //エラーなしのテスト
    public function testNoError()
    {
        $user = 
        [
            'password'=>'ABcd1234', 
            'password_re_enter'=>'ABcd1234'
        ];

        $passwordError = validatePW($user);
        $this->assertNoError($passwordError);

    }
}
