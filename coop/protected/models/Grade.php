<?php

/**
 * This is the model class for table "grade".
 *
 * The followings are the available columns in table 'grade':
 * @property integer $evaluation
 * @property integer $user_sbj
 * @property integer $user_obj
 * @property double $grade
 *
 * The followings are the available model relations:
 * @property Evaluation $evaluation0
 * @property User $userSbj
 * @property User $userObj
 */
class Grade extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'grade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('evaluation, user_sbj, user_obj, grade', 'required'),
			array('evaluation, user_sbj, user_obj', 'numerical', 'integerOnly'=>true),
			array('grade', 'numerical'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('evaluation, user_sbj, user_obj, grade', 'safe', 'on'=>'search'),
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
			'evaluation0' => array(self::BELONGS_TO, 'Evaluation', 'evaluation'),
			'userSbj' => array(self::BELONGS_TO, 'User', 'user_sbj'),
			'userObj' => array(self::BELONGS_TO, 'User', 'user_obj'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'evaluation' => 'Evaluation',
			'user_sbj' => 'User Sbj',
			'user_obj' => 'User Obj',
			'grade' => 'Grade',
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

		$criteria->compare('evaluation',$this->evaluation);
		$criteria->compare('user_sbj',$this->user_sbj);
		$criteria->compare('user_obj',$this->user_obj);
		$criteria->compare('grade',$this->grade);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Grade the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
