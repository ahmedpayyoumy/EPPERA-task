<?php $this->load->view("temps/header"); ?>

<!-- start Add new Post page -->
<div class="container">
	
	<div class="row">
		
		<div class="col-12 col-md-6 offset-md-3" id="edit_post">
			<h2 class="text-center">Edit Post</h2>
			<form class="form-horizontal" action="<?= base_url()?>Posts/update_post" method="POST" enctype="multipart/form-data">
				<?php foreach ($post_data->result() as $row) { ?>
					
				<div class="form-group">
					<label>your text</label>
					<textarea cols="16" rows="12" name="body" class="form-control"><?= $row->body;?></textarea>
				</div>
				<div class="form-group">
					<label>Attach Image</label>
					<input type="file" name="image" class="form-control">
				</div>
				<?php if ($row->image != "") { ?>
					<img src="<?=base_url()?>assets/uploads/posts/<?=$row->image?>" class="img img-responsive" width="100%" style="margin-bottom: 30px;">
					<input type="hidden" name="post_image" value="<?=$row->image?>">
				<?php } ?>
				<?php 
			        echo "<span class='text-danger'>". $this->session->flashdata("post_empty")."</span>";
			    ?>
			    <input type="hidden" name="post_id" value="<?= $row->id; ?>">
			    <div class="form-group">
				  	<input type="submit" class="btn btn-success" value="Update Post" name="submit">		    	
			    </div>
				<?php } ?>
			</form>
			<p class="lead"></p>
		</div>
	</div>

</div>

<?php $this->load->view("temps/footer"); ?>