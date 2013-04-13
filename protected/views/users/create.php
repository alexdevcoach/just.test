<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Новый',
);

?>

<h1>Создание пользователя</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
