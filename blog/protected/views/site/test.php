<title>首页</title>
<?php
	// foreach ($model as $key => $record) {
	// 	echo $key;
	// 	echo ":";
	// 	print_r($record);
	// 	echo "<br>";
	// 	echo "<br>";
	// }
	if (isset(Yii::app()->user->roles)) {
		echo "当前权限: ";
		print_r(Yii::app()->user->roles);
	}
	else{
		echo "当前权限: ";	
		print_r(-1);
	}
	

	// echo "hello";
?>