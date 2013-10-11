<?php
/* @var $this HierarchyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Hierarchies',
);

$this->menu=array(
	array('label'=>'Create Hierarchy', 'url'=>array('create')),
	array('label'=>'Manage Hierarchy', 'url'=>array('admin')),
);
?>

<h1>Hierarchies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
