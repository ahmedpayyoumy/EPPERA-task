<!DOCTYPE html>
<html>
<head>
	<!-- Specify the title of the page from PHP controller -->
	<title><?= $title; ?></title>

	<!-- Styling link for Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- start meta tags -->
	<meta charset="utf-8">
	<meta name="keywords" content="HTML, CSS, PHP, Codeigniter, eappera">
	<meta name="description" content="this is the task for EAPPERA company from Ahmed Payyoumy">
	<meta name="author" content="Ahmed Payyoumy">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/css/main.css">
	
</head>
<body>

	<!-- Navbar section start -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">EAPPERA</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="<?= base_url()?>">Home <span class="sr-only">(current)</span></a>
	      </li>
	      <!-- <li class="nav-item">
	        <a class="nav-link" href="#">Posts</a>
	      </li> -->
	      <?php if (isset($_SESSION['user'])){ ?>
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Settings
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="<?= base_url()?>Home/edit_user">Edit profile</a>
	          <a class="dropdown-item" href="<?= base_url()?>Home/delete_user">Delete profile</a>
	          <div class="dropdown-divider"></div>
	          <a class="dropdown-item" href="<?= base_url()?>Home/logout">logout</a>
	        </div>
	      </li>
	  <?php } ?>
	    </ul>
	  </div>
	</nav>
	<!-- navbar section ended -->

