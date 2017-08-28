$(document).ready(function(){
    setInterval(getNotifs,5000);
});
function getNotifs(){
    $.ajax({
        method: 'POST',
        url: 'notifs.php',
        data: {'notifs':1}
    }).done(function(data){
        $('.notifs').remove();
        $('#notifications').html(data);
        $('#event').html(data);
        //count unread notifications
        $('.notifs').ready(function(){
            var unread = $('.notifs').length - $('.read').length;
            var unread = unread/2;
            $('.badge').html(unread);
        });
    });
}