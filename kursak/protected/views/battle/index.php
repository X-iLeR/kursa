<?php
/* @var $this BattleController
 * @var $battle Battle
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
<input type="hidden" id="user1_id" value="<?php echo $battle->user1;?>">
<input type="hidden" id="time_begin" value="<?php echo $battle->time_begin;?>">
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
<form>
    <div class="col-xs-5">
        <label for="attack1">Голова</label>
        <input type="radio" id="attack1" name="attack" value="1" checked="false">
        <input type="radio" id="attack2" name="attack" value="2" checked="false">
        <input type="radio" id="attack3" name="attack" value="3" checked="false">
        <input type="radio" id="attack4" name="attack" value="4" checked="false">
    </div>
    <div class="col-xs-2">
        <input type="submit" id="moveSubmit" name="moveSubmit" value="Submit">
        </div>
    <div class="col-xs-5">
        <input type="radio" id="defence1" name="defence" value="1" checked="false">
        <input type="radio" id="defence2" name="defence" value="2" checked="false">
        <input type="radio" id="defence3" name="defence" value="3" checked="false">
        <input type="radio" id="defence4" name="defence" value="4" checked="false">
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