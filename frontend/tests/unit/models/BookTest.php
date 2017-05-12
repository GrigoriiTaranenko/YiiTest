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
use Codeception\Test\Unit;
use Codeception\Specify;


class BookTest extends Unit
{
    public function _before(){
        Book::deleteAll();
        Yii::$app->db->createCommand()->insert(Book::tableName(), [
            'name'=>'Кубок',
            'year'=>2005,
            'id_book_type'=>3
        ])->execute();
    }

    public function testValidationEmptyValues(){
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
        $model->id_book_type=123;
        expect('model is not valid', $model->validate())->false();
    }

}
