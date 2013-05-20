<?php

class products_model extends ci_Model {
	
	
	function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }
	
	
	function getProductId($urlName) {
	    $urlName = urldecode($urlName);
		$this->db->select('product_id'); 
		$this->db->where('url_key',$urlName); 
		$q = $this->db->get('products');
		$res = $q->result();
		return $res[0]->product_id;
	}
	
	function getInfo($storeId,$productId) {
		$this->db->where('store_id',$storeId); 
		$this->db->where('product_id',$productId); 
		$q = $this->db->get('products');
		$res = $q->result();
		return $res[0];
	}
	
	function jsonInfo($storeId,$productId) {
		$this->db->where('store_id',$storeId); 
		$this->db->where('product_id',$productId); 
		$q = $this->db->get('products');
		$res = $q->result_array();
		return $res[0];
	}
	
	function getStores($productId) {
		$this->db->select('store_id'); 
		$this->db->where('product_id',$productId); 
		$q = $this->db->get('products');
		return $q->result();
	}

	function getBuyers($productId) {
		$users = array();
		$this->db->select('user_id'); 
		$this->db->like('products',$productId); 
		$q = $this->db->get('shopping');
		foreach ($q->result() as $user){
			if(!in_array($user->user_id,$users)){
				$users[] = $user->user_id;
			}
		}
		return $users;
	}
}