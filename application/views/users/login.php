<?php $this->load->view("temps/header"); ?>

<!-- start sigin in page -->
<div class="container">
	
	<div class="row">
		<div class="col-12 col-md-6 offset-md-3" id="signin">
			<h2 class="text-center">Sign In</h2>
			<form class="form-horizontal" action="<?= base_url()?>Home/user_login" method="POST">
				<div class="form-group">
				    <label for="useremail">Email address</label>
				    <input type="email" name="email" class="form-control" id="useremail" aria-describedby="emailHelp">
				    <span class="text-danger"><?= form_error("email") ?></span>
			  	</div>
			  	<div class="form-group">
				    <label for="userpassword">Password</label>
				    <input type="password" name="password" class="form-control" id="userpassword">
				    <span class="text-danger"><?= form_error("email") ?></span>
			  	</div>
			  	<button type="submit" class="btn btn-primary">Submit</button>
			</form>
			<p class="lead">or, if you don't have account <b>Create one</b> from <a href="<?= base_url()?>home/signup">here</a></p>
			<?php 
                echo "<span class='text-danger' style='color:#fff'>". $this->session->flashdata("error")."</span>";
            ?>
		</div>
	</div>

</div>


<?php $this->load->view("temps/footer"); ?>