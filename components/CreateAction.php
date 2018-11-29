<?php
namespace app\components;

use Yii;
use yii\base\Action;

/**
 * Class CreateAction - создание новой записи.
 * @package app\components
 */
class CreateAction extends Action {

	/**
	 *  Создание новой записи.
	 *
	 * @return mixed
	 */
	public function run() {
		$controller = $this->controller;
		$newModel  = new $controller->modelClass();

		if ( $newModel->load( Yii::$app->request->post() ) && $newModel->save() ) {
			return $controller->redirectHome();
		}

		return $controller->render( 'create', [
			  'model' => $newModel,
		]);
	}

}