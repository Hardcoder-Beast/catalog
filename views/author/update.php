<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Author */

$authorName = $model->author_name ? $model->author_name : $model->author_id;
$this->title = 'Редактирование: ' . $authorName;
$this->params['breadcrumbs'][] = ['label' => 'Авторы', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="author-update">

    <legend><h1><?= Html::encode($this->title) ?></h1></legend>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

