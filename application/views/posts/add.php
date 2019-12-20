<?php $this->load->view("temps/header"); ?>

<!-- start Add new Post page -->
<div class="container">
	
	<div class="row">
		
		<div class="col-12 col-md-6 offset-md-3" id="add_post">
			<h2 class="text-center">Add New Post</h2>
			<form class="form-horizontal" action="<?= base_url()?>Posts/insert_post" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label>Enter your text</label>
					<textarea cols="16" rows="12" name="body" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<label>Attach Image</label>
					<input type="file" name="image" class="form-control">
				</div>
				<?php 
			        echo "<span class='text-danger'>". $this->session->flashdata("post_empty")."</span>";
			    ?>
			    <div class="form-group">
				  	<input type="submit" class="btn btn-success" value="Register Now" name="submit">		    	
			    </div>

			</form>
			<p class="lead"></p>
		</div>
	</div>

</div>

<?php $this->load->view("temps/footer"); ?>