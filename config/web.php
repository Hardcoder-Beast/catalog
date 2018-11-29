<?php
/**
 *  Конфигурация доступа к БД
 */
$db = require __DIR__ . '/db.php';

/**
 *  Конфигурация приложения
 */
$config = [
	  'id'                  => 'app',
	  'basePath'            => dirname( __DIR__ ),
	  'homeUrl'             => '/site/index',
	  'name'                => 'Главная',
	  'controllerNamespace' => 'app',

	  'sourceLanguage' => 'en-US',
	  'language'       => 'ru-RU',

	  'bootstrap' => [  'api'/*, 'log', 'debug'*/ ],

	  'controllerMap' => [
			'site'   => 'app\controllers\SiteController',
			'admin'  => 'app\controllers\AdminController',
			'book'   => 'app\controllers\BookController',
			'author' => 'app\controllers\AuthorController'
	  ],

	  'aliases'    => [
			'@bower' => '@vendor/bower-asset',
			'@npm'   => '@vendor/npm-asset'
	  ],

	  'components' => [
			// 'cache'        => [
			// 	  'class' => 'yii\caching\FileCache'
			// ],
			'user'         => [
				  'identityClass'   => 'app\models\User',
				  'enableAutoLogin' => false

			],
			'errorHandler' => [
				  'errorAction' => 'site/error'
			],
			// 'log'          => [
			// 	  'traceLevel' => YII_DEBUG ? 3 : 0,
			// 	  'targets'    => [
			// 			[
			// 				  'class'  => 'yii\log\FileTarget',
			// 				  'levels' => [ 'error', 'warning' ],
			// 			],
			// 	  ],
			// ],

			'db' => $db,

			'urlManager' => [
				  'class'           => 'yii\web\UrlManager',
				  'enablePrettyUrl' => true,
				  'showScriptName'  => false,
				  'rules'           => [
					  //  Standard routes
					  [ 'class' => 'yii\web\UrlRule', 'pattern' => '/', 'route' => 'site/index' ],

					  [ 'class' => 'yii\web\UrlRule', 'pattern' => '<controller:[\w-]+>/<id:\d+>', 'route' => '<controller>/view' ],
					  [ 'class' => 'yii\web\UrlRule', 'pattern' => '<controller:[\w-]+>/<action:[\w-]+>/<id:\d+>', 'route' => '<controller>/<action>/<id>' ],
					  [ 'class' => 'yii\web\UrlRule', 'pattern' => '<controller:[\w-]+>/<action:[\w-]+>', 'route' => '<controller>/<action>' ]
				  ]
			],

			'request'    => [
				  'cookieValidationKey' => 'SjNqZovxMEaQynEU0FmjAa7cfseyTZmR'
			]
	  ],

	  'modules' => [
			'debug' => [
				  'class' => 'yii\debug\Module'
			],
			'api'  => [
				  'class' => 'app\modules\api\ApiModule'
			]
	  ]
];

if( YII_ENV_DEV ) {
	// $config[ 'bootstrap' ][] = 'debug';
	// $config[ 'modules' ][ 'debug' ] = [
	// 	  'class' => 'yii\debug\Module'
	// ];

	$config[ 'bootstrap' ][] = 'gii';
	$config[ 'modules' ][ 'gii' ] = [
		  'class'      => 'yii\gii\Module',
		  'allowedIPs' => [ '127.0.0.1', '::1' ]
	];
}

return $config;