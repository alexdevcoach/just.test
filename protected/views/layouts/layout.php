<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-24">
	<?php
		$this->widget('zii.widgets.CMenu', array(
			'id' => 'actions-menu',
			'items'=>$this->menu,
			'htmlOptions'=>array('style'=>'float: right;'),
		));
		?>
</div>

<div class="span-24">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>

<?php $this->endContent(); ?>
