<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class GradeUnderForm extends CFormModel
{
	public $x1;
	public $x2;
	public $x3;
	public $x4;
	public $x5;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('x1, x2, x3, x4, x5', 'required'),
			array('x1, x2, x3, x4, x5', 'numerical', 'integerOnly'=>true, 'min'=> 1, 'max' => 10),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'x1'=>'Goals Achievement',
			'x2'=>'Presence',
			'x3'=>'Improvement Suggestions',
			'x4'=>'Behaviour',
			'x5'=>'Cooperation',
		);
	}

  public function save($sbj, $obj, $e)
  {
    $xs = array($this->x1, $this->x2, $this->x3, $this->x4, $this->x5);
    $avg = (float) (array_sum($xs) / count($xs));
    
    $g = new Grade;
    $g->evaluation = $e;
    $g->user_sbj = $sbj;
    $g->user_obj = $obj;
    $g->grade = $avg;
    $g->save();
  }
}
