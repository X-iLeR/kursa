<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$user = User::model()->findByPk( Yii::app()->user->id);
?>

<div class="col-xs-3">
    <h2><?php echo $user->name;?></h2>
    <h3><?php echo "Жизни: " .  $user->hp . "/" . $user->getmaxHp();?></h3>
    <h4><?php echo"Уровень: " . $user->lvl;?></h4>
    <h4><?php echo"Опыта: " . $user->exp;?></h4>
    <p>
        <?php echo "Сила: " . $user->strenght . "<br>";
        echo "Выносливость: " .  $user->stamina . "<br>";
        echo "Ловкость: " . $user->agility . "<br>";
        echo "Интуиция: " . $user->intuition . "<br>";
        ?>
        </p>
