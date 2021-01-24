(function( $ ) {
	'use strict';
	$(document).on('click', '.balkon-like-button', function() {
		var button = $(this);
		var post_id = button.attr('data-post-id');
		var security = button.attr('data-nonce');
		var iscomment = button.attr('data-iscomment');
		var allbuttons;
		if ( iscomment === '1' ) { /* Comments can have same id */
			allbuttons = $('.balkon-like-comment-button-'+post_id);
		} else {
			allbuttons = $('.balkon-like-button-'+post_id);
		}
		var loader = allbuttons.next('#balkon-like-loader');
		if (post_id !== '') {
			$.ajax({
				type: 'POST',
				url: _balkon_like.ajaxurl,
				data : {
					action : 'balkon_process_like',
					post_id : post_id,
					nonce : security,
					is_comment : iscomment,
				},
				beforeSend:function(){
					loader.html('<i class="fa fa-spinner fa-pulse"></i><span class="sr-only">Loading...</span>');
					button.addClass('do-process');
				},	
				success: function(response){
					var icon = response.icon;
					var count = response.count;
					allbuttons.html(icon+count);
					if(response.status === 'unliked') {
						var like_text = _balkon_like.like;
						allbuttons.prop('title', like_text);
						allbuttons.removeClass('liked');
					} else {
						var unlike_text = _balkon_like.unlike;
						allbuttons.prop('title', unlike_text);
						allbuttons.addClass('liked');
					}
					button.removeClass('do-process');
					loader.empty();					
				}
			});
			
		}
		return false;
	});
})( jQuery );
