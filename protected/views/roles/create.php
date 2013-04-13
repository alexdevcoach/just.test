<?php
/* @var $this RolesController */
/* @var $model Roles */

$this->breadcrumbs=array(
	'Роли'=>array('index'),
	'Новая',
);

?>

<h1>Создание роли</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
