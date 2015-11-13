<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class BookSearch extends Book
{
    public $authorName;
    public $dateTo;
    public $dateFrom;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'authorName', 'dateTo', 'dateFrom'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Book::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'id',
                    'name',
                    'date',
                    'date_create',
                    'authorName' => [
                        'asc' => ['authors.lastname' => SORT_ASC],
                        'desc' => ['authors.lastname' => SORT_DESC]
                    ],
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            $query->joinWith('author');
            return $dataProvider;
        }

        $query
            ->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['like', 'name', $this->name]);

        if ($this->dateFrom) {
            $query->andFilterWhere(['>=', 'date', $this->dateFrom]);
        }

        if ($this->dateTo) {
            $query->andFilterWhere(['<=', 'date', $this->dateTo]);
        }

        $query->joinWith(['author' => function ($q) {
            if ($this->authorName) {
                $q->where(['authors.id' => $this->authorName]);
            }
        }]);

        return $dataProvider;
    }
}