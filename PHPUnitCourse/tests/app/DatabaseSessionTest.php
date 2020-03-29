<?php
namespace UnitTest\Sample;
/**
 * \PHPUnit_Framework_TestCaseを継承したクラスがテストケースになる
 */
class DatabaseSessionTest extends \PHPUnit_Framework_TestCase{
    //テスト対象のオブジェクト
    private $target = null;
    //プリペアードステートメントのモック
    private $statement = null;
    // \mysqliのモック
    private $connection = null;

    /**
     * これが各テストメソッドの前に実行されるメソッドになる
     * ここで対象のクラスのnewと依存オブジェクトの用意をする
     * このテストクラスを見た人が対象クラスの使い方が分かり易くなる
     */
    public function setUp(){
        //\mysqliのモックを作っている
        $this->connection = \Phake::mock('\mysqli');

        //\mysqli_stmtのモックを作っている
        $this->statement = \Phake::mock('\mysqli_stmt');

        //対象クラスはリアルなオブジェクトです
        $this->target = new DatabaseSession($this->connection);
    }

    /**
     * testから始まるメソッド名がテストメソッド
     * assertは基本、左側がecpected(期待値)、右側がactual(実際の値)
     * assertInstanceOfは、actualがexpectedに指定した方に合っているかをテェックする
     * 合っていれば成功
     */
    
    public function testInstance(){
        $this->assertInstanceOf('\UnitTest\Sample\DatabaseSession', $this->target);
    }

    /**
     * expectedExceptionは実行したら例外が投げられるかどうかのチェックをして
     * 指定の型の例外が投げられたら成功というテストになる
     * @expectedException \InvalidArgumentException
     */
    public function testSaveTableNameNull(){
        $this->target->save(null, array('hoge' => 1));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSaveTableNameEmptyString(){
        $this->target->save('', array('hoge' => 1));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSaveTableNameArray(){
        $this->target->save(array(), array('hoge' => 1));
    }
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSaveTableNameObject(){
        $this->target->save((object)array('tableName' => 'tbl1'), array('hoge' => 1));
    }
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSaveObjectNull(){
        $this->target->save('hoge', null);
    }
     /**
     * @expectedException \InvalidArgumentException
     */
    public function testSaveObjectEmptyArray()
    {
        $this->target->save('hoge', array());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSaveObjectIsInvalidObject()
    {
        $this->target->save('hoge', new \DateTime());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSaveObjectIsScalar()
    {
        $this->target->save('hoge', 1);
    }
}