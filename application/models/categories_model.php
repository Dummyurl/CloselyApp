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
	
	function getCategoryId($urlName) {
	    $urlName = urldecode($urlName);
		$this->db->select('category_id'); 
		$this->db->where('url',$urlName); 
		$q = $this->db->get('categories');
		$res = $q->result();
		return $res[0]->category_id;
	}
	
	function getStoreCategoryName($id) {
		$this->db->select('category_name'); 
		$this->db->where('category_id',$id); 
		$q = $this->db->get('stores_custom_categories');
		$res = $q->result();
		return $res[0];
	}
	
	function getWebsiteCategoryName($id) {
		$this->db->where('category_id',$id); 
		$q = $this->db->get('categories');
		$res = $q->result();
		return $res[0];
	}
	
	function getStoresInCategory($id) {
		$this->db->select('store_id'); 
		$this->db->where('category_id',$id); 
		$q = $this->db->get('store_categories');
		return $q->result();
	}
	
	function getCoupons($id) {
		$this->db->where('category_id', $id); 
		$q = $this->db->get('coupons');
		return $q->result();
	}

	function getShops($id) {
		$this->db->where('category_id', $id); 
		$q = $this->db->get('shopping');
		return $q->result();
	}

	function getRecommands($id) {
		$this->db->where('category_id', $id); 
		$q = $this->db->get('recommands');
		return $q->result();
	}
	
	function getRecords($tab , $categoryId ,$view , $freinds){
		if (!empty($freinds) && $view == 2) {
			$this->db->where_in('user_id',$freinds);				
		}
		$this->db->where('category_id', $categoryId); 
		$this->db->order_by("create_time", "desc");
		$q = $this->db->get($tab,9);
		return $q->result();
	}
	
}