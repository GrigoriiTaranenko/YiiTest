<?php
/**
 * Created by PhpStorm.
 * User: grigo
 * Date: 10.05.17
 * Time: 17:26
 */

namespace frontend\tests\unit\models;

use frontend\models\Book;
use frontend\models\BookSearch;
use Codeception\Test\Unit;
use Yii;
use common\fixtures\BookFixtures;
use common\fixtures\BookTypeFixture;


class BookSearchTest extends Unit
{
    use \Codeception\Specify;

    protected $dataProvider;
    protected $bookSearch;
    protected $searchModel;
    protected $book;
    protected $tester;
    function _before(){
        $this->tester->haveFixtures([
                'bookFixture' => [
                    'class' => BookFixtures::className(),
                    'dataFile' => codecept_data_dir() . 'book.php'
                ],
                'bookType'=>[
                    'class' => BookTypeFixture::className(),
                    'dataFile'=>codecept_data_dir().'booktype.php'
                ]
            ]
        );
        $this->book=Book::find();
        $this->searchModel = new BookSearch();

    }
    function testSort(){
        $this->specify("Empty Values", function (){
            $this->bookSearch=$this->searchModel->search([
                'r'=>['book/search']
            ]);
            $query=$this->bookSearch->query;
            $this->assertEquals($query->asArray()->all(), [
                0=>[
                    'id' => 1,
                    'name' => 'Шустер',
                    'year'=> 2015,
                    'id_book_type'=>3,
                    'idBookType'=>[
                        'id'=>3,
                        'type'=>'Аграном'
                    ]
                ],
                1=>[
                    'id'=>2,
                    'name'=>'Игры престолов',
                    'year'=>2012,
                    'id_book_type'=>2,
                    'idBookType'=>[
                        'id'=>2,
                        'type'=>'Фантастика'
                    ]
                ],
            ]);
        });
        $this->specify('filter arguments', function(){
            $this->bookSearch=$this->searchModel->search([
                'r'=>['book/search'],
                'BookSearch'=>[
                    'name'=>['Шуст'],
                    'year'=>'',
                    'type'=>'0'
                ]
            ]);
            $query=$this->bookSearch->query;
            $this->assertEquals($query->asArray()->all(),[
                0=>[
                    'id' => 1,
                    'name' => 'Шустер',
                    'year'=> 2015,
                    'id_book_type'=>3,
                    'idBookType'=>[
                        'id'=>3,
                        'type'=>'Аграном'
                    ]
                ],
            ]);
        });
    }
}
/*‌array (
    0 =>
  array (
      'id' => 17,
      'name' => 'Шустер',
      'year' => 1995,
      'id_book_type' => 2,
      'idBookType' =>
          array (
              'id' => 2,
              'type' => 'Фантастика',
          ),
  ),
)*/