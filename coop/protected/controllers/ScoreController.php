<?php

class ScoreController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'calculate', 'upgrade'),
				'users'=>array('admin'),
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
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Score;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Score']))
		{
			$model->attributes=$_POST['Score'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Score']))
		{
			$model->attributes=$_POST['Score'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Score');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Score('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Score']))
			$model->attributes=$_GET['Score'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionCalculate()
	{
	  $es = Evaluation::model()->findAll(array('order' => 'id DESC'));
	  $us = User::model()->findAll(array('condition' => 'id != 1'));
	  
	  foreach ($es as $e)
	  {
	    foreach ($us as $u)
	    {
	      $s = Score::model()->find(array(
	        'condition' => 'user = :u AND evaluation = :e',
	        'params' => array(
	          ':u' => $u->id,
	          ':e' => $e->id
	        ),
	      ));
	      
	      $score = $u->calcScore($e->id);
	      if ($score == null)
	        continue;
	      
	      if ($s === null)
	      {
	        $s = new Score;
	        $s->user = $u->id;
	        $s->evaluation = $e->id;
	      }
        $s->score = $score;
        $s->save();
	    }
	  }
	  
	  $this->render('calculate');
	}
	
	public function actionUpgrade()
	{
	  $us = User::model()->findAll(array('condition' => 'id != 1'));
	  
	  $text = array();
	  foreach ($us as $u)
	  {
	    switch ($u->role)
	    {
	      case 2: // Manager
	        // Demote
	        $gs = Score::model()->findAll(array('condition' => 'user = :u AND score < 7.0', 'params' => array(':u' => $u->id)));
	        if (count($gs) > 30)
	          $text[] = $u->name . ' (Manager) : DEMOTED';
	        break;
        case 3: // Section Manager
          // Promote
          $gs = Score::model()->findAll(array('condition' => 'user = :u AND score >= 9.5', 'params' => array(':u' => $u->id)));
	        if (count($gs) > 30)
	          $text[] = $u->name . ' (Section Manager) : PROMOTED';
          // Demote
          $gs = Score::model()->findAll(array('condition' => 'user = :u AND score < 6.8', 'params' => array(':u' => $u->id)));
	        if (count($gs) > 30)
	          $text[] = $u->name . ' (Section Manager) : DEMOTED';
          break;
        case 4: // Dept Manager
          // Promote
          $gs = Score::model()->findAll(array('condition' => 'user = :u AND score >= 9.2', 'params' => array(':u' => $u->id)));
	        if (count($gs) > 30)
	          $text[] = $u->name . ' (Dept Manager) : PROMOTED';
          // Demote
          $gs = Score::model()->findAll(array('condition' => 'user = :u AND score < 6.5', 'params' => array(':u' => $u->id)));
	        if (count($gs) > 20)
	          $text[] = $u->name . ' (Dept Manager) : DEMOTED';
          break;
        case 5: // Worker
          // Promote
          $gs = Score::model()->findAll(array('condition' => 'user = :u AND score >= 9.0', 'params' => array(':u' => $u->id)));
	        if (count($gs) > 20)
	          $text[] = $u->name . ' (Worker) : PROMOTED';
          break;
	    }
	  }
	  
	  $this->render('upgrade', array('text' => $text));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Score the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Score::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Score $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='score-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
