<?php
/* @var $this BattleController
 * @var $battle Battle
 * @var $last_turn Turn
 * @var $turn array
 */

$this->breadcrumbs=array(
    'Battle',
);
$user_id = Yii::app()->user->id;
$user1 = $battle->user10;
$user2 = $battle->user20;

$user = ($user1->id == $user_id) ? $user1 : $user2;
$opponent = ($user1->id == $user_id) ? $user2 : $user1;

?>

<div class="center-block">

    <div id="user_block1" class="col-md-3 col-xs-5">
        <h2><?php echo $user->name;?></h2>
        <h4><?php echo"Уровень: " . $user->lvl;?></h4>
        <h4><?php echo"Жизни: " . $user->hp . "/" . $user->getmaxHp();?></h4>
        <p>
            <?php echo "Сила: " . $user->strenght . "<br>";
            echo "Выносливость: " .  $user->stamina. "<br>";
            echo "Ловкость: " . $user->agility . "<br>";
            echo "Интуиция: " . $user->intuition . "<br>";
            ?>
        </p>
    </div>

    <div id="user_block2" class="col-md-3 col-xs-5 col-xs-offset-2 col-md-offset-0">

        <h2><?php echo $opponent->name;?></h2>
        <h4><?php echo"Уровень: " . $opponent->lvl;?></h4>
        <h4><?php echo"Жизни: " . $opponent->hp . "/" . $opponent->getmaxHp();?></h4>
        <p>
            <?php echo "Сила: " . $opponent->strenght . "<br>";
            echo "Выносливость: " .  $opponent->stamina. "<br>";
            echo "Ловкость: " . $opponent->agility . "<br>";
            echo "Интуиция: " . $opponent->intuition . "<br>";
            ?>
        </p>
    </div>

    <div id="battle_actions_block" class="col-xs-12 col-md-5">
        <form method="post">
            
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id;?>">
            <input type="hidden" id="time_begin" name="time_begin" value="<?php echo $battle->time_begin;?>">
            
            <input type="hidden" id="user1_name" value="<?php echo $battle->user10->name;?>">
            <input type="hidden" id="user2_name" value="<?php echo $battle->user20->name;?>">
    <?php if (!empty ($last_turn) ): ?>
            <input type="hidden" id="last_turn_id" value="<?php echo $last_turn->id;?>">
            <input type="hidden" id="user1_defense" value="<?php echo $last_turn->defense1;?>">
            <input type="hidden" id="user2_defense" value="<?php echo $last_turn->defense2;?>">
            <input type="hidden" id="user1_attack" value="<?php echo $last_turn->attack1;?>">
            <input type="hidden" id="user2_attack" value="<?php echo $last_turn->attack2;?>">
            <input type="hidden" id="user1_damage" value="<?php echo $last_turn->damage1;?>">
            <input type="hidden" id="user2_damage" value="<?php echo $last_turn->damage2;?>">
    <?php endif; ?>
            <div class="col-xs-4 attack-choices">
                <div class="AttOrDef">Атака</div>
                <div class="action-choice">
                    <label for="attack1">Голова</label>
                    <input type="radio" id="attack1" name="attack" value="1"
                        <?php Helpers::echoIfTrue('checked="checked"' ,$turn['attack'] == 1); ?>>
                </div>
                <div class="action-choice">
                    <label for="attack2">Грудь</label>
                    <input type="radio" id="attack2" name="attack" value="2"
                        <?php Helpers::echoIfTrue('checked="checked"' ,$turn['attack'] == 2); ?>>
                </div>
                <div class="action-choice">
                    <label for="attack3">Живот</label>
                    <input type="radio" id="attack3" name="attack" value="3"
                        <?php Helpers::echoIfTrue('checked="checked"' ,$turn['attack'] == 3); ?>>
                </div>
                <div class="action-choice">
                    <label for="attack4">Ноги</label>
                    <input type="radio" id="attack4" name="attack" value="4"
                        <?php Helpers::echoIfTrue('checked="checked"' ,$turn['attack'] == 4); ?>>
                </div>
            </div>
            <div id="choice_submit" class="col-xs-2 padding-no">
                <input type="submit" id="moveSubmit" name="moveSubmit" value="Submit">
            </div>
            <div class="col-xs-6 defense-choices">
                <div class="AttOrDef">Защита</div>
                <div class="action-choice">
                    <label for="defense1">Голова и грудь</label>
                    <input type="radio" id="defense1" name="defense" value="1"                          <?php Helpers::echoIfTrue('checked="checked"' ,$turn['defense'] ==  1); ?>>
                </div>
                <div class="action-choice">
                    <label for="defense2">Грудь и живот</label>
                    <input type="radio" id="defense2" name="defense" value="2"                          <?php Helpers::echoIfTrue('checked="checked"' ,$turn['defense'] ==  2); ?>>
                </div>
                <div class="action-choice">
                    <label for="defense3">Живот и ноги</label>
                    <input type="radio" id="defense3" name="defense" value="3"                          <?php Helpers::echoIfTrue('checked="checked"' ,$turn['defense'] ==  3); ?>>
                </div>
                <div class="action-choice">
                    <label for="defense4">Ноги и голову</label>
                    <input type="radio" id="defense4" name="defense" value="4"                          <?php Helpers::echoIfTrue('checked="checked"' ,$turn['defense'] ==  4); ?>>
                </div>
            </div>
        </form>
    </div>

</div>

<!--<div class="panel-footer clear" id="system_chat_block">
    <h2 class="center-block text-center">Системный чат: </h2>
    <div id="system_chat" class="col-xs-12">
        <p>&nbsp;</p>
    </div>
</div>-->


<script type="javascript">
    text2chat(damage_text('van9', 'голова', 9));
    text2chat(damage_text('van0', 'голова', 0));
</script>