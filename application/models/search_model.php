<?php
class search_model extends ci_Model {
	function searchKey($data) {
		$value = $data['word'];
		$table = $data['table'];
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
 		$collection = $q->result_array();
		$result = array();
		foreach($collection as $key=>$row){
			foreach($row as $attribute=>$value){
				if(in_array($attribute,$title)){
					$result[$key]['title'] = $value;
				}
				if(in_array($attribute,$description)){
					$result[$key]['description'] = $value;
				}
				if(in_array($attribute,$image)){
					$result[$key]['image'] = $this->getImageUrl($table,$row);
				}
			}
		} 		
		return $result;	
	}	

	
	function getImageUrl($table,$row){
		if ($table == 'stores' || $table == 'recommands' || $table == 'coupons'){
			$image = base_url() . 'asset/img/bizlogos/' . $row['store_id'] . 'jpg';
		} elseif($table == 'shopping') { 
			$image = base_url() . 'asset/img/shops/' . $row['shop_image'] ;
		} elseif($table == 'products') { 
			$image = base_url() . 'asset/img/products/' . $row['product_image'] ;
		} elseif($table == 'fusers') { 
			$image = 'https://graph.facebook.com/' . $row['user_id'] . '/picture' ;
		}
	return $image;
	}
	
}