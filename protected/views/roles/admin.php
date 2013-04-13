<?php
/* @var $this RolesController */
/* @var $model Roles */

$this->breadcrumbs=array(
	'Роли'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Новая роль', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#roles-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление ролями</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'roles-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'id',
			'headerHtmlOptions' => array('class' => 'narrow'),
		),
		array(
			'name' => 'name',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
