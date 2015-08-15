<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/add.css">
<div class="form">
	<?php $form=$this->beginWidget('CActiveForm', array('id'=>'edite-form',));?>
	<div class="container70">
		<div class="row title">
			<?php echo $form->labelEx($model,'题目'); ?>
			<?php echo $form->textField($model,'title'); ?>
			<?php echo $form->error($model,'title'); ?>
		</div>
		<div class="row body">
			<div class="leftfloat"><?php echo $form->labelEx($model,'文章'); ?></div>
			<?php echo $form->textArea($model,'body'); ?>
			<?php echo $form->error($model,'body'); ?>
		</div>
		<div class="row buttons">
			<?php echo CHtml::submitButton('发表'); ?>
		</div>
	</div>
	<?php $this->endWidget(); ?>
</div><!-- form -->
