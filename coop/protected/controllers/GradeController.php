<?php

class GradeController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('super', 'under', 'co'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionSuper($id)
	{
    $u = User::model()->findByPk($id);
    if ($u === null)
      throw new CHttpException(400, 'Invalid Request');
    
	  $model = new GradeSuperForm;
	  
	  if (isset($_POST['GradeSuperForm']))
	  {
	    $model->attributes = $_POST['GradeSuperForm'];
	    if ($model->validate())
	    {
    	  $e = Evaluation::model()->find(array('order' => 'id DESC'));
	      $model->save(Yii::app()->user->id, $id, $e->id);
	      $this->redirect($this->createUrl('evaluation/viewall'));
	    }
	  }
	  
		$this->render('super', array(
		  'model' => $model,
	  ));
	}

	public function actionUnder($id)
	{
	  $u = User::model()->findByPk($id);
    if ($u === null)
      throw new CHttpException(400, 'Invalid Request');
    
	  $model = new GradeUnderForm;
	  
	  if (isset($_POST['GradeUnderForm']))
	  {
	    $model->attributes = $_POST['GradeUnderForm'];
	    if ($model->validate())
	    {
    	  $e = Evaluation::model()->find(array('order' => 'id DESC'));
	      $model->save(Yii::app()->user->id, $id, $e->id);
	      $this->redirect($this->createUrl('evaluation/viewall'));
	    }
	  }
	  
		$this->render('under', array(
		  'model' => $model,
	  ));
	}

	public function actionCo($id)
	{
	  $u = User::model()->findByPk($id);
    if ($u === null)
      throw new CHttpException(400, 'Invalid Request');
    
	  $model = new GradeCoForm;
	  
	  if (isset($_POST['GradeCoForm']))
	  {
	    $model->attributes = $_POST['GradeCoForm'];
	    if ($model->validate())
	    {
    	  $e = Evaluation::model()->find(array('order' => 'id DESC'));
	      $model->save(Yii::app()->user->id, $id, $e->id);
	      $this->redirect($this->createUrl('evaluation/viewall'));
	    }
	  }
	  
		$this->render('co', array(
		  'model' => $model,
	  ));
	}
	
	public function actionMe($id)
	{
	  $u = User::model()->findByPk($id);
    if ($u === null)
      throw new CHttpException(400, 'Invalid Request');
    
	  $model = new GradeMeForm;
	  
	  if (isset($_POST['GradeMeForm']))
	  {
	    $model->attributes = $_POST['GradeMeForm'];
	    if ($model->validate())
	    {
    	  $e = Evaluation::model()->find(array('order' => 'id DESC'));
	      $model->save(Yii::app()->user->id, $id, $e->id);
	      $this->redirect($this->createUrl('evaluation/viewall'));
	    }
	  }
	  
		$this->render('me', array(
		  'model' => $model,
	  ));
	}

}
