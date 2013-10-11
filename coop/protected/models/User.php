<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property integer $role
 * @property integer $salary
 * @property integer $vacation
 *
 * The followings are the available model relations:
 * @property Grade[] $grades
 * @property Grade[] $grades1
 * @property Hierarchy[] $hierarchies
 * @property Hierarchy[] $hierarchies1
 * @property Role $role0
 */
class User extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, name, role, salary, vacation', 'required'),
            array('role, salary, vacation', 'numerical', 'integerOnly'=>true),
            array('username', 'length', 'max'=>16),
            array('password', 'length', 'max'=>32),
            array('name', 'length', 'max'=>45),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, password, name, role, salary, vacation', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'grades' => array(self::HAS_MANY, 'Grade', 'user_sbj'),
            'grades1' => array(self::HAS_MANY, 'Grade', 'user_obj'),
            'relHier1' => array(self::HAS_MANY, 'Hierarchy', 'super'),
            'relHier2' => array(self::HAS_MANY, 'Hierarchy', 'under'),
            'relUnder' => array(self::HAS_MANY, 'User', 'under', 'through' => 'relHier1'),
            'relSuper' => array(self::HAS_MANY, 'User', 'super', 'through' => 'relHier2'),
            'relRole' => array(self::BELONGS_TO, 'Role', 'role'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'name' => 'Name',
            'role' => 'Role',
            'salary' => 'Salary',
            'vacation' => 'Vacation',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('username',$this->username,true);
        $criteria->compare('password',$this->password,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('role',$this->role);
        $criteria->compare('salary',$this->salary);
        $criteria->compare('vacation',$this->vacation);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    
    public function isSuper($id)
    {
      $u = Hierarchy::model()->find(array(
        'condition' => 'super = :s AND under = :u',
        'params' => array(
          ':s' => $id,
          ':u' => $this->id,
        ),
      ));
      
      return $u !== null;
    }
    
    public function isUnder($id)
    {
      $u = Hierarchy::model()->find(array(
        'condition' => 'super = :s AND under = :u',
        'params' => array(
          ':u' => $id,
          ':s' => $this->id,
        ),
      ));
      
      return $u !== null;
    }
    
    public function isCo($id)
    {
      $u = User::model()->find(array(
        'condition' => 'role = :r AND id != :id',
        'params' => array(
          ':r' => $this->role,
          ':id' => $this->id,
        ),
      ));
      
      return $u !== null;
    }
    
    public function gradeLink()
    {
      $u = User::model()->findByPk(Yii::app()->user->id);
      
      if ($u->id == $this->id)
        return Yii::app()->createUrl('grade/me', array('id' => $this->id));
      
      if ($u->isSuper($this->id))
        return Yii::app()->createUrl('grade/super', array('id' => $this->id));
      
      if ($u->isUnder($this->id))
        return Yii::app()->createUrl('grade/under', array('id' => $this->id));
      
      if ($u->isCo($this->id))
        return Yii::app()->createUrl('grade/co', array('id' => $this->id));
    }
    
    public function calcScore($e)
    {
      $gs = Grade::model()->findAll(array(
        'condition' => 'user_obj = :u AND evaluation = :e',
        'order' => 'grade ASC',
        'params' => array(':u' => $this->id, ':e' => $e),
      ));
      
      if (!count($gs))
        return null;
      
      $median = round(count($gs) / 2);
      return $gs[$median - 1]->grade;
    }
}
