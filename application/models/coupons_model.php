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
	
}