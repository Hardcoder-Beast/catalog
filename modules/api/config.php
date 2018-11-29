<?php
/**
 *  Конфигурация модуля для поддержки RESTful API
 */

$config = [
	  'id'       => 'api',
	  'basePath' => __DIR__,

	  'controllerNamespace' => 'app\modules\api',

	  'aliases' => [
			'@modules' => '@app/modules',
			'@api'     => '@modules/api'
	  ],

	  'components' => [

			'response' => [
				  'class'          => 'yii\web\Response',
				  'format'         => 'json',
				  'acceptMimeType' => 'application/json',
				  'charset'        => 'UTF-8',
				  'formatters'     => [
						\yii\web\Response::FORMAT_JSON => [
							  'class'         => 'yii\web\JsonResponseFormatter',
							  'contentType'   => yii\web\JsonResponseFormatter::CONTENT_TYPE_JSON,
							  'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
						],
				  ]
			],

			'request' => [
				  'class'   => 'yii\web\Request',
				  'parsers' => [
						'application/json' => 'yii\web\JsonParser'
				  ]
			]
	  ]
];

return $config;