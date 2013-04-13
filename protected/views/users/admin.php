<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Новый пользователь', 'url'=>array('create')),
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

<h1>Управление пользователями</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'id',
			'headerHtmlOptions' => array('class' => 'narrow'),
		),
		'username',
		'fullname',
		array(
			'name' => 'role_id',
			'header' => 'Роль',
			'filter' => Roles::getListData(),
			'value' => '$data->role->name',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
