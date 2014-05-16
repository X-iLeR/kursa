/**
 * Created by shikon on 15.05.14.
 */
$().ready(function() {
    $('.parameter-add').click(function($this) {

        var points = parseInt($('#points').text());
        var $el = $($this.currentTarget);
        var attr_points = parseInt($el.text());
        var attr = $el.attr('id');
        attr = attr.replace('_add', '');

        $.ajax({
            url: "/user/addAttribute/",
            type: 'POST',
            data: {
                ajax: 'ajax',
                attr: attr
            }
        }).done(function() {
            window.location.reload();
        });

    });

});