<?php
//  Конфигурация для модуля поддержки RESTful

$config = [
	  'id' => 'rest',

	  'aliases' => [
			'@models' => '@app/modules',
			'@rest'   => '@models/rest'
	  ],

	  'controllerMap' => [
			[
				  'books'  => [
						'class' => 'app\modules\rest\controllers\BookController'
				  ],
				  'author' => [
						'class' => 'app\modules\rest\controllers\AuthorController'
				  ]
			]
	  ],

	  'components' => [
			'urlManager' => [
				  'class'               => 'yii\web\UrlManager',
				  'enablePrettyUrl'     => true,
				  'enableStrictParsing' => true,
				  'showScriptName'      => false,
				  'rules'               => [
						[
							  'class'      => 'yii\rest\UrlRule',
							  'controller' => [ 'books', 'author' ]
						]
				  ]
			],

			'request' => [
				  'class'      => 'yii\web\Request',
				  'formatters' => [
						'json' => [
							  'class'         => 'yii\web\JsonResponseFormatter',
							  'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
						],
				  ],
				  'parsers'    => [
						'application/json' => 'yii\web\JsonParser'
				  ]
			],

			'response' => [
				  'class'   => 'yii\web\Response',
				  'format'  => yii\web\Response::FORMAT_JSON,
				  'charset' => 'UTF-8'
			]
	  ]
];

return $config;