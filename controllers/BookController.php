<?php

namespace app\controllers;

use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 *  AuthorController реализует действия CRUD для модели книги.
 */
class BookController extends AdminController
{
	/**
	 * {@inheritdoc}
	 */
	public $modelClass = 'app\models\Book';


	/**
	 *  Перенаправление на домашнюю страницу.
	 *
	 * @return Response - ответ сервера.
	 */
	public function redirectHome()
	{
		return $this->redirect( ['book/index'] );
	}

}
