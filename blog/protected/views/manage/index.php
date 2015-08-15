<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/manageindex.css">
<div class="container80 clearfix">
	<div class="publish">
		<a href=<?php echo Yii::app()->createURL("manage/add");?>>NEW</a>
	</div>
	<?php
		foreach ($model as $key => $value) {
			echo "<div class='titlelist'>";
			echo "<h3 class='title'>".$value->title."</h3>";
			echo "<div class='operation'>";
				echo "<a class='delete' href=";echo Yii::app()->createURL('manage/delete/'.$value['id']);echo ">delete</a>";
				echo "<a class='alter' href=";echo Yii::app()->createURL('manage/edite/'.$value['id']);echo ">edite</a>";
			echo "</div>";
			echo "</div>";
		}
	?>
	<div class="pagination rightfloat">
		<a class="previous" href=<?php echo Yii::app()->createURL('manage/index/page')."/"; echo $page-1<=0?1:$page-1;?>>pre</a>
		<a class="first" href=<?php echo Yii::app()->createURL('manage/index/page/1');?>>first</a>
		<span class="current" href=""><?php echo $page;?></span>
		<a class="last" href= <?php echo Yii::app()->createURL('manage/index/page')."/".(ceil($totalnum/5));?>>end</a>
		<a class="next" href= <?php echo Yii::app()->createURL('manage/index/page')."/".($page+1);?>>next</a>
	</div>
</div>
