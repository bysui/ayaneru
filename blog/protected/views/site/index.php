<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/index.css" />

<title>home</title>

	<?php
		foreach ($model as $key => $record) {
			echo "<div class='shop'>";
			echo "<h3><a href=".Yii::app()->createURL('site/shop/id')."/".$record->id.">".$record->name."</a></h3>";
			echo "<ul>";
			echo "<p>".$record->description."</p>";
			echo "</ul>";
			echo "</div>";
		}
	// 	if (isset(Yii::app()->user->roles)) {
		// 		echo Yii::app()->user->roles;
	// 	} else {
		// 		echo "NULL";
	// 	}
	?>

	<button id='test'>click</button>
	<p>点击通过ajax获取数据</p>

<script type="text/javascript">
	$(document).ready(function(){
		$("#test").click(function(){
			var testId = 1;
			$.ajax({
				url: "site/index",
				type: 'POST',
				data: {curId:testId},
				dataType: "json",
				success: function (data) {
					var _debugInfo="";
					for (var i in data) {
						for (var j in data[i]){
							_debugInfo += j + ":" + data[i][j] + "\n";
						}
						_debugInfo += "\n";
					};
					alert(_debugInfo);
				},
				error: function(){
					alert("call ajax failed");
				}

			});
		});
	});
</script>