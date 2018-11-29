<?php

namespace app\modules\api;

use Yii;
use \yii\base\Module;
use yii\helpers\ArrayHelper;


/**
 *  Модуль для RESTful API
 */
class ApiModule extends Module
{
	/**
	 *  Инициализация компонента.
	 */
	public function init()
	{
		parent::init();

		\Yii::configure( $this, require __DIR__ . '/config.php' );


		//  RESTful API
		$newRule = [
			  [ 'class' => 'yii\rest\UrlRule',
			    'controller' => ['rest-book','rest-author'],
			    'prefix' => 'api',
			    'patterns' => [
				      'PUT,PATCH {id}' => 'update',
				      'DELETE {id}' => 'delete',
				      'GET,HEAD {id}' => 'view',
				      'POST' => 'create',
				      'GET,HEAD' => 'index',
				      'GET,HEAD catalog' => 'catalog',
				      '{id}' => 'options',
				      '' => 'options'
			    ]
			  ]
		];

		Yii::$app->getUrlManager()->addRules( $newRule, false );

		Yii::$app->controllerMap = ArrayHelper::merge( Yii::$app->controllerMap, [
			  'rest-book'   => 'app\modules\api\controllers\RestBookController',
			  'rest-author' => 'app\modules\api\controllers\RestAuthorController'
		] );

	}
}
