<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Book;

/**
 * BookSearch represents the model behind the search form about `frontend\models\Book`.
 */
class BookSearch extends Book
{
    /**
     * @inheritdoc
     */
    var $type;
    public $fkBookType;
    public function rules()
    {
        return [
            [['id', 'year', 'fk_book_type'], 'integer'],
            [['name', 'fkBookType'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Book::find();
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $dataProvider->setSort([
            'attributes'=>[
                'name',
                'year',
                'fk_book_type'
            ]
        ]);
        $dataProvider->sort->attributes['fkBookType']=[
            'asc'=>['book_type.type'=>SORT_ASC],
            'desc'=>['book_type.type'=>SORT_DESC]
            ];
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        // grid filtering conditions

        $query->andFilterWhere([
            'id' => $this->id,
            'year' => $this->year,
            'fk_book_type' => $this->fk_book_type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'book_type.type',$this->fkBookType]);

        return $dataProvider;
    }
}