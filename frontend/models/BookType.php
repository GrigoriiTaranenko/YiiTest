<?php
/**
 * Created by PhpStorm.
 * User: grigo
 * Date: 10.05.17
 * Time: 11:44
 */


namespace frontend\models;

use Yii;

/**
 * This is the model class for table "book_type".
 *
 * @property string $type
 * @property integer $id
 *
 * @property Book[] $books
 */
class BookType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type' => 'Жанр книги',
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['id_book_type' => 'id']);
    }
}