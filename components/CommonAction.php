<?php

namespace app\components;

use yii\base\Action;

/**
 * Class CommonAction - удаление найденной записи.
 * @package app\components
 */
class CommonAction extends Action
{
	/**
	 * @var string $viewName - название представления
	 */
	public $viewName = 'view';


	/**
	 *  Основной метод действия отображения записи.
	 *
	 * @param integer $id - ключ записи.
	 * @return mixed
	 */
	public function run($id)
	{
		$controller = $this->controller;

		return $controller->render( $this->viewName, [
			  'model' => $controller->findModel( $id )
		]);
	}

}