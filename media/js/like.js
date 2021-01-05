$(document).ready(function(){
	$('.likes-count').click(function(e){
		e.preventDefault();
		let id = $(this).attr('id');
		let count = $('#number_like_'+id).html();
			
		$.ajax({
		  method: "POST",
		  url: "?ctl=manager&act=likeBlog",
		  data: { id: id ,count : count}
		})
	  	.done(function( msg ) {
		    $('#number_like_'+id).html(msg);
		});
	})
})