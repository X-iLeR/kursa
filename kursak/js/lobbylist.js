/**
 * Created by shikon on 15.05.14.
 */
$().ready(function() {

    var user_id = $('#user_id').val();
    $('.lobby_list_row .join_lobby').click(function($this) {
        $el = $($this.currentTarget);
        $el.toggleClass('pending');
        $el.removeClass('success');
        $el.removeClass('error');
        tryJoin($el);
    });

});

var tryJoin = function($el) {
    if(!$el.hasClass('pending')) {
        return;
    }
    var foe_id = $el.data('user');
    var battle_id = $el.data('battle');

    $.ajax({
        url: "/battle/join/"+foe_id,
        type: 'POST',
        data: {
            ajax: 'ajax'
        }
    }).success(function(data) {
        var response = JSON.parse(data);
        if(undefined !== typeof response && response['status'] !== 'undefined') {
            var status = response['status'];
            switch (status) {
                case 'joined':
                    alert('Заявка принята');
                    break;
                case 'started':
                    window.location = '/battle';
                    break;
                case 'waiting':
                    console.log(
                        'Ждем ответа от ' +
                        $('#lobby_list_' + battle_id + '_name').text()
                    );
//                case 'another':
//                case 'closed':
                default :
                    alert('Бой отменён');
                    $el.removeClass('pending');
                    break;
            }
        } else {
            console.log('Waiting for opponent...');
        }
        $el.addClass( "success" );
    }).error(function() {
//        $el.removeClass("pending");
        $el.addClass( "error" );
    }).done(function() {
        setTimeout(function() {tryJoin($el)}, 10000);
    });

}