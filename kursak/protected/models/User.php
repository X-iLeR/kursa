<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $name
 * @property string $pwd
 * @property integer $blocked
 * @property integer $hp
 * @property integer $strenght
 * @property integer $agility
 * @property integer $stamina
 * @property integer $intuition
 * @property integer $lvl
 * @property integer $exp
 * @property integer $is_online
 *
 * The followings are the available model relations:
 * @property Battle[] $battles
 * @property Battle[] $battles1
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
			array('name, pwd', 'required'),
			array('blocked, hp, strenght, agility, stamina, intuition, lvl, exp, is_online', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>24),
			array('pwd', 'length', 'max'=>64),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, pwd, blocked, hp, strenght, agility, stamina, intuition, lvl, exp, is_online', 'safe', 'on'=>'search'),
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
			'battles' => array(self::HAS_MANY, 'Battle', 'user1'),
			'battles1' => array(self::HAS_MANY, 'Battle', 'user2'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Введите имя героя',
			'pwd' => 'Пароль',
			'blocked' => 'Неактиивен',
			'hp' => 'Hp',
			'strenght' => 'Str',
			'agility' => 'Agi',
			'stamina' => 'Sta',
			'intuition' => 'Int',
			'lvl' => 'Lvl',
			'exp' => 'Exp',
			'is_online' => 'Online',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('pwd',$this->pwd,true);
		$criteria->compare('blocked',$this->blocked);
		$criteria->compare('hp',$this->hp);
		$criteria->compare('strenght',$this->strenght);
		$criteria->compare('agility',$this->agility);
		$criteria->compare('stamina',$this->stamina);
		$criteria->compare('intuition',$this->intuition);
		$criteria->compare('lvl',$this->lvl);
		$criteria->compare('exp',$this->exp);
		$criteria->compare('is_online',$this->is_online);

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
}
