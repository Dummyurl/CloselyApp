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
	
	
		function getRate($storeid,$rate,$ip) {
		$data = array(
			'rate_id' => $storeid ,
			'rating' => $rate ,
			'user_ip' =>  $ip		
		);
		$this->db->insert('rating', $data); 
		return $this->db->_error_number();	
	}
	
	
	function ratedProduct($storeId,$productId,$userId) {
		if ($userId){
			$this->db->where('rate_id', $productId);
			$this->db->where('store_id', $storeId);
			$this->db->where('user_id', $userId);
			$q = $this->db->get('rating');
			if ($res = $q->result()){
				return array('user'=>$userId , 'rating'=>$res[0]->rating , 'exist'=>true);
			}
			return array('user'=>$userId , 'rating'=>null , 'exist'=>false);
		}
	  return array('user'=>null , 'rating'=>null , 'exist'=>false);	
	}
	
	function checkForBuyer($storeId,$productId,$userId) {
		if ($userId){
			$this->db->where('store_id', $storeid);
			$this->db->where('user_id', $userId);
			$this->db->like('products',$productId); 
			$q = $this->db->get('shopping');
			if ($res = $q->result()){
				return array('buy'=>true , 'message'=>'הינך רשאי לדרג את המוצר');
			}
			return array('buy'=>false , 'message'=>'דירוג המוצר אפשרי ללקוחות שרכשו את המוצר בלבד');
		}
	  return array('buy'=>false , 'message'=>'דירוג מוצר אפשרי אך ור ללקוחות רשומים');	
	}
	
	
	
	function getProductRating($storeId,$productId) {
			$totalRating = 0;
			$this->db->where('rate_id', $productId);
			$this->db->where('store_id', $storeId);
			$q = $this->db->get('rating');
			if ($res = $q->result()){
				foreach ($res as $rate){
					$totalRating += $rate->rating;
				}
				return $totalRating/sizeof($res);
			}
			return $totalRating;
	}
	
	function getRaterNum($storeId,$productId) {
		$this->db->where('rate_id', $productId);
		$this->db->where('store_id', $storeId);
		$q = $this->db->get('rating');
		return $q->num_rows();
	}
	
	
}