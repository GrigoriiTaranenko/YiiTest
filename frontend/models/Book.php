<?php
/**
 * Created by PhpStorm.
 * User: grigo
 * Date: 05.05.17
 * Time: 15:35
 */

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use GuzzleHttp\Client; // подключаем Guzzle
use GuzzleHttp\RequestOptions;
use yii\helpers\Url;
use yii\helpers\Json;
use frontend\assets\AppAsset;


/**
 * This is the model class for table "book".
 *
 * @property integer $id
 * @property string $name
 * @property string $isbn
 * @property integer $year
 * @property integer $id_book_type
 *
 * @property BookType $idBookType
 */
class Book extends ActiveRecord
{

    private $client;
    public static function tableName()
    {
        return 'book';
    }

    public function rules()
    {
        return [
            [['name', 'year', 'id_book_type'], 'required'],
            [['year', 'id_book_type'], 'integer'],
            [['name', 'isbn'], 'string', 'max' => 150],
            [['id_book_type'], 'exist', 'skipOnError' => true, 'targetClass' => BookType::className(), 'targetAttribute' => ['id_book_type' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'номер книги',
            'name' => 'Имя книги',
            'year' => 'Год выпуска',
            'id_book_type' => 'Жанр книги',
            'type' => 'Жанр',
            'isbn' => 'ISBN книги',
            'description'=>'Описание'
        ];
    }

    public function fullType()
    {
        return [
            'fulltype' => 'fulltype'
        ];
    }

    public function getIdBookType()
    {
        return $this->hasOne(BookType::className(), ['id' => 'id_book_type']);
    }

    public function getType()
    {
        return $this->idBookType->type;
    }

    public function getMapType()
    {
        $Mas = BookType::find()->asArray()->all();
        $Mas = ArrayHelper::map($Mas, 'id', 'type');
        $Mas[0] = 'Все';
        ksort($Mas);
        return $Mas;
    }

    public function getTypeModel()
    {
        $Mas = BookType::find()->asArray()->all();
        return ArrayHelper::map($Mas, 'id', 'type');
    }

    public function getDescription()
    {
        if ($this->isbn=='') return 'Нет описание';
        $request = $this->clientMethod();
        $response = json_decode($request->getBody());
        $response = $response->items[0]->volumeInfo->description;
        return $response;
    }


    public function getPicture()
    {
        if ($this->isbn=='') return '/upload/Book.jpg';
        $request =$this->clientMethod();
        $response = json_decode($request->getBody());
        $checkPicture = $response->items[0]->volumeInfo->readingModes->image;
        if (!$checkPicture) return '/upload/Book.jpg';
        $response = $response->items[0]->volumeInfo->imageLinks->smallThumbnail;
        return $response;
    }

    public function clientMethod(){
        $client=new Client();
        return $client->request('GET', 'https://www.googleapis.com/books/v1/volumes?q=isbn:'.$this->isbn);
    }
}