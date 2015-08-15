<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/comment.css">
<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array('id'=>'comment-form',));?>
	<div class="container80">
		<div class="container">
			<div class="title"><?php echo $shop->name;?></div>
			<div class="body"><?php echo $shop->description;?></div>
		</div>

		<h2 class="comment-title">评论区</h2>
		<div class="comment-box">
			<?php
			foreach ($commentlist as $key => $value) {
				echo "<div class='child-box'>";
					echo "<div class='uname'>".$value->user->name."</div>";
					echo "<div class='ccontent'>".$value->body."</div>";
					echo "<div class='time'>".$value->postdate."</div>";	
				echo "</div>";
			}
			?>
		</div>
		<div class="row clearfix">
			<h3 class="leftfloat">想说两句</h3>
			<?php echo $form->textArea($model,'body'); ?>
			<?php echo $form->error($model,'body'); ?>
		</div>
		<div class="row buttons">
			<?php echo CHtml::submitButton('发表评论'); ?>
		</div>
	</div>
	<?php $this->endWidget(); ?>
</div><!-- form -->
