<?php

class users_model extends ci_Model {
	
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
	
}