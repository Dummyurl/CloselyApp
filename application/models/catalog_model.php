<?php

class catalog_model extends ci_Model {
	
	
	function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }
	
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

	function fetch_store_shops ($storeId , $start,$limit) {
		$this->db->limit($limit, $start);
		$this->db->order_by("create_time", "asc");
		$this->db->where('store_id', $storeId);
		$query = $this->db->get("shopping"); 
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}
	
	function count_store_shops($storeId){
		$this->db->where('store_id', $storeId);
		$query = $this->db->get("shopping");
		return $query->num_rows();
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
	

	function getCategory($id) {
		$this->db->where('category_id', $id); 
		$q = $this->db->get('categories');
		return $q->result();	
	}
	
	function getCoupon($id) {
		$this->db->where('coupon_id', $id); 
		$q = $this->db->get('coupons');
		return $q->result();	
	}	
	
	function getShopComments($id) {
		$this->db->where('shop_id', $id); 
		$this->db->order_by("create_time", "asc");
		$q = $this->db->get('comments');
		return $q->result();	
	}	
	
	function commentsForShop($id) {
		$this->db->where('shop_id', $id); 
		$q = $this->db->get('comments');
		return $q->result();	
	}
	
	function couponForShop($id) {
		$this->db->where('shop_id', $id); 
		$q = $this->db->get('coupons');
		return $q->result();	
	}
	
	function priceForShop($id) {
		$this->db->where('shop_id', $id); 
		$q = $this->db->get('shopping');
		return $q->result();	
	}

	function searchKey($data) {
		$value = $data['word'];
		$table = $data['table'];
		$category = $data['category'];
		$title = array('store_name','coupon_name','user_name','product_name','recommand_title','shop_title');
		$description = array('store_address','description','email','shop_description');
		$image = array('shop_image','store_logo','user_id');		
		switch ($table) {
			case 'stores':
				$array = array('store_name' => $value, 'store_id' => $value, 'description' => $value, 'store_address' => $value);
				foreach($array as $key=>$val){
					$this->db->or_like($key,$val);
				}
				break;
			case 'shopping':
				$array = array('shop_title' => $value, 'shop_description' => $value, 'shop_id' => $value);
				foreach($array as $key=>$val){
					$this->db->or_like($key,$val);
				}
				break;
			case 'coupons':
				$array = array('description' => $value, 'coupon_name' => $value, 'coupon_id' => $value, 'store_id' => $value);
				foreach($array as $key=>$val){
					$this->db->or_like($key,$val);
				}
				break;
			case 'recommands':
				$array = array('recommand_title' => $value, 'user_id' => $value, 'description' => $value, 'store_id' => $value);
				foreach($array as $key=>$val){
					$this->db->or_like($key,$val);
				}
				break;
			case 'products':
				$array = array('product_name' => $value, 'store_id' => $value, 'sku' => $value, 'description' => $value);
				foreach($array as $key=>$val){
					$this->db->or_like($key,$val);
				}
				break;				
		}	
		
		$q = $this->db->get($table);	
		// echo $this->db->last_query();
 		$collection = $q->result_array();
		$result = array();
		foreach($collection as $key=>$row){
			foreach($row as $attribute=>$value){
				if (in_array($category , explode(",",$row['category_id']))){
					if(in_array($attribute,$title)){
						$result[$key]['title'] = $value;
					}
					if(in_array($attribute,$description)){
						$result[$key]['description'] = $value;
					}
					if(in_array($attribute,$image)){
						$result[$key]['image'] = $this->getImageUrl($table,$row);
					}
					$result[$key]['table'] = $table;
					$result[$key]['id'] = $row['id'];
				}

			}
		} 		
		// echo $this->db->last_query();
		return $result;	
	}	

	
	function getImageUrl($table,$row){
		if ($table == 'stores' || $table == 'recommands' || $table == 'coupons'){
			$image = base_url() .  'asset/img/bizlogos/' . $this->getStoreImage($row['store_id']);
		} elseif($table == 'shopping') { 
			$image = base_url() . 'asset/img/shops/' . $row['shop_image'] ;
		} elseif($table == 'products') { 
			$image = base_url() . 'asset/img/products/' . $row['product_image'] ;
		} elseif($table == 'fusers') { 
			$image = 'https://graph.facebook.com/' . $row['user_id'] . '/picture' ;
		}
	return $image;
	}
	
	function getShopProducts ($products,$storeId = null){
		$productsArr = explode("," , $products);
		$this->db->where_in('product_id',$productsArr);
		if ($storeId){
			$this->db->where('store_id',$storeId);
		}
		$q = $this->db->get('products');
		return $q->result();
	}
	
	function getStoreImage ($id){
		$this->db->where('store_id', $id); 
		$q = $this->db->get('stores');
		$store = $q->result();
		return $store[0]->store_logo;
	}

	function fetch_store_products ($storeId , $start,$limit) {
		$this->db->limit($limit, $start);
		$this->db->where('store_id', $storeId);
		$query = $this->db->get("products"); 
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}

	function fetch_category_products ($categoryId , $start,$limit) {
		$this->db->limit($limit, $start);
		$this->db->where('store_category', $categoryId);
		$query = $this->db->get("products"); 
		if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
	}	
	
	
	function count_store_products($storeId){
		$this->db->where('store_id', $storeId);
		$query = $this->db->get("products");
		return $query->num_rows();
	}

	
	function getShopProductsIds($id) {
		$this->db->where('shop_id', $id); 
		$q = $this->db->get('shopping');
		$res = $q->result();
		return $res[0]->products;	
	}
	

		
	function fetch_store_shopping ($storeId , $view , $freinds , $start,$limit) {
		$this->db->limit($limit, $start);
		if (!empty($freinds) && $view == 2) {
			$this->db->where_in('user_id',$freinds);				
		}
		$this->db->where('store_id', $storeId);
		$this->db->order_by("create_time", "desc");
		$query = $this->db->get("shopping");
		return $query->result();		
	}
	
	function fetch_user_shopping ($userId , $start,$limit) {
		$this->db->limit($limit, $start);
		$this->db->where('user_id', $userId);
		$this->db->order_by("create_time", "desc");
		$query = $this->db->get("shopping");
		return $query->result();		
	}
	
	function count_user_shops($userId){
		$this->db->where('user_id', $userId);
		$query = $this->db->get("shopping");
		return $query->num_rows();
	}

	function getCategoryProductsArr($categoryId,$type,$store){
		$productsArr = array();
		$this->db->select('product_id');
		$this->db->where('category_id', $categoryId); 
		$this->db->where('category_type', $type); 
		if (!empty($store)) {
			$this->db->where('store_id',$store);				
		}	
		$q = $this->db->get('products_categories');
		foreach($q->result()as $product){
			$productsArr[] = $product->product_id;
		}	
		return $productsArr;
	}

	function getProducts($categoryId ,$type , $start,$limit , $store = null){
		$productsList = $this->getCategoryProductsArr($categoryId,$type,$store);
		$this->db->limit($limit, $start);
		$this->db->where_in('product_id',$productsList);
		$this->db->order_by("create_time", "desc");
		$q = $this->db->get('products');
		return $q->result();
	}
	
	function getProductRecommands($productId){
		$this->db->where('product_id', $productId);
		$this->db->order_by("create_time", "desc");
		$q = $this->db->get('products_recommands');
		return $q->result();
	}
	

}