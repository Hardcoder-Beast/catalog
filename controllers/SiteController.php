<?php

namespace app\controllers;

use Yii;
use yii\base\Component;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\AuthorSearch;
use app\models\LoginForm;

/**
 * Class SiteController - основной контроллер взаимодействия с системой.
 * @package app\controllers
 */
class SiteController extends Controller
{
	/**
	 * @see Component::behaviors()
	 * @return array - конфигурация behaviors.
	 */
	public function behaviors() {
		return [
			  'access' => [
				    'class' => AccessControl::className(),
				    'only'  => [ 'logout' ],
				    'rules' => [
					      [
						        'allow'   => true,
						        'roles'   => [ '@' ]
					      ],
				    ]
			  ],
			  'verbs'  => [
				    'class'   => VerbFilter::className(),
				    'actions' => [
					      'logout' => [ 'post' ]
				    ]
			  ]
		];
	}


	/**
	 * @return array - конфигурация действий контроллера.
	 */
	public function actions()
	{
		return ArrayHelper::merge(
			  [
					'error' => [
						  'class' => 'yii\web\ErrorAction'
					]
			  ], parent::actions() );
	}


	/**
	 *  Отобразить домашнюю страницу (со списком авторов по-умолчанию).
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		$searchModel = new AuthorSearch();
		$dataProvider = $searchModel->search( Yii::$app->request->queryParams );

		return $this->render('index', [
			  'searchModel' => $searchModel,
			  'dataProvider' => $dataProvider
		]);
	}


	/**
	 *  Действие входа в систему.
	 *
	 * @return yii\web\Response|string - ответ сервера.
	 */
	public function actionLogin()
	{
	    if (!Yii::$app->user->isGuest) {
		    return $this->redirectHome();
	    }

	    $model = new LoginForm();
	    if ( $model->load( Yii::$app->request->post() ) && $model->login() ) {
		    return $this->redirectHome();
	    }

	    $model->password = '';
	    return $this->render('login', [
	        'model' => $model
	    ]);
	}


	/**
	 *  Действие выхода из системы.
	 *
	 * @return yii\web\Response - ответ сервера.
	 */
	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->redirectHome();
	}


	/**
	 *  Перенаправление на домашнюю страницу.
	 *
	 * @return Response - ответ сервера.
	 */
	protected function redirectHome()
	{
		return $this->redirect( [ '/site/index' ] );
	}

}
