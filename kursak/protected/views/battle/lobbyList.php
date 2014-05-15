<?php
/**
 * @var Battle[] $battles
 * @var BattleController $this
 */

?>

<div id="lobby_list">
    <table class="text-center" id="lobby_list_table">
        <thead id="lobby_list_thead">
            <tr id="lobby_list_thead_tr">
                <th id="lobby_list_th_name">Персонаж</th>
                <th id="lobby_list_th_lvl">Уровень</th>
                <th id="lobby_list_th_str">Сила</th>
                <th id="lobby_list_th_sta">Выносливость</th>
                <th id="lobby_list_th_agi">Ловкость</th>
                <th id="lobby_list_th_int">Интуиция</th>
                <th id="lobby_list_th_join">Предложить поединок</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($battles as $battle):?>
            <tr class="lobby_list_row" id="lobby_list_row_<?php echo $battle->id;?>">
                <td id="lobby_list_<?php echo $battle->id;?>_name"><?php echo $battle->user10->name;?></td>
                <td id="lobby_list_<?php echo $battle->id;?>_lvl"><?php echo $battle->user10->lvl;?></td>
                <td id="lobby_list_<?php echo $battle->id;?>_str"><?php echo $battle->user10->strenght;?></td>
                <td id="lobby_list_<?php echo $battle->id;?>_sta"><?php echo $battle->user10->stamina;?></td>
                <td id="lobby_list_<?php echo $battle->id;?>_agi"><?php echo $battle->user10->agility;?></td>
                <td id="lobby_list_<?php echo $battle->id;?>_int"><?php echo $battle->user10->intuition;?></td>
                <td id="lobby_list_<?php echo $battle->id;?>_join"
                    class="join_lobby"
                    data-user="<?php echo $battle->user1;?>"
                    data-battle="<?php echo $battle->id;?>"
                >
                    <a class="btn btn-default" href="#">Предложить поединок</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

