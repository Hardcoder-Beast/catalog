<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register( $this );
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode( $this->title ) ?></title>
	<?php $this->head() ?>
</head>
<body>
	<?php $this->beginBody() ?>

	<div class="wrap">
		<?php NavBar::begin( [
			  'brandLabel' => Yii::$app->name,
			  'brandUrl'   => [ '/site/index' ],
			  'options'    => [
					'class' => 'navbar-inverse navbar-fixed-top',
			  ],
		] ); ?>

		<?= Nav::widget( [
			  'options' => [ 'class' => 'navbar-nav navbar-left' ],
			  'items'   => [
					[ 'label' => 'Авторы', 'url' => [ '/author/index' ], 'visible' => !Yii::$app->user->isGuest ],
					[ 'label' => 'Книги', 'url' => [ '/book/index' ], 'visible' => !Yii::$app->user->isGuest ]
			  ]
		] ) ?>

		<?= Nav::widget( [
			  'options' => [ 'class' => 'navbar-nav navbar-right' ],
			  'items'   => [
					Yii::$app->user->isGuest ? (
					[ 'label' => 'Вход', 'url' => [ '/site/login' ], 'visible' => Yii::$app->user->isGuest ]
					) : (
						  '<li>'
						  . Html::beginForm( [ '/site/logout' ], 'post' )
						  . Html::submitButton(
								'Выход (' . Yii::$app->user->identity->username . ')',
								[ 'class' => 'btn btn-link logout', 'style' => 'padding: 15px;' ]
						  )
						  . Html::endForm()
						  . '</li>')
			  ]
		] ) ?>
		<?php NavBar::end(); ?>

		<div class="container">
			<?= Breadcrumbs::widget( [
				  'links' => isset( $this->params[ 'breadcrumbs' ] ) ? $this->params[ 'breadcrumbs' ] : [],
			] ) ?>
			<?= $content ?>
		</div>
	</div>

	<footer class="footer">
		<div class="container">
			<p class="pull-right"><?= Yii::powered() ?></p>
		</div>
	</footer>

	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
