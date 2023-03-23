$(document).ready(function(){
  $("ul.topnav .but, ul.subnav li").hover(function() { 
    $(this).children("ul.subnav").stop(true, true).delay(300).fadeIn(300); 
    $(this).hover(function() {}, function(){
      $(this).children("ul.subnav").stop(true, true).delay(300).fadeOut(400); 
    });
  });
});