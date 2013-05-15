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

	function getParent($id) {
		$this->db->select('parent_id'); 
		$this->db->where('category_id', $id); 
		$q = $this->db->get('categories');
		$parent = $q->result();
		return $parent[0]->parent_id;
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
	
	function getCoupons($categoryId) {
		$mainCat = $this->getMainCategories();
		if (in_array($categoryId,$mainCat)){
			if($childrens = $this->getChildren($categoryId)){
				$this->db->or_where_in('category_id', $childrens);
			}
		} 	
		$this->db->or_where('category_id', $categoryId);
		$q = $this->db->get('coupons');
		return $q->result();
	}

	function getShops($categoryId,$start,$limit) {
		$mainCat = $this->getMainCategories();
		if (in_array($categoryId,$mainCat)){
			// this is aparent category
			// get all children records
			// log_message('debug', 'ddddd' . print_r($childrens,true));
			if($childrens = $this->getChildren($categoryId)){
				$this->db->or_where_in('category_id', $childrens);
			}
		} 
		$this->db->limit($limit, $start);
		$this->db->or_where('category_id', $categoryId);
		$this->db->order_by("create_time", "desc");
		$q = $this->db->get('shopping');
		return $q->result();
	}

	function countShops($categoryId) {
		$mainCat = $this->getMainCategories();
		if (in_array($categoryId,$mainCat)){
			if($childrens = $this->getChildren($categoryId)){
				$this->db->or_where_in('category_id', $childrens);
			}
		} 
		$this->db->or_where('category_id', $categoryId);
		$q = $this->db->get('shopping');
		return $q->num_rows();
	}
	

	
	
	function getRecommands($categoryId) {
		$mainCat = $this->getMainCategories();
		if (in_array($categoryId,$mainCat)){
			if($childrens = $this->getChildren($categoryId)){
				$this->db->or_where_in('category_id', $childrens);
			}
		} 	
		$this->db->or_where('category_id', $categoryId); 
		$q = $this->db->get('recommands');
		return $q->result();
	}
	
	
	function getMainCategories() {
		$mainCategories = array();
		$this->db->where('parent_id',0); 
		$q = $this->db->get('categories');
		foreach ($q->result() as $category){
			$mainCategories[] = $category->category_id;
		}
		return $mainCategories;
	}
	
	
	function getChildren($parentId) {
		$childes = array();
		$this->db->select('category_id'); 
		$this->db->where('parent_id', trim($parentId)); 
		$query = $this->db->get('categories');
		foreach ($query->result() as $child){
			$childes[] = $child->category_id;
		}
		return $childes;
	}
	
	function getRecords($tab , $categoryId ,$view , $freinds , $start,$limit){
		$mainCat = $this->getMainCategories();
		if (in_array($categoryId,$mainCat)){
			// this is aparent category
			// get all children records
			$childrens = $this->getChildren($categoryId);
			// log_message('debug', 'ddddd' . print_r($childrens,true));
			$this->db->or_where_in('category_id', $childrens);
		} 
		$this->db->limit($limit, $start);
		if (!empty($freinds) && $view == 2) {
			$this->db->or_where_in('user_id',$freinds);				
		}
		$this->db->or_where('category_id', $categoryId); 		
		$this->db->order_by("create_time", "desc");
		$q = $this->db->get($tab,9);
		return $q->result();
	}

	

	function saveCategory($categories ,$type , $product){
		$mainCat = $this->getMainCategories();
		// log_message('debug', print_r($mainCat,true));

		$insertData = array();
		if ($type == 1 ){
			if (in_array($categories,$mainCat)){
				$insertData[] = array('product_id'=>$product['product_id'],'category_id'=>$categories,'category_type'=>1,'store_id'=>$product['store_id']);
			} else {
				$parentId = $this->getParent($categories);
				$insertData[] = array('product_id'=>$product['product_id'],'category_id'=>$categories,'category_type'=>1,'store_id'=>$product['store_id']);
				$insertData[] = array('product_id'=>$product['product_id'],'category_id'=>$parentId,'category_type'=>1,'store_id'=>$product['store_id']);
			}
		} elseif($type == 2 ) {
			foreach($categories as $categoryId){
				$insertData[] = array('product_id'=>$product['product_id'],'category_id'=>$categoryId,'category_type'=>2,'store_id'=>$product['store_id']);
			}
		}
		foreach($insertData as $row){
			$this->db->insert('products_categories', $row); 
		}		
	}


	function fetch_category_shops ($categoryId , $view , $freinds , $start,$limit) {
		$mainCat = $this->getMainCategories();
		if (in_array($categoryId,$mainCat)){
			// this is aparent category
			// get all children records
			$childrens = $this->getChildren($categoryId);
			// log_message('debug', 'ddddd' . print_r($childrens,true));
			$this->db->or_where_in('category_id', $childrens);
		} 
		$this->db->limit($limit, $start);
		if (!empty($freinds) && $view == 2) {
			$this->db->or_where_in('user_id',$freinds);				
		}
		$this->db->or_where('category_id', $categoryId); 		
		$this->db->order_by("create_time", "desc");
		$query = $this->db->get("shopping");
		return $query->result();		
	}	
	
		
		
	

}