<?php if (count($users) == 0): ?>

  <p>No Available Users</p>

<?php else: ?>

  <?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'user-grid',
    'dataProvider'=>new CArrayDataProvider($users),
    'columns'=>array(
      'name',
      array('name' => 'role', 'value' => '$data->relRole->name'),
      array(
        'class' => 'CButtonColumn',
        'template' => '{update}',
        'updateButtonUrl' => '$data->gradeLink()'
        ),
    ),
  )); ?>

<?php endif; ?>
