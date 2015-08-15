<?php

class SiteController extends CController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
				'minLength'=>4,
				'maxLength'=>4,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			// 'page'=>array(
			// 	'class'=>'CViewAction',
			// ),
		);
	}
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	public function accessRules()
	{
		return array(
			array('allow',
				'actions' => array('comment'),
				'roles' => array('*'), 
			),
			// array('deny',
			// 	'actions' => array('comment'),
			// 	'users' => array('*'),
			// ),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		if(isset($_POST['curId']))
		{
			$model = Shop::model()->findALL();

			$data = array();

			for ($i=0; $i < sizeof($model); $i++) { 
				$data[$i]['name'] = $model[$i]->name;
				$data[$i]['description'] = $model[$i]->description;
			}

			// print_r($data);

			echo json_encode($data);
			exit();
		}

		$condition = new CDbCriteria;
		$condition->limit = 1;
		//$condition->order = 'postdate DESC';
		//$page = 1;
		//$variable = $this->getActionParams();
		//if (isset($variable['page'])) {
		//	$page = (int)$variable['page'];
		//}

		$model = Shop::model()->findALL($condition);
		// $totalnum = Content::model()->count();

		// $this->render('index',array('model' => $model, 'totalnum'=>$totalnum, 'page'=>$page));

		// $model = Shop::model()->findALL();

		$this->render('index',array('model' => $model,));
		// $this->render('test');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', array('error'=>$error,'returnurl'=>Yii::app()->createURL('site/index')));
		}
	}

	/**
	 * Displays the article list
	 */
	public function actionList()
	{
		$condition = new CDbCriteria;
		$condition->limit = 8;
		$condition->order = 'postdate DESC';
		$page = 1;
		$variable = $this->getActionParams();
		if (isset($variable['page'])) {
			$page = (int)$variable['page'];
		}
		$condition->offset = ($page-1)*8;

		$model = Content::model()->findALL($condition);
		$totalnum = Content::model()->count();

		$this->render('list',array('model'=>$model,'page'=>$page, 'totalnum'=>$totalnum));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (isset(Yii::app()->user->roles)) {
			$this->render('return',array('returnurl'=>Yii::app()->user->returnUrl,));
		} else {
			$model=new LoginForm;
			// if it is ajax validation request
			// if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			// {
			// 	echo CActiveForm::validate($model);
			// 	Yii::app()->end();
			// }

			// collect user input data
			if(isset($_POST['LoginForm']))
			{
				$model->attributes=$_POST['LoginForm'];
				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->login())
				{
					$this->redirect(Yii::app()->user->returnUrl);
				}
					
			}
			// display the login form

			$this->render('login',array('model'=>$model));
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	public function actionRegister()
	{
		if (isset(Yii::app()->user->roles)) {
			$this->render('return',array('returnurl'=>Yii::app()->user->returnUrl,));
		} else {
			$model=new RegisterForm;

			if(isset($_POST['RegisterForm']))
			{
				// collect user input data
				$model->attributes=$_POST['RegisterForm'];
				//if the input is valid
				if ($model->validate()) {
					$newuser = new User;
					$newuser->name = $model->username;
					$newuser->password = $model->password;
					$newuser->auth = 1;
					//update the database
					if ($newuser->save()) {
						$login = new LoginForm;
						$login->attributes=$_POST['RegisterForm'];
						// validate user input and redirect to the previous page if valid
						if($login->validate() && $login->login()){
							$this->redirect(Yii::app()->homeUrl);
						}
						else{
							print_r($login->getErrors());
							exit();
						}
					} else {
						print_r($newuser->getErrors());
						exit();
					}
					
				}
				else{
					print_r($model->getErrors());
					exit();
				}
				// validate user input and redirect to the previous page if valid					
			}
			// display the login form

			$this->render('register',array('model'=>$model));
		}
	}

	public function actionShop(){

		$model = new Comment;
		
		// $criteria = new CDbCriteria();
		// $criteria->with = array ('user');

		$id = Yii::app()->request->getParam('id');
		
		// $commentlist = Comment::model()->findAllByAttributes(array('sid'=>$id),$criteria);
		$commentlist = Comment::model()->with('user')->findAllByAttributes(array('sid'=>$id));

		$shop = Shop::model()->findByPk($id);

		if(isset($_POST['Comment']))
		{
			$role = Yii::app()->user->getId();
			if(!empty($role)){
				if (Yii::app()->user->roles != '0' && Yii::app()->user->roles != '1') {
					$this->redirect(Yii::app()->createURL('site/login'));
				}
			}
			else{
				$this->redirect(Yii::app()->createURL('site/login'));
			}
			date_default_timezone_set('Asia/Shanghai');
			$model->postdate = date("Y-m-d H:i:s");

			$model->attributes=$_POST['Comment'];
			$model->sid = $id;
			$model->uid = Yii::app()->user->uid;
			
			if($model->save()){
				$this->redirect(Yii::app()->createURL('site/shop/id/'.$id));
			}
			else{
				print_r($model->getErrors());
				exit();
			}
		}

		$this->render('shop',array('model'=>$model,'commentlist'=>$commentlist,'shop'=>$shop,));

		// $this->render('test');
	}
}
