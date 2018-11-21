<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = 'Создание записи';
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-create">

    <legend><h1><?= Html::encode($this->title) ?></h1></legend>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
