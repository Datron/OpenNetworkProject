
$(document).ready(function(){
  $('.settingsPopover').popover({ 
    html : true,
    content: function() {
      return $('#popover_content').html();
    },
    container: '.well-ff'
  });
});
$(document).ready(function(){
    $.ajax({
            method: 'POST',
            url: 'notifs.php',
            data: {'notifs':1}
        }).done(function(data){
            $('#notifications').html(data);
        });
});
$(document).ready(function(){
    $('.notifsPopover').popover({ 
      html : true,
      content: function() {
        return $('#notifications').html();
      },
      container: '.well-ff'
    });
  });
$(document).ready(function(){
    //special init for feed refresh
    if ($(window).width() < 1031)
           {
           $(".nav-sidebar").css("display","none");
            $(".navMenu").css("visibility","visible");
            $("#nav-menu-button").css("visibility","visible");
            $(".tabs").css("display","block");
            $(".mynav").css("display","none");
            $(".mainNav").css("height","120px");
           }
        else
            {
            $(".nav-sidebar").css("display","block");
            $(".navMenu").css("visibility","hidden");
            $("#nav-menu-button").css("visibility","hidden");
            $(".tabs").css("display","none");
            $(".mynav").css("display","block");
            $(".mainNav").css("height","60px");
            }
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
    if ($(window).width()  > 1000)
        {
         $(".navMenu").css("visibility","hidden");
         $("#nav-menu-button").css("visibility","hidden");
        }
    else
        $(".nav-sidebar").css("display","none");
    
    
    $(window).resize(function(){
       if ($(window).width() < 1031)
           {
           $(".nav-sidebar").css("display","none");
            $(".navMenu").css("visibility","visible");
            $("#nav-menu-button").css("visibility","visible");
            $(".tabs").css("display","block");
            $(".mynav").css("display","none");
            $(".mainNav").css("height","120px");
           }
        else
            {
            $(".nav-sidebar").css("display","block");
            $(".navMenu").css("visibility","hidden");
            $("#nav-menu-button").css("visibility","hidden");
            $(".tabs").css("display","none");
            $(".mynav").css("display","block");
            $(".mainNav").css("height","60px");
            }
    });
    $(".tab-content").css("visibility","hidden");
    //making the navbar scroll with the page
    $(window).scroll(function(){
        var scroll = $(this).scrollTop();
        var topDist = $(".welcome-msg").position();
        if ($(this).scrollTop() > topDist.top)
            $(".mainNav").css({"position":"fixed","top":"0"});
        else
              $(".mainNav").css({"position":"static","top":"0"});
        });
    
    $("#navClose").on("click touchstart", function(){
        var menu = document.getElementById("nav-menu");
        TweenLite.to(menu, 0.5, {width:"0"});
    });
    $("#nav-menu-button").on("click touchstart", function() {
        var menu = document.getElementById("nav-menu");
        TweenLite.to(menu, 0.5, {width:width});
    });
    
    /*Tab selection */
    $(".col-lg-3").on("click", function(){
        $(".col-lg-3").removeClass('active');
        var title = $(this).attr("title");
        switch (title){
            case 'feed':
                $(".tab-content").css("visibility","hidden");
                $("#feed").css("display","block");
                $(".nav-sidebar").css("visibility","visible");
                break;
            case 'users':
                $(".tab-content").css("visibility","hidden");
                $("#feed").css("display","none");
                $(".nav-sidebar").css("visibility","hidden");
                $("#user").css("visibility","visible");
                break;
            case 'events':
                $(".tab-content").css("visibility","hidden");
                $("#feed").css("display","none");
                $(".nav-sidebar").css("visibility","hidden");
                $("#event").css("visibility","visible");
                break;
            case 'settings':
                $(".tab-content").css("visibility","hidden");
                $("#feed").css("display","none");
                $(".nav-sidebar").css("visibility","hidden");
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
            $(".refresh-feed").children().remove();
            $.ajax({
                method: 'POST',
                url: 'refresh_feed.php',
                data: {'refresh': 1},
                success : function(data){
                    $(".refresh-feed").append(data).hide().fadeIn('fast');
                }
            }).done(function(){
               console.log("Feed updated yet?");
            });
        });
    }); //End of submit post events
    //handling comments
        $(document).on('click', '.comment-button', function(){
        var postId = $(this).val();
        console.log(postId);
        var prev = $(this).parent().find('textarea');
        var val = $(prev).val();
        var user = $(".review-header[value='"+postId+"']").find('h2').text();
        console.log(user);
        if (val.length != 0)
            {
        $.ajax({
            method: 'POST',
            url: 'comments.php',
            data: {'post_id':postId,'content':val,'post_owner':user}
        }).done(function(){
            console.log("comment submitted");
            $(".refresh-feed").children().remove();
            $.ajax({
                method: 'POST',
                url: 'refresh_feed.php',
                data: {'refresh': 1},
                success : function(data){
                    $(".refresh-feed").append(data).hide().fadeIn('fast');
                }
            }).done(function(){
               console.log("Feed updated yet?");
            });
        });
            }
        else
            alert('comment discarded');
    });
}); // end of document.ready

