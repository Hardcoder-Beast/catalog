<?php

namespace app\controllers;

use yii\helpers\ArrayHelper;
use yii\web\Response;


/**
 *  AuthorController реализует действия CRUD для модели автора.
 */
class AuthorController extends AdminController
{
	/**
	 * {@inheritdoc}
	 */
	public $modelClass = 'app\models\Author';


	/**
	 *  Перенаправление на домашнюю страницу.
	 *
	 * @return Response - ответ сервера.
	 */
	public function redirectHome()
	{
		return $this->redirect( ['author/index'] );
	}

}
