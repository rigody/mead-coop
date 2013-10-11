<?php
/* @var $this HierarchyController */
/* @var $data Hierarchy */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('super')); ?>:</b>
	<?php echo CHtml::encode($data->relSuper->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('under')); ?>:</b>
	<?php echo CHtml::encode($data->relUnder->name); ?>
	<br />


</div>
