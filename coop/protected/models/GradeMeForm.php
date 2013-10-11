<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class GradeMeForm extends CFormModel
{
	public $x1;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('x1', 'required'),
			array('x1', 'numerical', 'integerOnly'=>true, 'min'=> 1, 'max' => 10),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'x1'=>'x1',
		);
	}

  public function save($sbj, $obj, $e)
  {
    $g = new Grade;
    $g->evaluation = $e;
    $g->user_sbj = $sbj;
    $g->user_obj = $obj;
    $g->grade = $this->x1;
    $g->save();
  }
}
