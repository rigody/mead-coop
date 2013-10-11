<?php
/* @var $this HierarchyController */
/* @var $model Hierarchy */

$this->breadcrumbs=array(
	'Hierarchies'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Hierarchy', 'url'=>array('index')),
	array('label'=>'Create Hierarchy', 'url'=>array('create')),
	array('label'=>'View Hierarchy', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Hierarchy', 'url'=>array('admin')),
);
?>

<h1>Update Hierarchy <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>