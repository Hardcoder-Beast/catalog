<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Integer;
use phpDocumentor\Reflection\Types\String_;

/**
 *  Class User - модель пользователя.
 * @package app\models
 */
class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
	/**
	 * @var Integer - УН
	 */
    public $id;
	/**
	 * @var String_ - имя пользователя
	 */
    public $username;
	/**
	 * @var String_ - пароль
	 */
    public $password;
    public $authKey;
    public $accessToken;


	/**
	 * @var array $users - временный статический пользователь для пробных работ с системой
	 */
    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ]
    ];


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return isset( self::$users[$id] ) ? new static( self::$users[$id] ) : null;
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }


    /**
     *  Найти по имени пользователя
     *
     * @param string $username - имя пользователя
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }


    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }


    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }


    /**
     *  Проверяет правильность пароль
     *
     * @param string $password - пароль для проверки
     * @return bool - признак правильности пароль
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
