$(document).ready(function(){

     // Accordian for Assignment
     $('.accd-li.course .accd-dt').click(function(){ 
        var duration = 250;

        // Reset All
        $('.accd-dt').find('i').html('<i>&#xf078;</i>');
        $('.accd-dd').slideUp(duration);
        
        var dd = $(this).next('.accd-dd');
        if (dd.is(':hidden')) {
            dd.slideDown(duration);
            $(this).find('i').html('<i>&#xf077;</i>');
        } else {
            dd.slideUp(duration);
            $(this).find('i').html('<i>&#xf078;</i>');
        }
    });

});



