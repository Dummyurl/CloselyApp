<?php

class users_model extends ci_Model {
	public function __construct()
	{
		parent::__construct();
	}	

	function getAllUsersId() {
		$this->db->select('user_id'); 
		$q = $this->db->get('fusers');
		$users = $q->result();
		foreach($users as $user){
			$userIdArr[] = $user->user_id;
		} 
		return $userIdArr;
	}
	
	function getFreindsId($uid) {
		$this->db->where('user_id', $uid); 
		$q = $this->db->get('fusers');
		$res = $q->result();
		$freindsArr = unserialize($res[0]->reg_freinds);
		foreach($freindsArr as $uid=>$name){
			$userIdArr[] = $name;
		}
		return $userIdArr;
	}
	
	function countUserActions($data) {
		if ($data['view']){
			$uidList = $this->getFreindsId($data['uid']);
		} else {
			$uidList = $this->getAllUsersId();
		}
		foreach($uidList as $uid){
			$this->db->select('user_id'); 
			$this->db->where('user_id', $uid);
			$q = $this->db->get($data['table']);
			$actionCount[$uid] = $q->num_rows();
		} 
		arsort($actionCount);
		return $actionCount;
	}
	
	function getStoreInfo($id) {
		$this->db->where('store_id', $id); 
		$q = $this->db->get('stores');
		return $q->result();	
	}
	
	function getClubs($uid) {
		$this->db->where('user_id', $uid); 
		$q = $this->db->get('clubs',4);
		return $q->result();
	}
	
	function getLastCoupons($uid) {
		$this->db->where('user_id', $uid); 
		$this->db->order_by("create_time", "desc");
		$q = $this->db->get('coupons',2);
		return $q->result();
	}
	
	function getUserShopStores($uid) {
		$this->db->select('branch'); 
		$this->db->where('user_id', $uid); 
		$q = $this->db->get('shopping');
		$allShopsStores = $q->result();
		$stores = array();
		foreach($allShopsStores as $store){
			if(!in_array($store->branch, $stores )){
				$stores[] = $store->branch;
			}
		}
		return $stores;
	}
	
	function updateMembers($info) {
		$id = $info['info']['id'];
		$freinds = $info['freinds'];
		$likes = $info['likes'];
 		$this->db->where('user_id', $id); 
		$q = $this->db->get('fusers');
		if ($q->result()){
			$res = $q->result();
			$row = $res[0];
			$old_freinds = $row->freinds;
			$new_freinds = $freinds;
			$old_likes = $row->likes;
			$new_likes = $likes;
			if (($old_freinds != $new_freinds) || ($old_likes != $new_likes)){
				return $this->updateRow($info);
			}
			return false;
		} 
		$data = array('user_id'=>$id ,
			'user_name'=>$info['info']['name'] ,
			'gender'=>$info['info']['gender'] ,
			'birthday'=>$info['info']['birthday'] ,
			'city'=>$info['info']['hometown']['name'] ,
			'email'=>$info['info']['email'] ,
			'likes'=>serialize($likes) ,
			'freinds'=>serialize($freinds));
			
		$this->db->insert('fusers',$data);
		return true;
	}
	
	function updateRow($info) {
		$id = $info['info']['id'];
		$freinds = $info['freinds'];
		$likes = $info['likes'];
		$data = array('likes'=>serialize($likes) ,'freinds'=>serialize($freinds));
		$this->db->where('user_id', $id); 
		$this->db->update('fusers', $data); 
		return true;
	}
	
	function updateFreindsList($info) {
		$id = $info['id'];
		$freinds = $info['freinds'];
		$data = array('reg_freinds'=>serialize($freinds));
		$this->db->where('user_id', $id); 
		$this->db->update('fusers', $data); 
		return true;
	}
	
	function getFreinds($id) {
		$this->db->where('user_id', $id); 
		$q = $this->db->get('fusers');
		$res = $q->result();
		// print_r($res);
		$freindsArr = unserialize($res[0]->freinds);
		$freindsList = array();
 		foreach($freindsArr['data'] as $freind){
			$freindsList[$freind['id']]	= $freind['name'];
		} 
		return $freindsList;
	}
	
	function isUserExist($uid) {
		$this->db->where('user_id', $uid); 
		$q = $this->db->get('fusers');
		if ($q->result()){
			return true;
		}
		return false;
	}
	

	
	
	
	function getUserName($uid) {
		$this->db->where('user_id', $uid); 
		$q = $this->db->get('fusers');
		$user = $q->result();
		return $user[0]->user_name;
	}
	
	function getUserGender($uid) {
		$this->db->where('user_id', $uid); 
		$q = $this->db->get('fusers');
		$user = $q->result();
		return $user[0]->gender;
	}
	
	function getUser($uid) {
		$this->db->where('user_id', $uid); 
		$q = $this->db->get('fusers');
		return $q->result();
	}
	
	function getShops($uid) {
		$this->db->where('user_id', $uid); 
		$q = $this->db->get('shopping');
		return $q->result();
	}
	
	function getCoupons($uid) {
		$this->db->where('user_id', $uid); 
		$q = $this->db->get('coupons');
		return $q->result();
	}
	
