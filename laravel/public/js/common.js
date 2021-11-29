/**
 * assignment tab to show content
 */
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
  
  // Auto-click the first tab by default
  $('.tab-nav li:first-child').click();

  // Accordian for Comment
  $('.accd-li.comment .accd-dt').click(function(){
     
    var duration = 250;
    $('.accd-dd').slideUp(duration);
    
    var dd = $(this).next('.accd-dd');
    if (dd.is(':hidden')) {
        dd.slideDown(duration);
        $(this).find('p').html('Hide Comments<i>&#xf077;</i> ');
      } else {
        dd.slideUp(duration);
        $(this).find('p').html('Show Comments<i>&#xf078;</i>');
    }
  });

})