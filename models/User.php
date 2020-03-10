<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Exception;

/**
 * Class User
 * @package app\models
 * @property int $id
 * @property string $username
 * @property float $balance
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['username', 'required'],
            ['username', 'string'],
            ['balance', 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @return User[]
     */
    public static function findAllUsers()
    {
        return static::find()->orderBy(['id' => SORT_ASC])->all();
    }

    /**
     * @param array $params
     * @return User
     * @throws \Exception
     */
    public static function createUser(array $params)
    {
        $result = new User();

        if ($result->load($params, '') && $result->save()) {
            return $result;
        };

        Yii::error('Active record error: ' . json_encode($result->getErrors()));
        throw new Exception('Error');

    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function username()
    {
        return $this->username;
    }

    public function balance()
    {
        return $this->balance;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return true;
    }
}
