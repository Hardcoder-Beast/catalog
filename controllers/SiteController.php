<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\AuthorSearch;
use app\models\LoginForm;


class SiteController extends Controller {
	/**
	 * {@inheritdoc}
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
				  	],
				  ],
				  'verbs'  => [
						'class'   => VerbFilter::className(),
						'actions' => [
							  'logout' => [ 'post' ],
						]
				  ]
			];
		}


	/**
	 * {@inheritdoc}
	 */
	public function actions() {
		return [
			  'error'   => [
					'class' => 'yii\web\ErrorAction',
			  ],
			  'captcha' => [
					'class'           => 'yii\captcha\CaptchaAction',
					'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			  ],
		];
	}


	/**
	 * Displays homepage.
	 *
	 * @return string
	 */
	public function actionIndex() {
		$searchModel = new AuthorSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			  'searchModel' => $searchModel,
			  'dataProvider' => $dataProvider
		]);
	}

	/**
	 * Login action.
	 *
	 * @return Response|string
	 */
	public function actionLogin()
	{
	    if (!Yii::$app->user->isGuest) {
		    return $this->redirect(['index']);
	    }

	    $model = new LoginForm();
	    if ($model->load(Yii::$app->request->post()) && $model->login()) {
		    return $this->redirect(['index']);
	    }

	    $model->password = '';
	    return $this->render('login', [
	        'model' => $model,
	    ]);
	}

}
