<?php

namespace app\components;

use Yii;
use yii\base\Action;

/**
 * Class IndexAction - отображение списка всех записей.
 * @package app\components
 */
class IndexAction extends Action
{
	/**
	 *  Основной метод отображения данных.
	 *
	 * @return mixed
	 */
	public function run()
	{
		$controller = $this->controller;
		$searchModel = $controller->modelClass . 'Search';
		$searchModel  = new $searchModel();

		$dataProvider = $searchModel->search( Yii::$app->request->queryParams );

		return $controller->render( 'index', [
			  'searchModel' => $searchModel,
			  'dataProvider' => $dataProvider,
		]);
	}

}