<?php

class stores_model extends ci_Model {
	
	function getAll() {
		$q = $this->db->get('stores');
		
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
			    $data[] = $row;
			}
		return $data;
		}
	}
	
	function getStoreInfo($id) {
		$this->db->where('store_id', $id); 
		$q = $this->db->get('stores');
		return $q->result();	
	}
	
	function getStoreUrlKey($id) {
		$this->db->select('url_key'); 
		$this->db->where('store_id', $id); 
		$q = $this->db->get('stores');
		$res = $q->result();
		return $res[0]->url_key;	
	}
	
	function getStoreImage($id) {
		$this->db->select('store_logo'); 
		$this->db->where('store_id', $id); 
		$q = $this->db->get('stores');
		$res = $q->result();
		return $res[0]->store_logo;	
	}
	
	function getBranches($id) {
		$this->db->where('store_id', $id); 
		$q = $this->db->get('branches');
		return $q->result();	
	}
	
	function getShopStoreLocation($shopStores) {
		if ($shopStores){
			$this->db->where_in('branch_id',$shopStores);
			$q = $this->db->get('branches');
		return $q->result();	
		} else{
			return null;
		}
	}
	
	function getStoreId($urlName) {
	    $urlName = urldecode($urlName);
		$this->db->select('store_id'); 
		$this->db->where('url_key',$urlName); 
		$q = $this->db->get('stores');
		$res = $q->result();
		return $res[0]->store_id;
	}

	function getlocation($id) {
		$this->db->select('location'); 
		$this->db->where('store_id', $id); 
		$q = $this->db->get('stores');
		$res = $q->result();
		 $locationArr = explode(',' , $res[0]->location);
		return $locationArr;	
	}

	function getLastCustomers($id) {
		$this->db->where('store_id', $id); 
		$this->db->select('user_id'); 
		$this->db->order_by("create_time", "desc");
		$q = $this->db->get('shopping',18);
		$customerArr = array();
		foreach ($q->result() as $user ){
			$customerArr[] = $user->user_id;	
		}
		$allShops = array_unique($customerArr);
		$uniqeCustomers = array_slice($allShops, 0, 18);
		return $uniqeCustomers;	
	}

	function getLastRecommands($id) {
		$this->db->where('store_id', $id); 
		$this->db->order_by("create_time", "desc");
		$q = $this->db->get('recommands',3);
		return $q->result();	
	}	
	
	function getRecommands($id) {
		$this->db->where('store_id', $id); 
		$this->db->order_by("create_time", "desc");
		$q = $this->db->get('recommands');
		return $q->result();	
	}
	
	function recommandsCnt($id) {
		$this->db->where('store_id', $id); 
		$q = $this->db->get('recommands');
		return $q->num_rows();	
	}
	
	function shopsCnt($id) {
		$this->db->where('store_id', $id); 
		$q = $this->db->get('shopping');
		return $q->num_rows();	
	}	

	function couponsCnt($id) {
		$this->db->where('store_id', $id); 
		$q = $this->db->get('coupons');
		return $q->num_rows();	
	}	
	
	function getRecords($tab , $storeId ,$view , $freinds){
		if (!empty($freinds) && $view == 2) {
			$this->db->where_in('user_id',$freinds);				
		}
		$this->db->where('store_id', $storeId); 
		$this->db->order_by("create_time", "desc");
		$q = $this->db->get($tab,9);
		return $q->result();
	}
	
	function getWebsiteCategories($id) {
		$this->db->select('category_id'); 
/* 		$this->db->where('store_id', $id);  */
		$q = $this->db->get('categories');
		return $q->result();
	}
	
	function getStoreProducts($id) {
		$this->db->select('product_name'); 
 		$this->db->where('store_id', $id);
		$q = $this->db->get('products');
		return $q->result();
	}


	
	function getStoreCategories($id) {
		$this->db->select('category_id'); 
		$this->db->where('store_id', $id); 
		$q = $this->db->get('stores_custom_categories');
		return $q->result();
	}
	
	
	
}