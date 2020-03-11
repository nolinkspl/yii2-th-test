<?php

namespace app\models;

use yii\base\Model;

class TransferMoneyForm extends Model
{
    public $user_id;
    public $amount;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['user_id', 'amount'], 'required'],
            ['user_id', 'integer'],
            ['amount', 'number'],
        ];
    }
}