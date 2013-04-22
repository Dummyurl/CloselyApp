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
	
}