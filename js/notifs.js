$(document).ready(function(){
    setInterval(getNotifs,5000);
});
function getNotifs(){
    $.ajax({
        method: 'POST',
        url: 'notifs.php',
        data: {'notifs':1}
    }).done(function(data){
        $('#notifications').children().remove();
        $('#notifications').html(data);
        //count unread notifications
        $('.notifs').ready(function(){
            var unread = $('.notifs').length - $('.read').length;
            $('.badge').val(unread);
        });
    });
}