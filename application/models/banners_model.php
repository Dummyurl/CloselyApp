<?php

class banners_model extends ci_Model {
	
	function getPositions() {
		$q = $this->db->get('banners_positions');
		return $q->result();
	}
	
	function getCost($posName) {
		$this->db->select('costperday'); 
		$this->db->where('position_name',$posName); 
		$q = $this->db->get('banners_positions');
		return $q->result();
	}
	
}