	function getRecommands($uid) {
		$this->db->where('user_id', $uid); 
		$q = $this->db->get('recommands');
		return $q->result();
	}
	
	function getStoreName($sid) {
		$this->db->where('store_id', $sid); 
		$q = $this->db->get('stores');
		$user = $q->result();
		return $user[0]->store_name;
	}
	
	
	function countCoupons($uid) {
		$this->db->where('user_id', $uid); 
		$q = $this->db->get('coupons');
		$rowcount = $q->num_rows();
		return $rowcount;
	}
	
	function countShops($uid) {
		$this->db->where('user_id', $uid); 
		$q = $this->db->get('shopping');
		$rowcount = $q->num_rows();
		return $rowcount;
	}
	
	function countRecommands($uid) {
		$this->db->where('user_id', $uid); 
		$q = $this->db->get('recommands');
		$rowcount = $q->num_rows();
		return $rowcount;
	}
	
	function countComments($uid) {
		$this->db->where('user_id', $uid); 
		$q = $this->db->get('comments');
		$rowcount = $q->num_rows();
		return $rowcount;
	}
	
	function getFreindsOnSite($uid) {
		$this->db->where('user_id', $uid); 
		$q = $this->db->get('fusers');
		$res = $q->result();
		$freindsArr = unserialize($res[0]->reg_freinds);
		return $freindsArr;
	}
	
	function LastUpdate() { 
/* 		$q = $this->db->get('shopping');
		$shops = $q->last_row('array');
		$q = $this->db->get('coupons');
		$coupons = $q->last_row('array');
		$q = $this->db->get('recommands');
		$recommands = $q->last_row('array');
		$data['shop'] = isset($shops['id']) ? $shops['id'] : '';
		$data['coupon'] = isset($coupons['id']) ? $coupons['id'] : '';
		$data['recommand'] = isset($recommands['id']) ? $recommands['id'] : ''; */
		return time();
	}

	function getNewUpdates($lastUpdateData) {
		if ($lastUpdateData['view'] && $lastUpdateData['uid']){
			$lastUpdateData['freinds'] = $this->getFreindsOnSite($lastUpdateData['uid']);
		}
		return $this->getNew($lastUpdateData);
	}	
	
	function getNew($lastUpdateData) {
		
/* 		$lastWasAt = $this->session->userdata('last_update');
		$this->session->set_userdata('last_update',date("Y-m-d H:i:s")); */
		$tables = array('shopping','coupons','recommands');
		$result = array();
		foreach ($tables as $table){
			if (isset($lastUpdateData['freinds'])) {
				$this->db->where_in('user_id',$lastUpdateData['freinds']);				
			}
			$this->db->where('create_time <', date("Y-m-d H:i:s"));
			$this->db->where('create_time >', date("Y-m-d H:i:s", time() - 60));
			$q = $this->db->get($table);
			$res = $q->result_array();
			foreach ($res as $row){
				$result[strtotime($row['create_time'])] = $row;
				switch ($table) {
					case 'shopping':
						$result[strtotime($row['create_time'])]['feed'] = 'קנייה חדשה';
						$result[strtotime($row['create_time'])]['title'] = $row['shop_title'];
						break;
					case 'coupons':
						$result[strtotime($row['create_time'])]['feed'] = 'קופון חדש';
						$result[strtotime($row['create_time'])]['title'] = $row['coupon_name'];
						break;
					case 'recommands':
						$result[strtotime($row['create_time'])]['feed'] ='המלצה חדשה';
						$result[strtotime($row['create_time'])]['title'] = $row['recommand_title'];
						break;
				}	
				$result[strtotime($row['create_time'])]['user_name'] = $this->getUserName($row['user_id']);
				$result[strtotime($row['create_time'])]['gender'] = $this->getUserGender($row['user_id']);
				$result[strtotime($row['create_time'])]['store_name'] = $this->getStoreName($row['store_id']);				
			}
			if ($result){
				krsort($result);
			}
		}
		return $result;	
	}
	
	function getLatestfeed($onlyfreinds) {
		$tables = array('shopping','coupons','recommands');
		foreach ($tables as $table){
			if ($onlyfreinds) {
				$this->db->where_in('user_id',$this->getFreindsOnSite($onlyfreinds));				
			}
			$this->db->order_by("create_time", "desc");
			$q = $this->db->get($table,6);
			$res = $q->result_array();
			foreach ($res as $row){
				$result[strtotime($row['create_time'])] = $row;
				switch ($table) {
					case 'shopping':
						$result[strtotime($row['create_time'])]['feed'] = 'קנייה חדשה';
						$result[strtotime($row['create_time'])]['title'] = $row['shop_title'];
						break;
					case 'coupons':
						$result[strtotime($row['create_time'])]['feed'] = 'קופון חדש';
						$result[strtotime($row['create_time'])]['title'] = $row['coupon_name'];
						break;
					case 'recommands':
						$result[strtotime($row['create_time'])]['feed'] ='המלצה חדשה';
						$result[strtotime($row['create_time'])]['title'] = $row['recommand_title'];
						break;
				}			
			}
		}
		krsort($result);
		return $result;	
	}
	
}