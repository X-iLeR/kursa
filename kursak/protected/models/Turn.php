<?php

/**
 * This is the model class for table "turn".
 *
 * The followings are the available columns in table 'turn':
 * @property integer $id
 * @property integer $battle_id
 * @property integer $attack1
 * @property integer $attack2
 * @property integer $defense1
 * @property integer $defense2
 * @property integer $damage1
 * @property integer $damage2
 * @property integer $finished
 *
 * The followings are the available model relations:
 * @property Battle $battle
 */
class Turn extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'turn';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('battle_id', 'required'),
			array('battle_id, attack1, attack2, defense1, defense2, damage1, damage2, finished', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, battle_id, attack1, attack2, defense1, defense2, damage1, damage2, finished', 'safe', 'on'=>'search'),
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
			'battle' => array(self::BELONGS_TO, 'Battle', 'battle_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'battle_id' => 'Battle',
			'attack1' => 'Attack1',
			'attack2' => 'Attack2',
			'defense1' => 'Defense1',
			'defense2' => 'Defense2',
			'damage1' => 'Damage1',
			'damage2' => 'Damage2',
			'finished' => 'Finished',
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
		$criteria->compare('battle_id',$this->battle_id);
		$criteria->compare('attack1',$this->attack1);
		$criteria->compare('attack2',$this->attack2);
		$criteria->compare('defense1',$this->defense1);
		$criteria->compare('defense2',$this->defense2);
		$criteria->compare('damage1',$this->damage1);
		$criteria->compare('damage2',$this->damage2);
		$criteria->compare('finished',$this->finished);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Turn the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public static function getCurrent($battle_id, $createIfNo = true) {
        if(!is_numeric($battle_id)) {
            throw new InvalidArgumentException;
        }
        $currentTurn = Turn::model()->find(
            'battle_id = :battle_id AND
            finished IS NULL
            ORDER BY id DESC',
            array('battle_id' => $battle_id)
        );
        if (empty ($currentTurn)) {
            if ($createIfNo) {
                $currentTurn = new Turn;
                $currentTurn->battle_id = $battle_id;
                if (!$currentTurn->validate() || !$currentTurn->save()) {
                    return false;
                }
            } else {
                return false;
            }
        }
        return $currentTurn;
    }

    public static function getLast($battle_id) {
        if(!is_numeric($battle_id)) {
            throw new InvalidArgumentException;
        }
        $currentTurn = Turn::model()->find(
            'battle_id = :battle_id AND
            finished IS NOT NULL
            ORDER BY id DESC',
            array('battle_id' => $battle_id)
        );
        if (empty ($currentTurn)) {
                return false;
        }
        return $currentTurn;
    }


}
