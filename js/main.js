
$(document).ready(function(){
    //special init for feed refresh
    $.ajax({
            method: 'POST',
            url: 'refresh_feed.php',
            data: {'refresh': 1},
            success : function(data){
                $("#feed").children().remove();
                $("#feed").append(data).hide().fadeIn('fast');
            }
        }).done(function(){
           console.log("Feed updated yet?");
        });
    //navbar events
    var photo_set = false;
    var screen_width = $(window).width();
    var width;
    /*continue screen activities*/
    screen_width = screen_width * 0.3;
    if (screen_width > 200 )
            width = screen_width;
    else 
        width = "100%";
    
    
//    $(".tab-content").css("visibility","hidden");
    $("#navClose").on("click touchstart", function(){
        var menu = document.getElementById("nav-menu");
        TweenLite.to(menu, 0.5, {width:"0"});
    });
    $("#nav-menu-button").on("click touchstart", function() {
        var menu = document.getElementById("nav-menu");
        TweenLite.to(menu, 0.5, {width:width});
    });
    $(".col-lg-3").on("click", function(){
        $(".col-lg-3").removeClass('active');
        var title = $(this).attr("title");
        switch (title){
            case 'feed':
                $(".tab-content").css("visibility","hidden");
                $("#feed").css("visibility","visible");
                break;
            case 'users':
                $(".tab-content").css("visibility","hidden");
                $("#user").css("visibility","visible");
                break;
            case 'events':
                $(".tab-content").css("visibility","hidden");
                $("#event").css("visibility","visible");
                break;
            case 'settings':
                $(".tab-content").css("visibility","hidden");
                $("#settings").css("visibility","visible");
                break;
        }
        $(this).addClass('active');
    });
    
    
    //tag selection
    $(".tags li").click(function(){
        var tag = $(this).text();
        /*alert(tag);*/
        switch(tag) {
            case 'Pets':
                $(".jumbotron").append('<div class="tagged tag1">Pets.</div>');
                break;
            case 'Recommendations':
                 $(".jumbotron").append('<div class="tagged tag2">Recommendations.</div>');
                break;
            case 'Events':
                $(".jumbotron").append('<div class="tagged tag3">Events</div>');
                break;
            case 'Classifields':
                $(".jumbotron").append('<div class="tagged tag4">Classifields</div>');
                break;
        }
    });
    //submission
    /*$("#postarea").on("keyup", action);
    $("#postarea").on("change", action);
    function action() {
    if( $("#postarea").val().length > 0) {
        $("#submitPost").prop("disabled", false);
    } else {
        $("#submitPost").prop("disabled", true);
    }   
    }*/
    
    
    $("#submitPost").click(function(e){
        var postText = $("#postarea").val();
        /*Uploader code*/
        console.log(postText);
        if (postText.length == 0)
            {            
                alert("No text entered. Your post will be discarded");
                return;
            }
        var tagsput = [];
        $('.jumbotron').each(function(index, obj)
            {
                tagsput.push($(this).text());
            });
        console.log(tagsput);
        var postOject = {
            text: postText,
            tags: tagsput
        };
        var datata = JSON.stringify(postOject);
        $.ajax({
            method: 'POST',
            url: "post.php",
            data: postOject,
            error: function (jqXHR, exception) {
        var msg = '';
        if (jqXHR.status === 0) {
            msg = 'Not connect.\n Verify Network.';
        } else if (jqXHR.status == 404) {
            msg = 'Requested page not found. [404]';
        } else if (jqXHR.status == 500) {
            msg = 'Internal Server Error [500].';
        } else if (exception === 'parsererror') {
            msg = 'Requested JSON parse failed.';
        } else if (exception === 'timeout') {
            msg = 'Time out error.';
        } else if (exception === 'abort') {
            msg = 'Ajax request aborted.';
        } else {
            msg = 'Uncaught Error.\n' + jqXHR.responseText;
        }
                console.log(msg);
            }
        }).done(function(){
            console.log("All data sent successfully:");
        });
        $("#feed").children().remove();
        $.ajax({
            method: 'POST',
            url: 'refresh_feed.php',
            data: {'refresh': 1},
            success : function(data){
                $("#feed").append(data).hide().fadeIn('fast');
            }
        }).done(function(){
           console.log("Feed updated yet?");
        });
    });
});

