<?php

class ManageController extends CController
{
	// Uncomment the following methods and override them if needed
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'accessControl',
		);
	}
	public function accessRules()
	{
		return array(
			array('allow',
				'roles' => array('0'), 
			),
			array('deny',
				'users' => array('*'),
				'message' => 'not enough power',
			),
		);
	}

	public function actionIndex()
	{
		$condition = new CDbCriteria;
		$condition->limit = 5;
		$condition->order = 'postdate DESC';

		$page = 1;
		$variable = $this->getActionParams();
		if (isset($variable['page'])) {
			$page = (int)$variable['page'];
		}
		$condition->offset = ($page-1)*5;

		$model = Content::model()->findALL($condition);
		$totalnum = Content::model()->count();

		$this->render('index',array('model'=>$model,'page'=>$page,'totalnum'=>$totalnum,));
	}

	public function actionAdd()
	{
		date_default_timezone_set('Asia/Shanghai');
		$model = new Content;
		$model->postdate = date("Y-m-d H:i:s");
		if(isset($_POST['Content']))
		{
			$model->attributes=$_POST['Content'];
			// validate user input and redirect to the previous page if valid

			if($model->save())
			{
				$this->redirect(Yii::app()->createURL("manage/index"));
			}else{
				print_r($model->errors);
				exit();
			}
				
		}
		$this->render('add',array("model"=>$model,));
	}

	public function actionDelete()
	{
		$id = Yii::app()->request->getParam('id');
		if(Content::model()->deleteByPk($id)){
			$this->redirect(Yii::app()->createURL("manage/index"));
		}
		else{
			echo "error";
			exit();
		}
		// $id = 
		// echo ;
	}

	public function actionEdite()
	{
		$id = Yii::app()->request->getParam('id');
		$model = Content::model()->findByPk($id);

		if(isset($_POST['Content']))
		{
			$model->attributes=$_POST['Content'];
			
			if($model->updateByPk($id,array("title"=>$model->title, "body"=>$model->body))){
				$this->redirect(Yii::app()->createURL("manage/index"));
			}
			else{
				print_r($model->getErrors());
				exit();
			}
		}
		$this->render('edite',array("model"=>$model,));
	}
	
}