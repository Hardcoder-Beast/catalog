<?php

namespace app\modules\api\controllers;


/**
 *  Контроллер CRUD действий для книг по RESTful API
 */
class RestBookController extends AbstractRestController
{
	/**
	 * @var string имя класса модели. Обязательный атрибут.
	 */
	public $modelClass = 'app\models\Book';

	/**
	 * @var string $catalogRelationName имя связанной таблицы для действия REST API «catalog»
	 */
	public $catalogRelationName = 'authors';

}