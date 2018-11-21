<?php

namespace app\modules\rest\controllers;

use yii\web\Response;
use yii\filters\AccessControl;
use yii\rest\ActiveController;

/**
 *  Абстрактный контроллер для RESTful API
 */
class AbstractRestController extends ActiveController
{
	/**
	 * @var string $catalogRelationName имя связанной таблицы для действия catalog
	 */
	public $catalogRelationName;

	public function checkAccess($action, $model = null, $params = [])
	{
		if ( $action === 'create' || $action === 'update' || $action === 'delete' ) {
			if ( \Yii::$app->user->isGuest ) {
				throw new \yii\web\ForbiddenHttpException( 'Только авторизованные пользователи могут удалять, редактировать, или создать новые записи.' );
			}
		}
	}


	/**
	 * @return array действий для контроллера
	 * Действия по-умолчанию:
	 *  index: выдача данных в формате JSON;
	 *  catalog: получение списка книг с именем автора;
	 *	view: получение данных книги по id; /view/?id=49
	 *	create: добавление книги;
	 *	update: обновление данных книги;
	 *	delete: удаление записи книги из бд.
	 */
	public function actions()
	{
		$actions = parent::actions();

		$actions[ 'index' ] = [
			  'class'       => 'yii\rest\IndexAction',
			  'modelClass'  => $this->modelClass,
			  'checkAccess' => [ $this, 'checkAccess' ],
		];
		$actions[ 'catalog' ] = [
			  'class'       => 'app\modules\rest\components\CatalogAction',
			  'modelClass'  => $this->modelClass,
			  'checkAccess' => [ $this, 'checkAccess' ],
		];
		$actions[ 'view' ] = [
			  'class'       => 'yii\rest\ViewAction',
			  'modelClass'  => $this->modelClass,
			  'checkAccess' => [ $this, 'checkAccess' ],
		];
		$actions[ 'create' ] = [
			  'class'       => 'yii\rest\CreateAction',
			  'modelClass'  => $this->modelClass,
			  'checkAccess' => [ $this, 'checkAccess' ],
			  'scenario'    => $this->createScenario,
		];
		$actions[ 'update' ] = [
			  'class'       => 'yii\rest\UpdateAction',
			  'modelClass'  => $this->modelClass,
			  'checkAccess' => [ $this, 'checkAccess' ],
			  'scenario'    => $this->updateScenario,
		];
		$actions[ 'delete' ] = [
			  'class'       => 'yii\rest\DeleteAction',
			  'modelClass'  => $this->modelClass,
			  'checkAccess' => [ $this, 'checkAccess' ],
		];

		return $actions;
	}


	public function behaviors() {
		return [
			  [
					'class'   => 'yii\filters\ContentNegotiator',
					'formats' => [
						  'application/json' => Response::FORMAT_JSON,
					]
			  ],
			  'access' => [
					'class' => AccessControl::className(),
					'rules' => [
						  [
								'allow' => true
						  ]
					]
			  ]
		];
	}

}