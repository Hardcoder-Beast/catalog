<?php

namespace app\components;

use yii\base\Action;

/**
 * Class DeleteAction - удаление найденной записи.
 * @package app\components
 */
class DeleteAction extends Action
{
	/**
	 *  Основной метод действия.
	 *
	 * @param integer $id - ключ записи.
	 * @return mixed
	 */
	public function run($id)
	{
		$controller = $this->controller;
		$controller->findModel( $id )->delete();

		return  $controller->redirectHome();
	}

}