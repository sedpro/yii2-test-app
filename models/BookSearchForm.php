<?php

namespace app\models;

use Yii;
use yii\base\Model;

class BookSearchForm extends Model
{
    public $name;

    public $authorName;

    public $dateTo;

    public $dateFrom;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        // only fields in rules() are searchable
        return [
            [['name', 'dateTo', 'dateFrom', 'authorName'], 'safe'],
        ];
    }
    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'authorName' => 'Автор',
            'dateFrom' => 'Дата выхода книги',
            'dateTo' => 'до',
        ];
    }
}
