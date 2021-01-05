$(document).ready(function(){
    $('.reply').find('a').click(function(e){
        let data_id = $(this).attr('data-id');
        e.preventDefault();

        if($(this).hasClass('active_reply')){
            $(this).removeClass('active_reply');
            $('#reply-'+data_id).slideUp();
        }else {
            $('.comment-reply-input').slideUp();
            $('.reply').find('a').removeClass('active_reply');
            $(this).addClass('active_reply');
            $('#reply-'+data_id).slideDown();
        }
    })
})