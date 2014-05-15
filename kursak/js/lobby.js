/**
 * Created by shikon on 12.05.14.
 */
$().ready(function() {

    var user_id = $('#user1_id').val();
    checkOpponent(user_id)

});

var checkOpponent = function(user_id) {
    if ($('#time_begin') != null && $('#time_begin').val() != true) {
        $.ajax({
            url: "/battle/checkOpponent/"+user_id,
            type: 'POST',
            data: {
                ajax: 'ajax'
            }
        }).success(function(data) {
            var response = JSON.parse(data);
            if(undefined !== typeof response && response['user2'] != 'false') {
               addOpponent(response['user2']);
               console.log(response['user2']);
            } else {
                console.log('Waiting for opponent...');
                setTimeout(function() {checkOpponent(user_id)}, 10000);
            }
            $( this ).addClass( "success" );
//            window.location.reload();
        }).error(function() {
            $( this ).addClass( "error" );
            setTimeout(function() {checkOpponent(user_id)}, 10000);
        }).done(function() {
            $( this ).addClass( "done" );
        });

    }
}

var addOpponent = function(opponent) {
    var $tbody = $('#lobby_guests_tbody');
    var td_id_prefix = 'lobby_guests_' + opponent['id'] + '_';
    var $tr = $('<tr class="lobby_guests_row" id="lobby_guests_row_' + opponent['id'] + '">' +
        '</tr>');
    $tr.append('<td id="' + td_id_prefix + 'name">' + opponent['name'] + '</td>');
    $tr.append('<td id="' + td_id_prefix + 'lvl">' + opponent['lvl'] + '</td>');
    $tr.append('<td id="' + td_id_prefix + 'str">' + opponent['strenght'] + '</td>');
    $tr.append('<td id="' + td_id_prefix + 'sta">' + opponent['stamina'] + '</td>');
    $tr.append('<td id="' + td_id_prefix + 'agi">' + opponent['agility'] + '</td>');
    $tr.append('<td id="' + td_id_prefix + 'int">' + opponent['intuition'] + '</td>');
    $tr.append(
        '<td id="' + td_id_prefix + 'accept" ' +
        'class="accept_opponent" ' +
        'data-user="' + opponent['id'] + '" >' +
        '<a class="btn btn-default" href="/battle/acceptOpponent/' + opponent['id'] + '" >Принять вызов</a>' +
           '<span class="join-result-ico">&nbsp;</span></td>'
    );
    $tbody.append($tr);
}