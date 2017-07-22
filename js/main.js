$(document).ready(function(){
    //navbar events
    $("#navClose").on("click touchstart", function(){
        var menu = document.getElementById("nav-menu");
        TweenLite.to(menu, 0.5, {width:"0"});
    });
    $("#nav-menu-button").on("click touchstart", function() {
        var menu = document.getElementById("nav-menu");
        TweenLite.to(menu, 0.5, {width:"100%"});
    });
    //make navbar visible on scroll
//    $(window).scroll(function(){
//        $('.navbar').css("background-color", "red");
//    });
});

