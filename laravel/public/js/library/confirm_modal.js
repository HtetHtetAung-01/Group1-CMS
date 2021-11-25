$(document).ready(function(){
	$('.btn-show-modal').on('click', function(){
		$('#'+$(this).data('modal')).fadeIn('slow');
	})
	$('span.modal-close').on('click', function(){
		$('.modal').fadeOut('slow');
	})
	$('button.modal-close').on('click', function(){
		$('.modal').fadeOut('slow');
	})
	$(window).on('click', function(event){
		if (jQuery.inArray( event.target, $('.modal') ) != "-1") {
        	$('.modal').fadeOut('slow');
    	}
	})

})

