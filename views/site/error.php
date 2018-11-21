<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <legend><h1><?= Html::encode($this->title) ?></h1></legend>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Возникла ошибка в работе приложения. Пожалуйста, абратитесь к администраторую
    </p>

</div>
