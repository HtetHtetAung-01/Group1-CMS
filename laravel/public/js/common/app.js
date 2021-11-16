$('.menu-btn').click(function(){
  $('aside ul .menu-show').toggleClass("show");
  $('aside ul .first').toggleClass("rotate");
});

$('.serv-btn').click(function(){
  $('aside ul .serv-show').toggleClass("show1");
  $('aside ul .second').toggleClass("rotate");
});

$('aside ul li').click(function(){
  $(this).addClass("active").siblings().removeClass("active");
});

$('.list').click(function(){
  $('.list').toggleClass("recent");
  $(this).addClass("recent").siblings().removeClass("recent");
});