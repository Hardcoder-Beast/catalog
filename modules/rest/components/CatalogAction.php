<?php

namespace app\modules\rest\components;

use Yii;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\rest\IndexAction;

/**
 *  RESTful действие для получение списка книг с именем автора
 */
class CatalogAction extends IndexAction
{

	protected function prepareDataProvider()
	{
		$requestParams = Yii::$app->getRequest()->getBodyParams();
		if (empty($requestParams)) {
			$requestParams = Yii::$app->getRequest()->getQueryParams();
		}

		$filter = null;
		if ($this->dataFilter !== null) {
			$this->dataFilter = Yii::createObject($this->dataFilter);
			if ($this->dataFilter->load($requestParams)) {
				$filter = $this->dataFilter->build();
				if ($filter === false) {
					return $this->dataFilter;
				}
			}
		}

		if ($this->prepareDataProvider !== null) {
			return call_user_func($this->prepareDataProvider, $this, $filter);
		}

		/* @var $modelClass \yii\db\BaseActiveRecord */
		$modelClass = $this->modelClass;
		/** @var $relationName \app\modules\rest\controllers\AbstractRestController */
		$relationName = $this->controller->catalogRelationName;

		$query = $modelClass::find()->with( $relationName )->asArray();
		if (!empty($filter)) {
			$query->andWhere($filter);
		}

		return Yii::createObject([
			  'class' => ActiveDataProvider::className(),
			  'query' => $query,
			  'pagination' => [
					'params' => $requestParams,
			  ],
			  'sort' => [
					'params' => $requestParams,
			  ],
		]);
	}
}
