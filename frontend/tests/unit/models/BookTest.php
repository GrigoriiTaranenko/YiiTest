<?php
/**
 * Created by PhpStorm.
 * User: grigo
 * Date: 12.05.17
 * Time: 10:55
 */

namespace frontend\tests\unit\models;
use Yii;
use frontend\models\Book;
use common\fixtures\BookFixtures;
use \Codeception\Test\Unit;

class BookTest extends Unit
{

    use \Codeception\Specify;

    private $book;
    protected $tester;

    public function _before(){
        $this->book = new Book();
             Yii::$app->db->createCommand()->insert(Book::tableName(), [
                 'name'=>'Кубок Шустера',
                 'year'=>2005,
                 'id_book_type'=>2
             ])->execute();
        $this->tester->haveFixtures([
            'bookFixture' => [
                'class' => BookFixtures::className(),
                'dataFile' => codecept_data_dir() . 'book.php'
            ]]
        );
    }

   /* public function testValidationEmptyValues(){
        $model=new Book();
        expect('model is not valid', $model->validate())->false();
        expect('name has error', $model->getErrors())->hasKey('name');
        expect('year has error', $model->getErrors())->hasKey('year');
        expect('book type has error', $model->getErrors())->hasKey('id_book_type');
    }
    public function testValidationWrongValues(){
        $model=new Book();
        $model->name='Wrong';
        $model->year='qw1233';
        $model->id_book_type='weqeqw41';
        expect('model is not valid', $model->validate())->false();
        expect('id_book_type is valid', $model->getErrors())->hasKey('id_book_type');
    }*/
    public function testValidation()
    {
        $this->specify("Empty Values", function() {
            $this->book->name = null;
            $this->assertFalse($this->book->validate());
            expect('name has error', $this->book->getErrors())->hasKey('name');
            expect('year has error', $this->book->getErrors())->hasKey('year');
            expect('book type has error', $this->book->getErrors())->hasKey('id_book_type');
        });

        $this->specify("Wrong Values", function() {
            $this->book->name = '';
            $this->book->year='241fwfas';
            $this->book->id_book_type='123asw';
            $this->assertFalse($this->book->validate());
            expect('name has error', $this->book->getErrors())->hasKey('name');
            expect('year has error', $this->book->getErrors())->hasKey('year');
            expect('book type has error', $this->book->getErrors())->hasKey('id_book_type');
        });

        $this->specify("is ok", function() {
            $this->book->name = 'davert';
            $this->book->year=23;
            $this->book->id_book_type=2;
            $this->assertTrue($this->book->validate());
        });
    }
    public function testSaveDB()
    {
            $this->specify("Wrong Values", function() {
                $this->book->name = 'Grigo';
                $this->book->year = 12;
                $this->book->id_book_type = 3;
                $this->book->validate();
                //$this->tester->SeeInDatabase('book', ['id' => 17]);
               // $this->tester->haveRecord('frontend\models\Book' ,array('name' => 'Davert', 'year'=>23, 'id_book_type'=>4));
                //$this->tester->DontSeeRecord('frontend\models\Book', array('name'=>'Davrt'));
                //$this->tester->SeeRecord('frontend\models\Book', array('id'=>17));
                $this->tester->SeeRecord('frontend\models\Book',array('year'=>2012));
            });
        //       $book = Book::findOne(1);
        // $this->assertEquals($book->id, 1, 'Hello');
    }
}
