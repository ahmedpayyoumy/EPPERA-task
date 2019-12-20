<?php 

	Class Posts_model extends CI_MODEL
	{

		function insert_post($data){
			$this->db->insert("posts",$data);
		}

		function get_post($id){
			$this->db->where("id",$id);
			$query = $this->db->get("posts");
			return $query;
		}

		function update_post($data,$id){
			$this->db->where("id",$id);
			$this->db->update("posts",$data);
		}

		function delete_post($id){
			$this->db->where("id",$id);
			$this->db->delete("posts");
		}

		function get_posts(){
			$this->db->order_by("id","DESC");
			$query = $this->db->get("posts");
			return $query;
		}


	}