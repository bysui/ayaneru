<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/manageindex.css">
<div class="container80 clearfix">
	<?php
		foreach ($model as $key => $value) {
			echo "<div class='titlelist'>";
			echo "<a class='h3 title' href=".Yii::app()->createURL('site/comment/article')."/".$value->id.">".$value->title."</a>";
			echo "</div>";
		}
	?>
	<div class="pagination rightfloat">
		<a class="previous" href=<?php echo Yii::app()->createURL('site/list/page')."/"; echo $page-1<=0?1:$page-1;?>>上一页</a>
		<a class="first" href=<?php echo Yii::app()->createURL('site/list/page/1');?>>首页</a>
		<span class="current" href=""><?php echo $page;?></span>
		<a class="last" href= <?php echo Yii::app()->createURL('site/list/page')."/".(ceil($totalnum/5));?>>尾页</a>
		<a class="next" href= <?php echo Yii::app()->createURL('site/list/page')."/".($page+1);?>>下一页</a>
	</div>
</div>