<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

	<?php $form = ActiveForm::begin(); ?>

	<div class="col-md-6 pull-left">

		<div class="col-md-12"><?= $form->field( $model, 'book_name' )->textInput( [ 'maxlength' => true ] ) ?></div>

		<div class="col-md-12"><?= $form->field( $model, 'book_desc' )->textarea( [ 'rows' => 3 ] ) ?></div>

	</div>

	<div class="col-md-6 pull-left">
		<?php
		echo Html::label( 'Авторы книги' );
		?>
		<div class="col-md-12"><?= Html::activeDropDownList($model, 'books_author', ArrayHelper::map( app\models\Author::find()->all(), 'author_id', 'author_name' ), [ 'style' => [ 'height' => '144px', 'width' => '440px' ], 'id' => 'author_books_listbox', 'multiple' => 'multiple', 'options'=> $model->isNewRecord ? [] : $model->getAuthorsData() ] ); ?>
		</div>
	</div>

	<div class="row"></div>


	<div class="row well">

		<div class="form-group col-md-6 col-md-offset-3">
			<?= Html::submitButton( 'Сохранить', [ 'class' => 'btn btn-block btn-primary' ] ) ?>
		</div>

	</div>

	<?php ActiveForm::end(); ?>

</div>