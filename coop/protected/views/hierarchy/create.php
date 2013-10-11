<?php
/* @var $this HierarchyController */
/* @var $model Hierarchy */

$this->breadcrumbs=array(
	'Hierarchies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Hierarchy', 'url'=>array('index')),
	array('label'=>'Manage Hierarchy', 'url'=>array('admin')),
);
?>

<h1>Create Hierarchy</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>