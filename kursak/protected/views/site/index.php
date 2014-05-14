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
    <div class="user-attributes">

        <p>Сила:        <?php echo $user->strenght ;?>      <a id="strength_add" class="parameter-add">&nbsp;</a> </p>
        <p>Выносливость <?php echo $user->stamina ;?>       <a id="stamina_add" class="parameter-add">&nbsp;</a></p>
        <p>Ловкость:    <?php echo $user->agility ;?>       <a id="agility_add" class="parameter-add">&nbsp;</a></p>
        <p>Интуиция:    <?php echo $user->intuition ;?>     <a id="intuition_add" class="parameter-add">&nbsp;</a></p>

    </div>
</div>