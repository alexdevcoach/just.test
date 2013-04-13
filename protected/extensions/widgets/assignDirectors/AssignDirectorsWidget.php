<?php
/**
 * @author alexcoach lexa.trener@gmail.com
 * @since 11.04.13 0:54
 */

class AssignDirectorsWidget extends CWidget {

	public $manager;

	public function init() {

		$assetsUrl = CHtml::asset(Yii::getPathOfAlias('ext.widgets.assignDirectors.assets'));

		Yii::app()->clientScript->registerScriptFile($assetsUrl.'/assignDirectors.js');
		Yii::app()->clientScript->registerScript('assignDirectors',"
$('.assign-widget').assignDirectors({
assignAjaxUrl : '".Yii::app()->createUrl('users/assignDirector')."'
});
	",CClientScript::POS_READY);


	}

	public function run() {
		$this->render('assignDirectorsWidget', array('model' => $this->manager));
	}

}
