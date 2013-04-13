<?php
/**
 * @var $model Users
 */
?>
<?php if ($unassignedDirectors = $model->getUnassignedDirectors()) { ?>
<div class="assign-form" data-manager-id="<?php echo $model->id; ?>" style="float: right">
	<?php echo CHtml::dropDownList('director_id', null, CHtml::listData($unassignedDirectors,'id','fullname')); ?>
	<?php echo CHtml::button('Назначить руководителем', array('class'=> 'ajax-assign')); ?>
</div>
<?php } else { ?>
<span style="float: right">Назначены все</span>
<?php } ?>
