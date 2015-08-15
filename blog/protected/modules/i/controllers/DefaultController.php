<?php

class DefaultController extends CController
{
	public function actionIndex()
	{
		$uid = Yii::app()->controller->module->userid;

		$this->render('index', array('_uid' => $uid,));
	}
}
?>