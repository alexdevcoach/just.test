<?php
/* @var $this RolesController */
/* @var $model Roles */

$this->breadcrumbs=array(
	'Роли'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Редактирование',
);

?>

<h1>Редактирование роли <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
