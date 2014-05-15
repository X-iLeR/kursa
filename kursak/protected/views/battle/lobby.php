<?php
/**
 *
 * @var BattleController $this
 * @var Battle $battle
 */
if(empty ($battles)) {
    $battles = array();
}
?>
<h1>Поиск боя</h1>

<form method="post" action="<?php echo Yii::app()->createUrl('battle/create'); ?>">
    <input type="submit" value="Создать лобби" name="create">
</form>
<form method="post" action="<?php echo Yii::app()->createUrl('battle/lobbyList'); ?>">
    <input type="submit" value="Найти лобби" name="submit">
</form>

<div id="lobby_guests">
    <table id="lobby_guests_table">
        <caption>Претенденты</caption>
        <thead id="lobby_guests_thead">
        <tr id="lobby_guests_thead_tr">
            <th id="lobby_guests_th_name">Персонаж</th>
            <th id="lobby_guests_th_lvl">Уровень</th>
            <th id="lobby_guests_th_str">Сила</th>
            <th id="lobby_guests_th_sta">Выносливость</th>
            <th id="lobby_guests_th_agi">Ловкость</th>
            <th id="lobby_guests_th_int">Интуиция</th>
            <th id="lobby_guests_th_join">Принять вызов</th>
        </tr>
        </thead>
        <tbody id="lobby_guests_tbody">
        <?php foreach($battles as $b):?>
            <tr class="lobby_guests_row" id="lobby_guests_row_<?php echo $b->user2;?>">
                <td id="lobby_guests_<?php echo $b->user2;?>_name"><?php echo $b->user20->name;?></td>
                <td id="lobby_guests_<?php echo $b->user2;?>_lvl"><?php echo $b->user20->lvl;?></td>
                <td id="lobby_guests_<?php echo $b->user2;?>_str"><?php echo $b->user20->strenght;?></td>
                <td id="lobby_guests_<?php echo $b->user2;?>_sta"><?php echo $b->user20->stamina;?></td>
                <td id="lobby_guests_<?php echo $b->user2;?>_agi"><?php echo $b->user20->agility;?></td>
                <td id="lobby_guests_<?php echo $b->user2;?>_int"><?php echo $b->user20->intuition;?></td>
                <td id="lobby_guests_<?php echo $b->user2;?>_accept"
                    class="accept_opponent"
                    data-user="<?php echo $b->user2;?>"
                    data-battle="<?php echo $b->id;?>"
                    >
                    <a
                        class="btn btn-default"
                        href="<?php Yii::app()->createUrl('battle/acceptOpponent/' . $b->user2 );?>"
                    >Принять вызов</a>
                    <span class="join-result-ico">&nbsp;</span>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>