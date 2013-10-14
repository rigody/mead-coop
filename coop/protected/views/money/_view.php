<?php
/* @var $this MoneyController */
/* @var $data Money */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user')); ?>:</b>
	<?php echo CHtml::encode($data->user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('money')); ?>:</b>
	<?php echo CHtml::encode($data->money); ?>
	<br />


</div>