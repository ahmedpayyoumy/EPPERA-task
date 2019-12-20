<?php $this->load->view("temps/header"); ?>

<!-- start sigin in page -->
<div class="container">
	
	<div class="row">
		<div class="col-12 col-md-6 offset-md-3" id="signup">
			<h2 class="text-center">Edit Your Profile</h2>
			<form class="form-horizontal" action="<?= base_url()?>Home/update_user" method="POST" enctype="multipart/form-data">
				<?php foreach ($user_info->result() as $row) { ?>
				<div class="form-group">
					<label>User Name</label>
					<input type="text" name="username" value="<?= $row->username;?>" class="form-control"   autocomplete="off">
					<span class="text-danger"><?= form_error("username") ?></span>
				</div>
				<div class="form-group">
					<label>Email Address</label>
					<input type="email" name="email" value="<?= $row->email;?>" class="form-control">
					<span class="text-danger"><?= form_error("email");?></span>
				</div>
				<div class="form-group">
					<label>Phone</label>
					<input type="number" name="phone" value="<?= $row->phone;?>" class="form-control">
					<span class="text-danger"><?= form_error("phone");?></span>
				</div>
				<div class="form-group">
					<label>Profile Image</label>
					<input type="file" name="image" class="form-control">
				</div>
				<?php if (isset($row->image)) { ?>
					<div class="form-group">
						<img class="img img-responsive" src="<?=base_url()?>assets/uploads/users/<?=$row->image?>" width="100%">
					</div>
				<?php } ?>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="pass" placeholder="Enter Your Password" class="form-control" autocomplete="off">
					<span class="text-danger"><?= form_error("pass");?></span>
				</div>
				<div class="form-group">
					<label>Confirm Password</label>
					<input type="password" name="pass2" placeholder="Enter Your Password Again" class="form-control" autocomplete="off">
					<input type="hidden" name="old_pass" value="<?= $row->password?>">
					<input type="hidden" name="old_image" value="<?= $row->image?>">
					<span class="text-danger"><?= form_error("pass2");?></span>
				</div>
			  	<input type="submit" class="btn btn-primary" value="Update Now" name="submit">
			  	<?php } ?>
			</form>
			<p class="lead"></p>
		</div>
	</div>

</div>


<?php $this->load->view("temps/footer"); ?>