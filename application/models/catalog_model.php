<?php

class catalog_model extends ci_Model {
	
	function getAll() {
		$q = $this->db->get('shopping');
		
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
	
	function countAll() {
		return $this->db->count_all("shopping");	
	}
	
	 public function fetch_shops($start,$limit) {
        $this->db->limit($limit, $start);
		$this->db->order_by("create_time", "asc");
        $query = $this->db->get("shopping"); 
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
   }


	function getShopInfo($id) {
		$this->db->where('shop_id', $id); 
		$q = $this->db->get('shopping');
		return $q->result();	
	}	
	
	function getUserInfo($id) {
		$this->db->where('user_id', $id); 
		$q = $this->db->get('fusers');
		return $q->result();	
	}	
	
}