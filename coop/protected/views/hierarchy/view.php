<?php
/* @var $this HierarchyController */
/* @var $model Hierarchy */

$this->breadcrumbs=array(
	'Hierarchies'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Hierarchy', 'url'=>array('index')),
	array('label'=>'Create Hierarchy', 'url'=>array('create')),
	array('label'=>'Update Hierarchy', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Hierarchy', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Hierarchy', 'url'=>array('admin')),
);
?>

<h1>View Hierarchy #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
		  'name' => 'super',
		  'value' => $model->relSuper()->name,
		),
		array(
		  'name' => 'under',
		  'value' => $model->relUnder()->name,
		),
	),
)); ?>
