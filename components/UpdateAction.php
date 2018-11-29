<?php
namespace app\components;

use Yii;
use yii\base\Action;

/**
 * Class UpdateAction - обновление найденной записи.
 * @package app\components
 */
class UpdateAction extends Action {

	/**
	 *  Обновление существующей записи.
	 *
	 * @param integer $id - ключ искомой записи
	 * @return mixed
	 */
	public function run($id) {
		$controller = $this->controller;
		$newModel  = $controller->findModel($id);

		if ( $newModel->load( Yii::$app->request->post() ) && $newModel->save() ) {
			return $controller->redirectHome();
		}

		return $controller->render( 'update', [
			  'model' => $newModel
		]);
	}

}