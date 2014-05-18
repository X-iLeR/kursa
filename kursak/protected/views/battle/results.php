<?php
/* @var $this BattleController
 * @var $results BattleResults
 */

$this->breadcrumbs=array(
	'Battle'=>array('/battle'),
	'Results',
);
?>
<h1>Результаты боя</h1>
<div class="battle-results">
    <p class="time"><span>Продолжительность</span>
        <?php echo
            date('H:i:s', $results->battle->time_begin) .
            ' - ' .
            date('H:i:s', $results->battle->time_end) .
            ' ( ' . Helpers::secs_to_str(
                $results->battle->time_end - $results->battle->time_begin
            ) . ' )'; ?>
    </p>
    <p class="users"><span>Между</span>
        <?php echo $results->battle->user10->name . ' и ' . $results->battle->user20->name; ?>
    </p>
    <p class="damage"><span>Нанесено урона: </span>
        <?php echo $results->damage1 . ' / ' . $results->damage2; ?>
    </p>
    <p class="hits"><span>Нанесено ударов: </span>
        <?php echo $results->hits1 . ' / ' . $results->hits2; ?>
    </p>
    <p class="evades"><span>Уклонений от удара: </span>
        <?php echo $results->evade1 . ' / ' . $results->evade2; ?>
    </p>
    <p class="winner"><span>Победитель: </span>
        <?php echo $results->battle->winner0->name;?>
    </p>
</div>