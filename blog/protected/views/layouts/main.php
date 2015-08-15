<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />
		<meta name="keywords" content="申丽波" />
		<meta name="description" content="申丽波" />
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.1.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/base.css" />
	</head>
	<body>
		<div class="ibody">
			<header>
				<h1>名字</h1>
				<p>&nbsp;</p>
				<nav id="topnav">
					<?php $current_action = $this->action->getId(); $current_controller = $this->getId();?>
					<a <?php if($current_controller=='site' && $current_action=='index'){echo"id='topnav_current'";}else;?> href=<?php echo Yii::app()->createURL('site/index');?>>首页</a>
					<!-- <a <?php if($current_controller=='site' && $current_action=='list'){echo"id='topnav_current'";}else;?> href=<?php echo Yii::app()->createURL('site/list');?>>文章列表</a> -->
					<!-- <a <?php if($current_controller=='manage' && $current_action=='index'){echo"id='topnav_current'";}else;?> href=<?php echo Yii::app()->createURL('manage/index');?>>管理</a> -->
					<a <?php if($current_controller=='site' && $current_action=='login'){echo"id='topnav_current'";}else;?> href=<?php echo Yii::app()->createURL('site/login');?>>登录</a>
					<a <?php if($current_controller=='site' && $current_action=='register'){echo"id='topnav_current'";}else;?> href=<?php echo Yii::app()->createURL('site/register');?>>注册</a>
				</nav>
			</header>			
			<?php echo $content; ?>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
		</div>
	</body>
	<br>
	<br>
</html>