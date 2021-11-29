
/**
 * Side bar component clicked and set active
 */
$('aside ul li').click(function(){
  $(this).addClass("active").siblings().removeClass("active");
});
