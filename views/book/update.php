<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
$bookName = $model->book_name ? $model->book_name : $model->book_id;
$this->title = 'Редактирование: ' . $bookName;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = [ 'label' => $bookName, 'url' => [ 'view', 'id' => $bookName]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="book-update">

    <legend><h1><?= Html::encode($this->title) ?></h1></legend>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
