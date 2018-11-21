<?php

use app\models\BookSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Author */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="author-form">

    <?php $form = ActiveForm::begin(); ?>


	<div class="col-md-6 pull-left">

		<div class="col-md-12"><?= $form->field($model, 'author_name')->textInput(['maxlength' => true]) ?></div>

		<div class="col-md-12"><?= $form->field($model, 'author_desc')->textarea(['rows' => 3]) ?></div>

	</div>


	<div class="col-md-6 pull-left">
		<?php
		echo Html::label( 'Книги автора' );
		?>
		<div class="col-md-12"><?= Html::activeDropDownList($model, 'author_books', ArrayHelper::map( app\models\Book::find()->all(), 'book_id', 'book_name' ), [ 'style' => [ 'height' => '144px', 'width' => '440px' ], 'id' => 'author_books_listbox', 'multiple' => 'multiple', 'options'=> $model->isNewRecord ? [] : $model->getBooksDataSelected() ] ); ?>
		</div>
	</div>


	<div class="row"></div>

	<div class="row well" >

		<div class="form-group col-md-6 col-md-offset-3">
			<?= Html::submitButton('Сохранить', ['class' => 'btn btn-block btn-primary']) ?>
		</div>

	</div>

    <?php ActiveForm::end(); ?>

</div>