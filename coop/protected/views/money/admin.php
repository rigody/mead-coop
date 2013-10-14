<?php
/* @var $this MoneyController */
/* @var $model Money */

$this->breadcrumbs=array(
	'Moneys'=>array('index'),
	'Manage',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#money-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'money-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
		  'name' => 'user',
		  'value' => '$data->relUser->name',
		),
		'money',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
