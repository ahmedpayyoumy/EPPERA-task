<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	// start construct function
	function __construct() {
        parent::__construct();
        $this->load->library("form_validation");
        $this->load->model("Users_model");
        $this->load->model("Posts_model");
    }

    // index loader which will be sign in page
	public function index(){
		$data['title'] = "Users Login Page";
		if (isset($_SESSION['user'])) {
			redirect(base_url()."Home/Dash");
		} else{
			$this->load->view("users/login",$data);
		}
	}

	// Sign up page loader
	public function signup(){
		$data['title'] = "Users Signup Page";
		$this->load->view("users/signup",$data);
	}

	// logic for adding new user to the system
	function create_user(){

		// check if the user comes from the form or tyying to hack
		if (isset($_POST['submit'])) {
			
			$image = '';
	        // Image Part to set up its name and upload it to the system
	        if ($_FILES['image']['name'] != "" )
	        {
	            $config['upload_path']          = './assets/uploads/users/';
	            $config['allowed_types']        = 'jpg|png|gif|jpeg';
	            
	            $this->load->library('upload', $config);
	            $this->upload->initialize($config);

	            $image_name  = $_FILES['image']['name'];
	            $tmp_name   = $_FILES['image']['tmp_name'];
	            $file_size  = $_FILES['image']['size'];
	            
	            $file_new = str_replace(' ','_',$image_name);

	            if($this->upload->do_upload('image'))
	            {
	                $image = $file_new;
	            }
	        }

	        // validation for the form to check our Rules
	        $this->form_validation->set_rules("username","User Name","required|is_unique[users.username]");
            $this->form_validation->set_rules("email","Email","required|is_unique[users.email]");
            $this->form_validation->set_rules("phone","Phone Number","required|numeric");
            $this->form_validation->set_rules("pass","Password","required");
            $this->form_validation->set_rules("pass2","Password","required|matches[pass]");

            // if the validation runs without errors
            if ($this->form_validation->run()){
            	$secured_password = sha1($this->input->post("pass"));
            	// store the user data into define_syslog_variables
            	$username 	= $this->input->post("username");
            	$email 		= $this->input->post("email");
            	$phone 		= $this->input->post("phone");

            	// data to be inserted into our database
            	$data = array(
            		"username"		=> $username,
            		"password"		=> $secured_password,
            		"email"			=> $email,
            		"phone"			=> $phone,
            		"image"			=> $image
            	);
            	$this->Users_model->add_users($data);
            	redirect(base_url());

            } else{
            	// if the form is failed
            	$this->signup();
            }

	    } else{
	    	show_404();
	    }
	}


	// logic for user login system
	function user_login(){
		$this->form_validation->set_rules("email","Email","required");
        $this->form_validation->set_rules("password","Password","required");

        if ($this->form_validation->run())
        {
            // true
            $user = $this->input->post('email');
            $password = sha1($this->input->post('password'));

            if ($this->Users_model->user_login($user,$password)) 
            {
        		$session_data = array(
                    'user' => $user
                );
                $this->session->set_userdata($session_data);
                redirect(base_url()."Home/Dash");
            }
            else
            {
                $this->session->set_flashdata('error','Invalid Username Or Password');
                redirect(base_url());
            }
        }
        else
        {
            $this->index();
        }
	}

    

	// start Dahsboard page for the home section 
	function Dash(){
		$data['title'] = "User Dashboard";
        $this->db->order_by("id","DESC");
        $data['posts'] = $this->db->get("posts",5,0);

		$user = isset($_SESSION['user'])?$_SESSION['user']:'';
		$this->load->view("users/dashboard",$data);
	}


	// users logout function
	function logout(){
        $this->session->unset_userdata("user");
        redirect(base_url());
    }

    // users Edit profile page
    function edit_user(){
    	$data['title'] = "Edit user profile";
    	$user = $_SESSION['user'];
    	$data['user_info'] = $this->Users_model->get_user($user);
    	$this->load->view("users/edit",$data);
    }


    // logic for Updating user info to the system
	function update_user(){

		// check if the user comes from the form or tyying to hack
		if (isset($_POST['submit'])) {
			
			$image = '';
	        // Image Part to set up its name and upload it to the system
	        if ($_FILES['image']['name'] != "" )
	        {
	            $config['upload_path']          = './assets/uploads/users/';
	            $config['allowed_types']        = 'jpg|png|gif|jpeg';
	            
	            $this->load->library('upload', $config);
	            $this->upload->initialize($config);

	            $image_name  = $_FILES['image']['name'];
	            $tmp_name   = $_FILES['image']['tmp_name'];
	            $file_size  = $_FILES['image']['size'];
	            
	            $file_new = str_replace(' ','_',$image_name);

	            if($this->upload->do_upload('image'))
	            {
	                $image = $file_new;
	            }
	        } else {
	        	$image = $this->input->post("old_image");
	        }

	        // validation for the form to check our Rules
	        $this->form_validation->set_rules("username","User Name","required");
            $this->form_validation->set_rules("email","Email","required");
            $this->form_validation->set_rules("phone","Phone Number","required|numeric");

            if ($this->input->post("pass") == "") {
            	$secured_password = $this->input->post("old_pass");
            } else {
                $this->form_validation->set_rules("pass","Password","required");
                $this->form_validation->set_rules("pass2","Password Confirm","required|matches[pass]");
            	$secured_password = sha1($this->input->post("pass"));
            }

            // if the validation runs without errors
            if ($this->form_validation->run()){
            	// store the user data into define_syslog_variables
            	$username 	= $this->input->post("username");
            	$email 		= $this->input->post("email");
            	$phone 		= $this->input->post("phone");
            	$user = $_SESSION['user'];

            	// data to be inserted into our database
            	$data = array(
            		"username"		=> $username,
            		"password"		=> $secured_password,
            		"email"			=> $email,
            		"phone"			=> $phone,
            		"image"			=> $image
            	);
            	$this->Users_model->update_user($user,$data);
            	redirect(base_url());

            } else{
            	// if the form is failed
            	$this->edit_user();
            }

	    } else{
	    	show_404();
	    }
	}

    function delete_user(){
        $id = $_SESSION['user'];
        $this->Users_model->delete_user($id);
        redirect(base_url()."Home/Dash");
    }




}