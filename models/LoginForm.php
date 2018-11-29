<?php

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * Форма входа (модель)
 *
 * @property User|null $user - модель только для чтения.
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array список валидаций
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword']
        ];
    }


	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			  'username' => 'Логин',
			  'password' => 'Пароль',
			  'rememberMe' => 'Запомнить',
		];
	}

    /**
     *  Проверка пароля.
     *
     * @param string $attribute - атрибут для проверки
     * @param array $params - дополнительные параметры
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверный логин или пароль.');
            }
        }
    }

    /**
     *  Попытка пользователя зайти в систему.
     *
     * @return bool - результат логина
     */
    public function login()
    {
        if ( $this->validate() ) {
            return Yii::$app->user->login( $this->getUser(), $this->rememberMe ? 3600*24*30 : 0 );
        }
        return false;
    }

    /**
     *  Найти пользователя по имени пользователя.
     *
     * @return User|null - модель только для чтения.
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername( $this->username );
        }

        return $this->_user;
    }
}
