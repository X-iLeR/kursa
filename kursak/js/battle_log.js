/**
 * Created by x-iler on 16.05.14.
 */

function damage_text(user, attack, damage){

  var result;
    result ='<span class="text-primary">' + user + '</span>' + ' ударил противника ' + '<span class="text-warning">' +attack2bodypart(attack) + '</span>';
    if(damage == 0){
        result += ', но тот <span class="text-warning"> защитился </span> от удара';
    }
    else {
        result += ' и нанес ' + '<span class="text-danger">' + damage + ' ед.</span> урона';
    }
    return result;
}

function text2chat (text){
    var chat_top = $('#system_chat').first();
    chat_top.prepend('<p class="chat-message">' + text + '</p>');
}

function attack2bodypart (attack) {
    if (typeof  attack != 'integer') {
        attack = parseInt(attack);
    }
    switch (attack) {
        case 1:
            return 'в голову';
        case 2:
            return 'в грудь';
        case 3:
            return 'в живот';
        case 4:
            return 'по ногам';
        default :
            return 'неизвестно куда';
    }
}

$(document).ready(function() {
    var name1 = $('#user1_name').val();
    var name2 = $('#user2_name').val();
    var $dmg1 = $('#user1_damage').val();
    var $dmg2 = $('#user2_damage').val();
    var $att1 = $('#user1_attack').val();
    var $att2 = $('#user2_attack').val();
    var $def1 = $('#user1_defense').val();
    var $def2 = $('#user2_defense').val();
    var last_turn_id = $('#last_turn_id').val();
    if (last_turn_id !== undefined) {
        text2chat(damage_text(name1, $att1, $dmg1 ));
        text2chat(damage_text(name2, $att2, $dmg2 ));
    }
});