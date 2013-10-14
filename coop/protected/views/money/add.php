<?php
/* @var $this GradeSuperFormController */
/* @var $model GradeSuperForm */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'add-a-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // See class documentation of CActiveForm for details on this,
    // you need to use the performAjaxValidation()-method described there.
    'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>
    <?php $users = User::model()->findAll(array('condition' => 'id != 1')); ?>

    <?php echo $form->errorSummary($model); ?>
    
    <div class="row">
		  <?php echo $form->labelEx($model,'user'); ?>
		  <?php echo $form->dropDownList($model, 'user', CHtml::listData($users, 'id', 'name'), array('empty' => '')); ?>
		  <?php echo $form->error($model,'user'); ?>
	  </div>

    <div class="row">
        <?php echo $form->labelEx($model,'money'); ?>
        <?php echo $form->textField($model,'money'); ?>
        <?php echo $form->error($model,'money'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Submit'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
