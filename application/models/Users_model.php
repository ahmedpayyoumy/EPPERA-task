<?php 

	Class Users_model extends CI_MODEL
	{

		/* function for inserting users into DB 
		this function accepts one param as an associative array 
		*/
		function add_users($data){
			$this->db->insert("users",$data);
		}

		function delete_user($id){
			$this->db->where("email",$id);
			$this->db->delete("users");
		}

		function user_login($user,$password)
		{
			$this->db->where('email',$user);
			$this->db->where('password',$password);
			$query = $this->db->get('users');

			if ($query->num_rows() > 0 ) 
			{
				return true;	
			}
			else
			{
				return false;
			}
		}


		function get_user($user){
			$this->db->where("email",$user);
			$query = $this->db->get("users");
			return $query;
		}

		function update_user($user,$data){
			$this->db->where("email",$user);
			$this->db->update("users",$data);
		}

	}