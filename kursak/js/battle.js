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
               console.log(response['user2']);
            } else {
                console.log('Waiting for opponent...');
                setTimeout(function() {checkOpponent(user_id)}, 5000);
            }
            $( this ).addClass( "success" );
//            window.location.reload();
        }).error(function() {
            $( this ).addClass( "error" );
            setTimeout(function() {checkOpponent(user_id)}, 5000);
        }).done(function() {
            $( this ).addClass( "done" );
        });

    }
}