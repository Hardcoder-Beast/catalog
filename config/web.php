<?php
/**
 *  Конфигурация приложения
 */


$db = require __DIR__ . '/db.php';

$config = [
	  'id'        => 'basic',
	  'homeUrl'   => '/site/index',
	  'name'      => 'Главная',
	  'basePath'  => dirname( __DIR__ ),
	  'bootstrap' => [ 'log', 'rest', 'debug' ],

	  'sourceLanguage' => 'en-US',
	  'language' => 'ru-RU',

	  'aliases'    => [
			'@bower' => '@vendor/bower-asset',
			'@npm'   => '@vendor/npm-asset',
	  ],
	  'components' => [
			'request'      => [
				  'cookieValidationKey' => 'SjNqZovxMEaQynEU0FmjAa7cfseyTZmR',
			],
			'cache'        => [
				  'class' => 'yii\caching\FileCache',
			],
			'user'         => [
				  'identityClass'   => 'app\models\User',
				  'enableAutoLogin' => true,
			],
			'errorHandler' => [
				  'errorAction' => 'site/error',
			],
			'mailer'       => [
				  'class'            => 'yii\swiftmailer\Mailer',
				  'useFileTransport' => true,
			],
			'log'          => [
				  'traceLevel' => YII_DEBUG ? 3 : 0,
				  'targets'    => [
						[
							  'class'  => 'yii\log\FileTarget',
							  'levels' => [ 'error', 'warning' ],
						],
				  ],
			],

			'db'           => $db,

			'urlManager' => [
				  'enablePrettyUrl' => true,
				  'rules'           => [
					  // URL RULES:
					  '/'                                      => 'site/index',
					  '<controller:\w+>/<id:\d+>'              => '<controller>/view',
					  '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
					  '<controller:\w+>/<action:\w+>'          => '<controller>/<action>'
				  ]
				]
			],

	  'modules'    => [
			'debug' => [
				  'class' => 'yii\debug\Module',
			],
			'rest'  => [
				  'class' => 'app\modules\rest\RestModule',
			]
	  ]
];

if( YII_ENV_DEV ) {
	$config[ 'bootstrap' ][] = 'debug';
	$config[ 'modules' ][ 'debug' ] = [
		  'class' => 'yii\debug\Module',
	];

	$config[ 'bootstrap' ][] = 'gii';
	$config[ 'modules' ][ 'gii' ] = [
		  'class'      => 'yii\gii\Module',
		  'allowedIPs' => [ '127.0.0.1', '::1' ],
	];
}

return $config;
