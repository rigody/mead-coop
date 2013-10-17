<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class MoneyAddForm extends CFormModel
{
	public $user;
	public $money;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('user, money', 'required'),
			array('user, money', 'numerical'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'user'=>'User',
			'money'=>'Money',
		);
	}

  public function save()
  {
    $top = User::model()->findByPk($this->user);
    $users = array($top);
    $temp = $top->relUnder();
    
    while(count($temp))
    {
      $u = array_pop($temp);
      $new = $u->relUnder();
      $temp = array_merge($temp, $new);
      $users[] = $u;
    }
	
	foreach($top->relSuper() as $sup)
	{
		$users[] = $sup;
		foreach ($sup->relSuper() as $supu)
			$users[] = $supu;
	}
    
    $n = count($users);
    $amount = ((float) $this->money) * 0.2 / ($n + 1);
    
    foreach ($users as $u)
    {
      $r = Money::model()->find(array(
        'condition' => 'user = :u',
        'params' => array(':u' => $u->id),
      ));
      
      if ($r === null)
      {
        $r = new Money;
        $r->user = $u->id;
        $r->money = $amount;
        $r->save();
      }
      else
      {
        $r->money = (float) $r->money + $amount;
        $r->save();
      }
    }
  }
}
