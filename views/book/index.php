<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <legend><h1><?= Html::encode($this->title) ?></h1></legend>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyCell' => '',
        'columns' => [
            [
             'class' => 'yii\grid\SerialColumn',
             'headerOptions' => ['style' => 'width: 50px;'],
            ],

            'book_id',

            'book_name',

            'book_desc',

            [
	              'class' => 'yii\grid\DataColumn',
	              'label' => 'Авторы',
	              'value' => function ($data) {
		              return $data->getMainData();
	              },
            ],

            [
             'class' => 'yii\grid\ActionColumn',
             'headerOptions' => ['style' => 'width: 56px;'],
             'template' => '{update}&nbsp;&nbsp;{delete}'
            ]
        ],
    ]); ?>
</div>
