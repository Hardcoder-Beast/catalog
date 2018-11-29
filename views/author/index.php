<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Авторы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-index">

	<legend><h1><?= Html::encode($this->title) ?></h1></legend>

	<p>
		<?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?= GridView::widget([
		  'dataProvider' => $dataProvider,
		  'emptyCell' => '',
		  'filterModel' => $searchModel,
		  'columns' => [
				[
					  'class' => 'yii\grid\SerialColumn',
					  'headerOptions' => ['style' => 'width: 50px;'],
				],

				'author_name',

				[
					  'class' => 'yii\grid\DataColumn',
					  'label' => 'Кол-во книг',
					  'value' => function ($data) {
						  $htmlData = $data->getBookQty();
						  return $htmlData;
					  },
				],

				[
					  'class' => 'yii\grid\ActionColumn',
					  'headerOptions' => ['style' => 'width: 56px;'],
					  'template' => '{update}&nbsp;&nbsp;{delete}'
				]

		  ]
	]) ?>
</div>
