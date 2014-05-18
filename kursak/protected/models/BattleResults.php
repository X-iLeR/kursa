<?php
/**
 * Created by PhpStorm.
 * User: shikon
 * Date: 18.05.14
 * Time: 18:41
 */

/**
 * @property int $battle_id
 * @property Battle $battle
 * @property User $user1
 * @property User $user2
 * @property int $damage1
 * @property int $damage2
 * @property int $hits1
 * @property int $hits2
 * @property int $evade1
 * @property int $evade2
 * @property Turn[] $turns
 */
class BattleResults {

    public $battle_id;
    public $battle;
    public $user1;
    public $user2;
    public $damage1;
    public $damage2;
    public $hits1;
    public $hits2;
    public $evade1;
    public $evade2;
    public $turns;

    public function process() {
        if ($this->battle_id) {

            if(empty ($this->battle) || $this->battle_id != $this->battle->id ) {
               $this->battle = Battle::model()->findByPk($this->battle_id);
           }

            if(empty ($this->battle)) {
                return $this;
            }

            $this->turns = $this->battle->getTurns();
            $this->damage1 = 0;
            $this->damage2 = 0;
            $this->hits1 = 0;
            $this->hits2 = 0;
            $this->evade1 = 0;
            $this->evade2 = 0;


        } else {
            throw new UnexpectedValueException("Нужно указать battle_id прежде чем находить результаты боя");
        }


        return $this;
    }

} 