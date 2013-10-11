<?php
/* @var $this HierarchyController */
/* @var $model Hierarchy */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hierarchy-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php $users = User::model()->findAll(array('condition' => 'id != 1')); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'super'); ?>
		<?php echo $form->dropDownList($model, 'super', CHtml::listData($users, 'id', 'name'), array('empty' => '')); ?>
		<?php echo $form->error($model,'super'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'under'); ?>
		<?php echo $form->dropDownList($model, 'under', CHtml::listData($users, 'id', 'name'), array('empty' => '')); ?>
		<?php echo $form->error($model,'under'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
