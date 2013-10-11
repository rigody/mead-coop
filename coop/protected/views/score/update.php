<?php
/* @var $this ScoreController */
/* @var $model Score */

$this->breadcrumbs=array(
	'Scores'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Score', 'url'=>array('index')),
	array('label'=>'Create Score', 'url'=>array('create')),
	array('label'=>'View Score', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Score', 'url'=>array('admin')),
);
?>

<h1>Update Score <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>