<?php
require_once 'mypage_function.php';
use PHPUnit\Framework\TestCase;

class ValidateProfileTest extends TestCase
{
    private function emptyUser()
    {
        return ['nickname'=>'', 'introduction'=>'','image'=>'', 'birthday'=>'',
                'gender'=>'', 'team'=>''];
    }

    private function assertNoError($error)
    {
        $this->assertSame('', $error['nickname']);
        $this->assertSame('', $error['introduction']);
        $this->assertSame('', $error['image']);
        $this->assertSame('', $error['birthday']);
        $this->assertSame('', $error['gender']);
        $this->assertSame('', $error['team']);
        $this->assertEquals(6, count(array_keys($error)));
    }

    public function testBlank()
    {
        $user = $this->emptyUser();
        $error = validateNewProfile($user);

        $this->assertEquals('blank', $error['nickname']);
        $this->assertEquals('blank', $error['introduction']);
        $this->assertEquals('', $error['image']);
        $this->assertEquals('failed', $error['birthday']);
        $this->assertEquals('blank', $error['gender']);
        $this->assertEquals('blank', $error['team']);
        $this->assertEquals(6, count(array_keys($error)));
    }

    public function testYearFailed()
    {
        $user = ['year'=>'', 'month'=>'01', 'day'=>'01'];
        $error = validateNewProfile($user);

        $this->assertEquals('failed', $error['birthday']);
    }
    public function testMonthFailed()
    {
        $user = ['year'=>'2020', 'month'=>'', 'day'=>'01'];
        $error = validateNewProfile($user);

        $this->assertEquals('failed', $error['birthday']);
    }
    public function testDayFailed()
    {
        $user = ['year'=>'2020', 'month'=>'01', 'day'=>''];
        $error = validateNewProfile($user);

        $this->assertEquals('failed', $error['birthday']);
    }

    public function testBirthdayFailed()
    {
        $user = ['month'=>02, 'day'=>31, 'year'=>2020];

        //呼び出し
        $error = validateSignupUser($user);

        //結果チェック
        $this->assertEquals('failed', $error['birthday']);

    }

    public function testLength()
    {
        $user['nickname'] = str_repeat('A', 21);
        $error = validateNewProfile($user);

        $this->assertEquals('length', $error['nickname']);
    }

    public function testNoError()
    {
        $user = [
            'nickname' => 'a',
            'image' => '',
            'introduction' => 'c',
            'month'=>'01',
            'day'=>'01',
            'year'=>'2020',
            'gender' => 'd',
            'team' => 'e'
        ];

        $error = validateNewProfile($user);
        $this->assertNoError($error);

        $user['nickname'] = str_repeat('A', 20);
        $error = validateNewProfile($user);
        $this->assertNoError($error);

    }

    


}