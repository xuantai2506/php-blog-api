$(document).ready(function(event){

	$('.comment_reply').keydown(function(e){
		let blog_id = $('#blog_id').val();
		var comment_parent_id = $(this).attr('data-id');
		let comment_reply = $(this).val();
		let key = e.which;
		if(key == 13){
			console.log(key);
			$.ajax({
			  method: "POST",
			  dataType : "json",
			  url: "?ctl=manager&act=reply",
			  data: { comment_reply: comment_reply ,blog_id : blog_id,comment_parent_id : comment_parent_id }
			})
		  	.done(function( msg ) {
		  		if(msg == 'error'){
		  			alert("MYSQL QUERRY ERROR");
		  			return ;
		  		}
		  		let html = '';
		  		if(msg['images'] != ""){
		  			html += ` 
		  				<div class="comment-reply">
	                        <div class="comment comment-avatar">
						    	<img src="media/upload/member/${msg['images']}" alt="">
						    </div>
						    <div class="comment comment-content">
						        <div class="comment-meta">
						            <span class="meta-item name">
						                <strong>${msg['name']}</strong><br>
						            </span>
						            <span class="meta-item reply">
						               <a href="#" data-id="10">reply</a>
						            </span>
						        </div>
						        <div class="comment-text">
						            ${msg['comment']}
						        </div>
						    </div>
	                    </div>
		  			`;
		  		}else {
		  			html += ` 
		  				<div class="comment-reply">
	                        <div class="comment comment-avatar">
						    	<img src="https://cheerup.theme-sphere.com/wp-content/uploads/2016/05/bella-doe.jpg" alt="">
						    </div>
						    <div class="comment comment-content">
						        <div class="comment-meta">
						            <span class="meta-item name">
						                <strong>${msg['name']}</strong><br>
						            </span>
						            <span class="meta-item reply">
						               <a href="#" data-id="100">reply</a>
						            </span>
						        </div>
						        <div class="comment-text">
						            ${msg['comment']}
						        </div>
						    </div>
	                    </div>
		  			`;
		  		}
		  		$('.comment_reply').val('');
		  		$('#reply-'+comment_parent_id).parent().append(html);
		  	})
		}
	})

	$('#comment_main').keydown(function(e){
		let blog_id = $('#blog_id').val();
		let key = e.which ;
		if(key == 13){
			let comment_main = $('#comment_main').val();
			$.ajax({
			  method: "POST",
			  dataType : "json",
			  url: "?ctl=manager&act=comment",
			  data: { comment_main: comment_main ,blog_id : blog_id }
			})
		  	.done(function( msg ) {
		  		if(msg == 'error'){
		  			alert("MYSQL QUERRY ERROR");
		  			return ;
		  		}
		  		let html = '';
		  		if(msg['images'] != ""){
		  			html += `  
		  			<div class="comment-main">
					    <div class="comment comment-avatar">
					    	<img src="media/upload/member/${msg['images']}" alt="">
					    </div>
					    <div class="comment comment-content">
					        <div class="comment-meta">
					            <span class="meta-item name">
					                <strong>${msg['name']}</strong><br>
					            </span>
					            <span class="meta-item reply">
					               <a href="#" data-id="10">reply</a>
					            </span>
					        </div>
					        <div class="comment-text">
					            ${msg['comment']}
					        </div>
					    </div>
					</div>

				    <div class="comment-reply-input" id="reply-10">
                        <form method="post">
                            <input type="text" id="" name="comment" placeholder="Nhập comment reply nào">
                        </form>
                    </div>
		  			`;
		  		}else  {
		  			html += `  
		  			<div class="comment-main">
					    <div class="comment comment-avatar">
					    	<img src="https://cheerup.theme-sphere.com/wp-content/uploads/2016/05/bella-doe.jpg" alt="">
					    </div>
					    <div class="comment comment-content">
					        <div class="comment-meta">
					            <span class="meta-item name">
					                <strong>${msg['name']}</strong><br>
					            </span>
					            <span class="meta-item reply">
					               <a href="#" data-id="100">reply</a>
					            </span>
					        </div>
					        <div class="comment-text">
					            ${msg['comment']}
					        </div>
					    </div>
					</div>

				    <div class="comment-reply-input" id="reply-100">
                        <form method="post">
                            <input type="text" id="" name="comment" placeholder="Nhập comment reply nào">
                        </form>
                    </div>
		  			`;	
		  		}
		  		$('#comment_main').val('');
		  		$('.comments').append(html);
			});
	  	}		
	});
});