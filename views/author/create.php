<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Author */

$this->title = 'Создание записи';
$this->params['breadcrumbs'][] = ['label' => 'Автор', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-create">

    <legend><h1><?= Html::encode($this->title) ?></h1></legend>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
