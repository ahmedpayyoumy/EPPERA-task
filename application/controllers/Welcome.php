<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index(){
		$data['title'] = "Users Login Page";
		$this->load->view("users/login",$data);
	}

	function test(){
		$a = "php";
		$a++;
		echo $a;
	}
}
