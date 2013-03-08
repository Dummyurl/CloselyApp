<?php

class categories_model extends ci_Model {
	
	function getAll() {
		$q = $this->db->get('categories');
		
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
			    $data[] = $row;
			}
		return $data;
		}
	}
	
	function getCategoryInfo($id) {
		$this->db->where('category_id', $id); 
		$q = $this->db->get('categories');
		return $q->result();
	}
		
	function getSubCategories($id) {
		$this->db->where('parent_id', $id); 
		$q = $this->db->get('categories');
		return $q->result();
	}
	
	
}