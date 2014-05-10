<?php

/**
 * This is the model class for table "battle".
 *
 * The followings are the available columns in table 'battle':
 * @property integer $id
 * @property integer $user1
 * @property integer $user2
 * @property integer $time_begin
 * @property integer $time_end
 * @property integer $winner
 *
 * The followings are the available model relations:
 * @property User $winner0
 * @property User $user10
 * @property User $user20
 */
class Battle extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'battle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user1, user2, time_begin', 'required'),
			array('user1, user2, time_begin, time_end, winner', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user1, user2, time_begin, time_end, winner', 'safe', 'on'=>'search'),
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
			'winner0' => array(self::BELONGS_TO, 'User', 'winner'),
			'user10' => array(self::BELONGS_TO, 'User', 'user1'),
			'user20' => array(self::BELONGS_TO, 'User', 'user2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user1' => 'User1',
			'user2' => 'User2',
			'time_begin' => 'Time Begin',
			'time_end' => 'Time End',
			'winner' => 'Winner',
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
		$criteria->compare('user1',$this->user1);
		$criteria->compare('user2',$this->user2);
		$criteria->compare('time_begin',$this->time_begin);
		$criteria->compare('time_end',$this->time_end);
		$criteria->compare('winner',$this->winner);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Battle the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
