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
<div class="col-xs-3">
<h2><?php echo $user->name;?></h2>
<h4><?php echo"Уровень: " . $user->lvl;?></h4>
<h4><?php echo"Опыта: " . $user->exp;?></h4>
<p>
<?php echo "Сила: " . $user->strenght . "<br>";
echo "Выносливость: " .  $user->stamina. "<br>";
echo "Ловкость: " . $user->agility . "<br>";
echo "Интуиция: " . $user->intuition . "<br>";
?>
</p>
</div>
<div class="col-xs-6">
<form method="post">
    <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id;?>">
    <input type="hidden" id="time_begin" name="time_begin" value="<?php echo $battle->time_begin;?>">
    <div class="col-xs-5">
        <label for="attack1">Голова</label>
        <input type="radio" id="attack1" name="attack" value="1" checked="<?php Helpers::echoBool($turn['attack'] == 1); ?>">
        <input type="radio" id="attack2" name="attack" value="2" checked="<?php Helpers::echoBool($turn['attack'] == 2); ?>">
        <input type="radio" id="attack3" name="attack" value="3" checked="<?php Helpers::echoBool($turn['attack'] == 3); ?>">
        <input type="radio" id="attack4" name="attack" value="4" checked="<?php Helpers::echoBool($turn['attack'] == 4); ?>">
    </div>
    <div class="col-xs-2">
        <input type="submit" id="moveSubmit" name="moveSubmit" value="Submit">
        </div>
    <div class="col-xs-5">
        <input type="radio" id="defense1" name="defense" value="1" checked="<?php Helpers::echoBool($turn['defense'] == 1); ?>">
        <input type="radio" id="defense2" name="defense" value="2" checked="<?php Helpers::echoBool($turn['defense'] == 2); ?>">
        <input type="radio" id="defense3" name="defense" value="3" checked="<?php Helpers::echoBool($turn['defense'] == 3); ?>">
        <input type="radio" id="defense4" name="defense" value="4" checked="<?php Helpers::echoBool($turn['defense'] == 4); ?>">
    </div>

</form>
</div>
    <div class="col-xs-3">
<h2><?php echo $opponent->name;?></h2>
<h4><?php echo"Уровень: " . $opponent->lvl;?></h4>
<h4><?php echo"Опыта: " . $opponent->exp;?></h4>
<p>
    <?php echo "Сила: " . $opponent->strenght . "<br>";
    echo "Выносливость: " .  $opponent->stamina. "<br>";
    echo "Ловкость: " . $opponent->agility . "<br>";
    echo "Интуиция: " . $opponent->intuition . "<br>";
    ?>
</p>
</div>
</div>