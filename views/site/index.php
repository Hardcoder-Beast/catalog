<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Каталог';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-index">

	<legend><h1><?= Html::encode($this->title) ?></h1></legend>

	<?= GridView::widget([
		  'dataProvider' => $dataProvider,
		  'filterModel' => $searchModel,
		  'columns' => [
				['class' => 'yii\grid\SerialColumn'],

				[
					  'class' => 'yii\grid\DataColumn',
					  'label' => 'Автор',
					  'attribute' => 'author_name',
					  'enableSorting' => true
				],
				[
					  'class' => 'yii\grid\DataColumn',
					  'label' => 'Книги',
					  'format' => 'html',
					  'value' => function ($data) {
						  return $data->getMainData();
					  },
				]
		  ]
	]) ?>
</div>
