<?php
/**
 * @var $this AssignDirectorsWidget
 * @var $model Users
 */
?>
<div class="assign-widget">
	<?php $this->widget('zii.widgets.grid.CGridView', array(
		//'updateSelector' => '#assign-table-'.$model->id,
		'template' => $this->render('_assignDirectorWidgetForm', array('model'=>$model),true).'{items}',
		'id'=>'assign-table-'.$model->id,
		'selectableRows' => false,
		'dataProvider'=>$model->searchManagerDirectors(),
		'emptyText' => 'Руководители не назначены',
		'columns'=>array(
			array(
				'name' => 'id',
				'headerHtmlOptions' => array('class' => 'narrow'),
			),
			array(
				'header' => 'Руководитель',
				'name' => 'fullname',
			),
			array(
				'class'=>'CButtonColumn',
				'template' => '{delete}',
				'deleteConfirmation' => false,
				'buttons' => array(
					'delete' => array(
						'url' => 'Yii::app()->createUrl("users/unassignDirector", array("manager"=>'.$model->id.', "director"=>$data->id))',
					),
				),
			),
		),
	)); ?>
</div>
