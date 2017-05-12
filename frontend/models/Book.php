<?php
/**
 * Created by PhpStorm.
 * User: grigo
 * Date: 05.05.17
 * Time: 15:35
 */

namespace frontend\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "book".
 *
 * @property integer $id
 * @property string $name
 * @property integer $year
 * @property integer $id_book_type
 *
 * @property BookType $idBookType
 */
class Book extends ActiveRecord
{

    public static function tableName(){
        return 'book';
    }

    public function rules(){
        return [
            [['name', 'year', 'id_book_type'], 'required'],
            [['year'], 'integer'],
            [['name'],'string', 'max'=>150],
            [['id_book_type'], 'exist', 'skipOnError'=>true, 'targetClass'=>BookType::className(), 'targetAttribute'=>['id_book_type'=>'id']],
        ];
    }
    public function attributeLabels(){
        return [
            'id'=>'номер книги',
            'name'=>'Имя книги',
            'year'=>'Год выпуска',
            'id_book_type'=>'Жанр книги',
            'type'=>'Жанр'
        ];
    }
    public function fullType(){
        return  [
            'fulltype'=>'fulltype'
        ];
    }
    public function getIdBookType()
    {
        return $this->hasOne(BookType::className(), ['id' => 'id_book_type']);
    }
    public function getType(){
        return $this->idBookType->type;
    }
    public function getMapType(){
        $Mas=BookType::find()->asArray()->all();
        return ArrayHelper::map($Mas, 'id', 'type');
    }
    public function getTypeModel(){
        $Mas=BookType::find()->asArray()->all();
        return ArrayHelper::map($Mas, 'id', 'type');
    }
}