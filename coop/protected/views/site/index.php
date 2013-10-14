<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<?php if(!Yii::app()->user->isGuest): ?>
  <p>Hello <strong><?php echo Yii::app()->user->userModel->name; ?></strong>!</p>
<?php endif; ?>

<?php if(!Yii::app()->user->isGuest && Yii::app()->user->id == 1): ?>
  <?php echo CHtml::link('User Table Management', $this->createUrl('user/index')); ?>
  <?php echo CHtml::link('Role Table Management', $this->createUrl('role/index')); ?>
  <?php echo CHtml::link('Hierarchy Table Management', $this->createUrl('hierarchy/index')); ?>
  <?php echo CHtml::link('Evaluation Table Management', $this->createUrl('evaluation/index')); ?>
  
  <div style="height:40px; width:100%"></div>
  
  <div>
    <p>
      <?php echo CHtml::link('Calculate Scores', $this->createUrl('score/calculate')); ?>
      <?php echo CHtml::link('Distribute Task Bonuses', $this->createUrl('money/add')); ?>
    </p>
  </div>
  
  <div style="height:40px; width:100%"></div>
  
  <div>
    <p>
      <?php echo CHtml::link('Results', $this->createUrl('score/admin')); ?>
      <?php echo CHtml::link('Suggestions', $this->createUrl('score/upgrade')); ?>
      <?php echo CHtml::link('Task Bonuses', $this->createUrl('money/admin')); ?>
    </p>
  </div>
<?php endif; ?>

<?php if(!Yii::app()->user->isGuest && Yii::app()->user->id != 1): ?>
  <?php echo CHtml::link('Evaluation Home', $this->createUrl('evaluation/viewall')); ?>
<?php endif; ?>
