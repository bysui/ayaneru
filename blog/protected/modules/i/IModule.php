<?php

class IModule extends CWebModule
{
	public $username = 'here';
	public $userid = 'here';
	public $imgpath = 'here';

	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application
		$role = Yii::app()->user->getId();
		if(!empty($role)){
			$this->userid = Yii::app()->user->uid;
		}
		else{
			$this->userid = -1;
		}
		
		// import the module-level models and components
		$this->setImport(array(
			'i.models.*',
			'i.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
