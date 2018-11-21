<?php

namespace app\modules\rest\controllers;

use yii\web\Response;
use yii\filters\AccessControl;
use yii\rest\ActiveController;

/**
 *  Контроллер CRUD действий для книг по RESTful API
 */
class BookController extends AbstractRestController
{
	/**
	 *  @var string modelClass значение свойства класса модели REST-контроллера
	 */
	public $modelClass = 'app\models\Book';

	public $catalogRelationName = 'authors';

}