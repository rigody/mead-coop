<?php
/* @var $this ScoreController */
/* @var $data Score */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user')); ?>:</b>
	<?php echo CHtml::encode($data->relUser->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('evaluation')); ?>:</b>
	<?php echo CHtml::encode($data->relEvaluation->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('score')); ?>:</b>
	<?php echo CHtml::encode($data->score); ?>
	<br />


</div>
