<?php

namespace app\controllers;

use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;


/**
 * Class AdminController - контроллер взаимодействий административной панели.
 * @package app\controllers
 */
class AdminController extends SiteController
{

	/**
	 * @var $modelClass - класс модели для дочерних контроллеров.
	 */
	public $modelClass;


	/**
	 *  Конфигурация действия logout() для всех наследующих данный класс контроллеров.
	 *
	 * @see Component::behaviors()
	 * @return array - конфигурация behaviors.
	 */
	public function behaviors() {
		return [
			  'access' => [
					'class' => AccessControl::className(),
					'rules' => [
						  [
								'actions' => [ 'create', 'update', 'index', 'logout', 'view', 'delete' ],
								'allow'   => true,
								'roles'   => [ '@' ]
						  ]
					]
			  ],
			  'verbs'  => [
					'class'   => VerbFilter::className(),
					'actions' => [
						  'delete' => [ 'post' ]
					]
			  ]
		];
	}


	/**
	 *  Действие входа в систему и
	 * перенаправление на домашнюю страницу посетителей административной панели.
     *
     * @return string
     */
    public function actionIndex()
    {
	    return parent::actionLogin();
    }


	/**
	 *  Перенаправление на домашнюю страницу.
	 *
	 * @return Response - ответ сервера.
	 */
	public function redirectHome()
	{
		return $this->redirect( [ '/books/index' ] );
	}


	/**
	 *  Находит модель по первичному ключу.
	 *
	 * @param integer $id первичный ключ записи
	 * @return object загруженная модель
	 * @throws NotFoundHttpException если по данному ключу не найдено записи.
	 */
	public function findModel($id)
	{
		/** @var ActiveRecord $newModel */
		$newModel = new $this->modelClass;

		if (($model = $newModel::findOne($id)) !== null) {
			return $model;
		}

		throw new NotFoundHttpException('Страница не найдена.');
	}


	/**
	 * @return array - массив действий для дочерних контроллеров.
	 */
	public function actions()
	{
		return ArrayHelper::merge( parent::actions(), [
			  'delete' => [
					'class' => 'app\components\DeleteAction'
			  ],
			  'view' => [
					'class' => 'app\components\CommonAction'
			  ],
			  'index' => [
					'class' => 'app\components\IndexAction'
			  ],
			  'create' => [
					'class' => 'app\components\CreateAction'
			  ],
			  'update' => [
					'class' => 'app\components\UpdateAction'
			  ]
		] );
	}

}
