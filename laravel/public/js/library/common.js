$(document).ready(function(){

    // Accordian
    $('.accd-dt').click(function(){ 
        var duration = 250;
        $('.accd-dt').find('i').removeClass('fa-chevron-up');
        $('.accd-dd').slideUp(duration);
        
        var dd = $(this).next('.accd-dd');
        if (dd.is(':hidden')) {
            dd.slideDown(duration);
            $(this).find('i').addClass('fa-chevron-up');
        } else {
            dd.slideUp(duration);
            $(this).find('i').addClass('fa-chevron-down');
        }
    });

});



