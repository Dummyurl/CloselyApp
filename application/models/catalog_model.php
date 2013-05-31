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

	
	function mainSearch($data) {
		$statment = $data['word'];
		$tables = $this->getSearchMapping();
		
		$collection = array();
		$result = array();
		foreach($tables as $table=>$tableprep){
				$attributes = $tableprep['attributes'];
				$conditions = $tableprep['cond'];
				$select = $tableprep['select'];
				$this->db->select($select);
				foreach($attributes as $attribute){
					$this->db->or_like($attribute,$statment);
				}
/* 				foreach($conditions as $col=>$cond){
					$this->db->where($col . '!=', $cond);
				} */
				$q = $this->db->get($table);	
				$collection[$table] = $q->result_array();
		}
  		foreach($collection as $table=>$tabresult){
			$fixKeys = $tables[$table]['defaultAtrr'];	
			foreach($tabresult as $row){	
				$result[$table][] = $this->convertResultData($row , $fixKeys , $table); 
			}
		}  
		return $result;	
	}	
	
 	function convertResultData($row , $fixKeys , $table ){
		$this->load->model('stores_model');
		$newRow = array();
		$newRow['title'] = $row[$fixKeys['title']];
		if($table == 'products'){
			$urlKey = $this->stores_model->getStoreUrlKey($row['store_id']);
			$newRow['url'] = $fixKeys['urlpath'] . $urlKey . '/'. $row['url_key'];
		} else {
			$newRow['url'] = $fixKeys['urlpath'] . $row[$fixKeys['url']];
		}
		if($table == 'shopping' || $table == 'products'){
			$newRow['image'] = str_replace("storeid",$row['store_id'],$fixKeys['imagepath'] . $row[$fixKeys['image']]);
		} elseif($table == 'coupons' || $table == 'recommands' || $table == 'fusers') {
			$newRow['image'] = str_replace("user",$row['user_id'],'https://graph.facebook.com/user/picture');
		} else {
			$newRow['image'] = $fixKeys['imagepath'] . $this->stores_model->getStoreImage($row['store_id']);
		}
		 $newRow['description'] = $row[$fixKeys['description']];
		return $newRow; 
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
	
	function getSearchMapping(){
		 return array('stores'=>
					array('attributes'=>array('store_name','store_id','website','email'),'cond'=>array('active'=>0),'select'=>array('store_id','url_key','store_logo','store_name','store_address'),
							'defaultAtrr'=>array(
								'title'=>'store_name',
								'urlpath'=> base_url() ,
								'url'=>'store_id',
								'imagepath'=> base_url() . 'asset/img/bizlogos/',
								'image'=>'store_logo',
								'description'=>'store_address')
						),
						'shopping'=>
							array('attributes'=>array('shop_id','shop_title'),'cond'=>array('visable'=>0),'select'=>array('shop_id','store_id','user_id','shop_image','shop_title','shop_description'),
								'defaultAtrr'=>array(
									'title'=>'shop_title',
									'urlpath'=> base_url() . 'catalog/shop/',
									'url'=>'shop_id',
									'imagepath'=> base_url() . 'asset/img/store/storeid/',
									'image'=>'shop_image',
									'description'=>'shop_description')
							),
						'coupons'=>
							array('attributes'=>array('coupon_id','coupon_name','type'),'cond'=>array('visable'=>0,'strongly'=>0),'select'=>array('coupon_id','coupon_name','type','shop_id','description','user_id'),
								'defaultAtrr'=>array(
									'title'=>'coupon_name',
									'urlpath'=> base_url() . 'catalog/shop/',
									'url'=>'shop_id',
									'imagepath'=> 'facebook',
									'image'=>'user_id',
									'description'=>'description')
							),
						'fusers'=>
							array('attributes'=>array('user_id','user_name','email'),'cond'=>array('visable'=>0,'view_in_search'=>0),'select'=>array('user_id','user_name','email'),
								'defaultAtrr'=>array(
									'title'=>'user_name',
									'urlpath'=> base_url() . 'user/page/',
									'url'=>'user_id',
									'imagepath'=> 'facebook',
									'image'=>'user_id',
									'description'=>'email')
							),
						'recommands'=>
							array('attributes'=>array('recommand_title','store_id'),'cond'=>array(),'select'=>array('recommand_title','user_id','store_id','category_id','description'),
								'defaultAtrr'=>array(
									'title'=>'recommand_title',
									'urlpath'=> base_url() ,
									'url'=>'store_id',
									'imagepath'=> 'facebook',
									'image'=>'user_id',
									'description'=>'description')
							),
						'products'=>
							array('attributes'=>array('product_id','product_name'),'cond'=>array('visable'=>0),'select'=>array('product_id','product_name','product_image','store_id','url_key','description'),
								'defaultAtrr'=>array(
									'title'=>'product_name',
									'urlpath'=> base_url() . 'catalog/product/',
									'url'=>'url_key',
									'imagepath'=> base_url() . 'asset/img/store/storeid/',
									'image'=>'product_image',
									'description'=>'description')
							),
						'branches'=>
							array('attributes'=>array('store_id'),'cond'=>array('active'=>0),'select'=>array('store_id','title','address'),
								'defaultAtrr'=>array(
									'title'=>'title',
									'urlpath'=> base_url() ,
									'url'=>'store_id',
									'imagepath'=> base_url() . 'asset/img/bizlogos/',
									'image'=>'',
									'description'=>'address')
							),
				);
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
	
	function getRate($productid,$rate,$storeId,$userId) {
		$data = array(
			'rate_id' => $productid ,
			'rating' => $rate ,
			'user_id' =>  $userId ,
			'store_id' =>  $storeId				
		);
		$this->db->insert('rating', $data); 
		return $this->db->_error_number();	
	}
		
	function getProductRating($store_id,$product_id){
		$totalRating = 0;
		$this->db->where('rate_id', $product_id);
		$this->db->where('store_id', $store_id);
		$q = $this->db->get('rating');
		if ($res = $q->result()){
			foreach ($res as $rate){
				$totalRating += $rate->rating;
			}
			return $totalRating/sizeof($res);
		}
		return $totalRating;
	}
	
	function getRatersNum($store_id,$product_id){
		$totalRating = 0;
		$this->db->where('rate_id', $product_id);
		$this->db->where('store_id', $store_id);
		$q = $this->db->get('rating');
		return $q->num_rows();
	}

}