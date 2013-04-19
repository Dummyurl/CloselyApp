<?php

class coupons_model extends ci_Model {
	
	function getAll() {
		$q = $this->db->get('coupons');
		
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
			    $data[] = $row;
			}
		return $data;
		}
	}
	
	function getUserInfo($id) {
		$this->db->where('user_id', $id); 
		$q = $this->db->get('fusers');
		return $q->result();	
	}	
	
	function get_store_coupons ($id) {
		$this->db->where('store_id', $id); 
		$q = $this->db->get('coupons');
		return $q->result();	
	}
	

	
}