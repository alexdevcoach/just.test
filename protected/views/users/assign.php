<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Назначение руководителей',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Назначение руководителей менеджерам</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'managers-grid',
	'dataProvider'=>$model->searchManagers(),
	'selectableRows' => false,
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'id',
			'headerHtmlOptions' => array('class' => 'narrow'),
		),
		array(
			'header' => 'Менеджеры',
			'name' => 'fullname',
		),
		array(
			'header' => 'Назначенные руководители',
			//'filter' => Roles::getListData(),
			'type' => 'raw',
			'value' => 'Yii::app()->controller->widget("ext.widgets.assignDirectors.AssignDirectorsWidget", array("manager" => $data), true)',
		),
	),
)); ?>
