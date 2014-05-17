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