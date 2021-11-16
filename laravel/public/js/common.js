$(document).ready(function() {

  // Tab
  $('.tab-nav li').click(function(){
    
      if ($(this).hasClass('active')) return;

      // Reset
      $(this).parent().children('li').removeClass('active');
      var content = $(this).parent().parent()
          .find('.tab-body:first').children().removeClass('active');

      // Show Content
      $(this).addClass('active');
      $(content).eq( $(this).index()).addClass('active');
  });  

  // Accordian
  $('.accd-dt').click(function(){
     
    var duration = 250;
    $('.accd-dd').slideUp(duration);
    
    var dd = $(this).next('.accd-dd');
    if (dd.is(':hidden')) {
        dd.slideDown(duration);
        $(this).find('p').html('Hide Comment<i>&#xf077;</i> ');
      } else {
        dd.slideUp(duration);
        $(this).find('p').html('Show Comment<i>&#xf078;</i>');
    }

});

})