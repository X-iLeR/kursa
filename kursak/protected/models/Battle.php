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
    const DEFAULT_XP = 10;
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
			array('user1', 'required'),
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

    /**
     * Возвращает текущую битву, в которой участвует игрок
     * либо false если игрок вне битвы
     * @param int $user_id  id игрока
     * @return bool|Battle
     */
    public static function getActiveBattle($user_id) {
        $activeBattle =  Battle::model()->find(
            'time_end IS NULL AND
             time_begin IS NOT NULL AND
              (user1=:user_id OR user2=:user_id)',
            array("user_id" => $user_id));
        if(empty($activeBattle)) {
            return false;
        }
        return $activeBattle;
    }

    /**
     * Возвращает лобби битвы, которую создал игрок
     * либо false если игрок вне лобби
     * @param int $user_id  id игрока
     * @return bool|Battle
     */
    public static function getBattleLobby($user_id) {
        $lobby = Battle::model()->find(
            'time_begin IS NULL AND
             user1=:user1',
            array('user1' => $user_id));
        if(empty($lobby)) {
            return false;
        }
        return $lobby;
    }

    /**
     * Задаёт начало битвы при принятии игроком вызова
     * либо false если Battle не сохранён в БД
     * Вызывает исключение при передаче нечисловых id или в случае их совпадения
     * @thows InvalidArgumentException
     * @param int $user1  id создателя лобби
     * @param int $user2  id противника
     * @return bool|Battle
     */
    public static function acceptBattle ($user1, $user2) {
        if (is_numeric($user1) && is_numeric($user2) && $user1 != $user2) {
            $battle = Battle::model()->find(
                'user1=:user1 AND
                 user2=:user2 AND
                 time_begin IS NULL
                  ORDER BY id DESC',
                array(
                    'user1' => $user1,
                    'user2' => $user2
                )
            );
            $battle->time_begin = time();
            if ($battle->validate() && $battle->save()) {
                return $battle;
            }
            return false;
        } else {
            throw new InvalidArgumentException;
        }
    }

    public function isActive() {
        if(
            !empty($this->user10) &&
            !empty($this->user20) &&
            !empty($this->time_begin) &&
            empty($this->time_end)
        ) {
            return true;
        }
        return false;
        }

    public function getUserNumber($user_id) {
        if ($user_id == $this->user1) {
            return 1;
        } elseif ($user_id == $this->user2) {
            return 2;
        } else {
            return false;
        }
    }

    public function setWinnerById($winner_id) {
        if(!is_numeric($winner_id)) {
            throw new InvalidArgumentException;
        }
        if ($winner_id == $this->user1) {
            $winner = $this->user10;
        } elseif ($winner_id == $this->user2) {
            $winner = $this->user20;
        } else {
            $winner = User::model()->findByPk($winner_id);
        }
        if (!empty($winner) ) {
            $this->setWinner($winner);
        } else {
            throw new InvalidArgumentException;
        }
    }

    public function setWinner(User $winner) {
        if(empty ($winner)) {
            throw new InvalidArgumentException;
        }
        $this->setIsNewRecord(false);
        $winner->addExp(Battle::DEFAULT_XP);
        $this->winner0 = $winner->id;
        $this->time_end = time();
        $this->save();
    }

    public function setWinnerByNumber($number) {
        if (empty($number) || !in_array($number, array(1,2) ) ) {
            throw new InvalidArgumentException;
        }
        if($number == 1) {
            $this->setWinner($this->user10);
        } else {
            $this->setWinner($this->user20);
        }
        $this->save();
    }

    public static function findLobbies() {
        $battles = Battle::model()->findAll('time_begin IS NULL');
        if (empty ($battles))
            $battles = array();
        return $battles;
    }

}
