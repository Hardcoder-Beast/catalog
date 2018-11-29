<?php

namespace app\modules\api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 *  Абстрактный контроллер для RESTful API
 */
class AbstractRestController extends ActiveController
{
	/**
	 * @var string имя класса модели. Обязательный атрибут.
	 */
	public $modelClass;

	/**
	 * @var string $catalogRelationName имя связанной таблицы для действия REST API «catalog»
	 */
	public $catalogRelationName;


	/**
	 *  Инициализация компонента.
	 *
	 * @throws \yii\base\InvalidConfigException
	 */
	public function init()
	{
		parent::init();

		$this->module = Yii::$app->getModule( 'api', true );

		//  REST API требует работы вне сессии.
		if ( Yii::$app->session->isActive ) {
			Yii::$app->session->destroy();
		}
	}


	/**
	 * {@inheritdoc}
	 */
	protected function verbs()
	{
		return [
			  'index' => ['GET', 'HEAD'],
			  'catalog' => ['GET', 'HEAD'],
			  'view' => ['GET', 'HEAD'],
			  'create' => ['POST'],
			  'update' => ['PUT', 'PATCH'],
			  'delete' => ['DELETE'],
		];
	}


	/**
	 *  Проверка доступа к REST запросам.
	 *
	 * @param       $action - действие
	 * @param null  $model - запись
	 * @param array $params - параметры
	 * @throws \yii\web\ForbiddenHttpException
	 */
	public function checkAccess($action, $model = null, $params = [])
	{
		if ( $action === 'create' || $action === 'update' || $action === 'delete' ) {
			if ( \Yii::$app->user->isGuest ) {
				throw new \yii\web\ForbiddenHttpException( 'Только авторизованные пользователи могут удалять, редактировать, или создать новые записи.' );
			}
		}
	}


	/**
	 * @see Component::behaviors()
	 * @return array - конфигурация behaviors.
	 */
	public function behaviors()
	{
		// удаляем rateLimiter, требуется для аутентификации пользователя
		$behaviors = parent::behaviors();
		unset( $behaviors[ 'rateLimiter' ] );

		$behaviors[] = [
			  'class' => 'yii\filters\ContentNegotiator',
			  'only' => ['view', 'index', 'catalog'],
			  'formats' => [
					'application/json' => Response::FORMAT_JSON
			  ]
		];

		return $behaviors;
	}

	/**
	 * @return array действий для контроллера
	 *
	 * Доступные действия:
	 *  index: выдача списка в формате JSON;
	 *  catalog: получение списка записей со связанными сущностями;
	 *	view: получение записи по id;
	 *	create: добавление записи;
	 *	update: обновление записи;
	 *	delete: удаление записи из бд.
	 */
	public function actions()
	{
		$actions = parent::actions();

		$actions[ 'catalog' ] = [
			  'class'       => 'app\modules\api\components\CatalogAction',
			  'modelClass'  => $this->modelClass,
			  'checkAccess' => [ $this, 'checkAccess' ]
		];

		return $actions;
	}

}