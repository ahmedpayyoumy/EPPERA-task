<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library("form_validation");
        $this->load->model("Users_model");
        $this->load->model("Posts_model");	}

	function index(){
		$data['title'] = "Add New post";
		$this->load->view("posts/add",$data);
	}

    function load_more(){
        $now = $this->input->post("counter");
        $output = "";
        $this->db->order_by("id","DESC");
        $posts = $this->db->get("posts",$now+5,$now);
        foreach ($posts->result() as $post) {
            $output .= '<div class="jumbotron">';
                $output .= "<h4>".$post->user ."</h4>";
                $output .= '<ul class="list-unstyled bar';
                if ($post->user == $_SESSION['user']) {
                    $output .= " controls";
                }
                $output .= '">';
                    $output .= '<li><a href="'.base_url().'Posts/edit_post?id='.$post->id.'">Edit post</a></li>';
                    $output .= '<li><a href="'.base_url().'Posts/delete_post?id='.$post->id.'">Delete post</a></li>';
                $output .= '</ul>';
                $last_id = $post->id;

                if ($post->body != "") {
                    $output .= '<p class="lead"> '.$post->body.'</p>';
                }
                if ($post->image != "") {
                    $output .= '<img src="'.base_url().'assets/uploads/posts/'.$post->image.'" alt=".'.$post->body.'" width="100%">';
                }
            $output .= '</div>';
        }
        echo $output;
    }

	function insert_post(){
		// check if the user comes from the form or outside
		if (isset($_POST['submit'])) {
			$body = $this->input->post("body");

			$image = '';
	        // Image Part to set up its name and upload it to the system
	        if ($_FILES['image']['name'] != "" )
	        {
	            $config['upload_path']          = './assets/uploads/posts/';
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

	        // check if the post don't have any data ( image or text) then returns an error
	        if ($image == "" && $body == "") {
	        	$this->session->set_flashdata('post_empty','Post must have text or image and it cannot be empty');
                $this->index();
	        } else{
	        	$data = array(
	        		"body"  => $body,
	        		"image" => $image,
	        		"user"	=> $_SESSION['user']
	        	);
	        	$this->Posts_model->insert_post($data);
	        	redirect(base_url()."Home/Dash");
	        }
		} else {
			show_404();
		}
		
	}

	function edit_post(){
		$data['title'] = "Edit Post";
		$id = $_GET['id'];
		$data['post_data'] = $this->Posts_model->get_post($id);
		$this->load->view("posts/edit",$data);
	}

	function update_post(){
		// check if the user comes from the form or trying to hack
		if (isset($_POST['submit'])) {
			
			$image = '';
			$body = $this->input->post("body");
	        // Image Part to set up its name and upload it to the system
	        if ($_FILES['image']['name'] != "" )
	        {
	            $config['upload_path']          = './assets/uploads/posts/';
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
	        	$image = $this->input->post("post_image");
	        }

	        // check if the post don't have any data ( image or text) then returns an error
	        if ($image == "" && $body == "") {
	        	$this->session->set_flashdata('post_empty','Post must have text or image and it cannot be empty');
                $this->edit_post();
	        } else{
	        	$data = array(
	        		"body"  => $body,
	        		"image" => $image,
	        	);
	        	$id = $_POST['post_id'];
	        	$this->Posts_model->update_post($data,$id);
	        	redirect(base_url()."Home/Dash");
	        }

	    } else{
	    	show_404();
	    }
	}

	function delete_post(){
		$id = $_GET['id'];
		$this->Posts_model->delete_post($id);
		redirect(base_url()."Home/Dash");
	}

}