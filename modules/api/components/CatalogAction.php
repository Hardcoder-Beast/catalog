<?php

namespace app\modules\api\components;

use Yii;
use yii\data\ActiveDataProvider;
use yii\rest\IndexAction;

/**
 *  RESTful API действие для получение списка книг с именами авторов
 */
class CatalogAction extends IndexAction
{

	/**
	 * @return mixed|null|object|ActiveDataProvider|\yii\data\DataFilter
	 * @throws \yii\base\InvalidConfigException
	 */
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
		/** @var $relationName \app\modules\api\controllers\AbstractRestController */
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
