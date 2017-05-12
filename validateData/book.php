<?php
/*
namespace frontend\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property integer $id
 * @property string $name
 * @property integer $year
 */
/*class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
/*    public static function tableName()
    {
        return 'book';
    }

    /**
     * @inheritdoc
     */
/*    public function rules()
    {
        return [
            [['name', 'year'], 'required'],
            [['year'], 'integer'],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
 /*   public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'year' => 'Year',
        ];
    }
}