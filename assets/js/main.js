$(document).ready(function(){

    $(window).scroll(function(){
        var numItems = $('.jumbotron').length;
        console.log(numItems);
        if(($(window).scrollTop() == $(document).height() - $(window).height())){
            $.ajax({
                type:'POST',
                url:'http://localhost/jordan/Posts/load_more',
                data:{'counter':numItems},
                success:function(html){
                    $('#posts_wrapper').append(html);
                }
            });
        }
    });


});


