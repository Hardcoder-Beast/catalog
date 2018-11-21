<?php

namespace app\modules\rest;

use \yii\base\Module;

/**
 *  Модуль для реализации RESTful API на проекте
 */
class RestModule extends Module
{
	public function init() {
		parent::init();

		\Yii::configure( $this, require __DIR__ . '/config.php' );

		$this->response->acceptMimeType = 'application/json';

		$headers = $this->response->getHeaders();

		if( $headers ) {
			$this->response->getHeaders()->remove( 'Content-Type' );
			$this->response->getHeaders()->add( 'Content-Type', 'application/json; charset=UTF-8' );
		}
	}

}
