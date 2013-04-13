<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'ID '.$model->id=>array('view','id'=>$model->id),
	'Редактирование'
);

?>

<h1>Редактирование пользователя ID: <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
