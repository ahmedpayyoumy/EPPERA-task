<div id="postList">
    <?php if(!empty($posts)){ foreach($posts as $post){ ?>
        <div class="list-item">
            <h2><?php echo $_SESSION['user']; ?></h2>
            <p><?php echo $post['body']; ?></p>
        </div>
    <?php } ?>
        <div class="load-more" value="<?php echo $post['id']; ?>" style="display: none;">
            <img src="<?php echo base_url('assets/images/loading.gif'); ?>"/> Loading more posts...
        </div>
    <?php } ?>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(window).scroll(function(){
        var numItems = $('.list-item').length;
        if(($(window).scrollTop() == $(document).height() - $(window).height())){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url("Home/load_more"); ?>',
                data:{'counter':numItems},
                beforeSend:function(){
                    $('.load-more').show();
                },
                success:function(html){
                    $('.load-more').remove();
                    $('#postList').append(html);
                }
            });
        }
    });
});
</script>