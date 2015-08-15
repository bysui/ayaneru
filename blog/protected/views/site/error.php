<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';

?>

<h2>Error <?php echo $error['code'] ?></h2>

<div class="error">
<?php echo CHtml::encode($error['message']); ?>
<div>
	<?php 
		if ($error['code'] == '403') {
			echo "权限不够";
		}
	?>
	<p id="counter"></p>
</div>
<script type="text/javascript">
	var counter = 5
	function countdown () {
		counter = counter - 1;
		if (counter<=0){
			clearInterval(t);
			window.location.href=<?php echo "'";echo $returnurl;echo "'";?>
		}
		document.getElementById('counter').innerHTML = counter;
	}
	var t = setInterval(countdown,1000);
</script>
</div>