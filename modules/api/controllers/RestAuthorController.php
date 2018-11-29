<?php

namespace app\modules\api\controllers;

/**
 *  Контроллер CRUD действий для авторов книг по RESTful API
 */
class RestAuthorController extends AbstractRestController
{
	/**
	 * @var string имя класса модели. Обязательный атрибут.
	 */
	public $modelClass = 'app\models\Author';

	/**
	 * @var string $catalogRelationName имя связанной таблицы для действия REST API «catalog»
	 */
	public $catalogRelationName = 'books';

}