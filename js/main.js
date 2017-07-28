$(document).ready(function(){
    //navbar events
    var screen_width = $(window).width();
    var width;
    screen_width = screen_width * 0.3;
    if (screen_width > 200 )
            width = screen_width;
    else 
        width = "100%";
    $(".tab-content").css("visibility","hidden");
    $("#feed").css("visibility","visible");
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
    
});

