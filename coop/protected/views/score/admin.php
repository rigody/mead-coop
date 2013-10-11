<?php
/* @var $this ScoreController */
/* @var $model Score */

$this->breadcrumbs=array(
	'Scores'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Score', 'url'=>array('index')),
	array('label'=>'Create Score', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#score-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Scores</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'score-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
		  'name' => 'uname',
		  'value' => '$data->relUser->name',
		),
		array(
		  'name' => 'ename',
		  'value' => '$data->relEvaluation->name',
		),
		'score',
		array(
		  'name' => 'bonus',
		  'value' => '$data->bonus',
		),
	),
)); ?>
