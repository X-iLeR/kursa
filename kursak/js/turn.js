/**
 * Created by shikon on 12.05.14.
 */
$().ready(function() {

   if ($('#turn_end') != null && $('#turn_end').val() == true) {
       setTimeout(function() {window.location.refresh()}, 10000);
   }

});