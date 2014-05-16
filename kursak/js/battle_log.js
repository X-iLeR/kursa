/**
 * Created by x-iler on 16.05.14.
 */


function damage_text(user, attack, damage){

  var result;
    result ='<em>' + user + '</em>' + ' ударил противника в ' + '<span class="text-warning  bold">' +attack + '</span>';
    if(damage == 0){
        result += ', но тот <span class="text-warning  bold"> защитился </span> от удара';
    }
    else {
        result += ' и нанес ' + '<span class="text-danger">' + damage + '</span> урона';
    }
    return result;
}

function text2chat (text){
    var chat_top = $('#system_chat').first();
    chat_top.append('<p class="chat-message>"' + text + '</p>');
}