<?php $this->load->view("temps/header"); ?>

<div class="container">
	<div class="row">

		<!-- get the user posts and display them -->
		<div class="col-md-8 offset-md-2" id="yours">
			<div class="col-12" style="display: flex;margin-bottom: 25px;">
				<div class="col-6"><h3>Posts</h3></div>
				<div class="col-6"><a href="<?= base_url()?>Posts" class="btn btn-primary">Add new Post</a></div>
			</div>

			<div id="posts_wrapper">
				<?php
				if($posts->num_rows() > 0){
			        foreach ($posts->result() as $post) { ?>
			            <div class="jumbotron">
			                <h4><?=$post->user?></h4>
			                <ul class="list-unstyled bar <?php if($_SESSION['user'] == $post->user){echo "controls";} ?>">
			                    <li><a href="base_url()Posts/edit_post?id=$post->id">Edit post</a></li>
			                    <li><a href="base_url()Posts/delete_post?id=$post->id">Delete post</a></li>
			                </ul>

			                <?php if ($post->body != "") { ?>
			                    <p class="lead"><?=$post->body?></p>
			                <?php }
			                if ($post->image != "") { ?>
			                    <img src="<?=base_url()?>assets/uploads/posts/<?=$post->image?>" alt="<?=$post->body?>" width="100%">
			                <?php } ?>
			            </div>
			        <?php }
			    } else{ ?>
			        <div class='alert alert-info'>You Don't have any posts yet.</div>
			    <?php }  ?>

			    
				
			</div>
		</div>

	</div>
</div>

<?php $this->load->view("temps/footer"); ?>