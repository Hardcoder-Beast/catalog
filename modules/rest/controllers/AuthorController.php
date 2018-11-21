<?php

namespace app\modules\rest\controllers;

use yii\web\Response;
use yii\filters\AccessControl;
use yii\rest\ActiveController;

/**
 *  Контроллер CRUD действий для авторов книг по RESTful API
 */
class AuthorController extends AbstractRestController
{
	/**
	 *  @var string modelClass значение свойства класса модели REST-контроллера
	 */
	public $modelClass = 'app\models\Author';

	public $catalogRelationName = 'books';

}