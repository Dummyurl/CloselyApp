<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Facebook_model');
		$this->load->model('users_model');
    }

    function getnewsold()
    {
	$newsCnt = array();
		$OldlastRow = $this->session->userdata('last_update');
		$this->load->model('users_model');
		$NewlastRow = $this->users_model->getLastRow();
		foreach ($OldlastRow as $key=>$idVal){
			if ($idVal){
				$newsCnt[$key] = $NewlastRow[$key] - $idVal;
			} else {
				if ($newval = $NewlastRow[$key]){
					$newsCnt[$key] = $newval-0;
				} else{
					$newsCnt[$key] = 0;
				}
			}
		}

		print_r($newsCnt);
    }

	function getnews()
    {
	//$this->session->set_flashdata('last_update1',date("Y-m-d H:i:s"));	
	$uid = json_decode($this->input->post('uid'));
	$view = json_decode($this->input->post('view'));
	$time = json_decode($this->input->post('time'));
	$newsData = array('uid'=>$uid,'view'=>$view ,'time'=>$time); 
	$NewUpdates = $this->users_model->getNewUpdates($newsData); 
		
	  // $item = trim($this->input->post('time'));
     //  $array = array('result' => $item);
      // header('Content-Type: application/json',true);
      echo json_encode($NewUpdates);
		
    }
	
	
	function getfeed()
    {
	$onlyfreinds = '';
	$view = $this->input->post('view');
	if($view){
		$onlyfreinds = $this->input->post('uid');
	}
	$latest = $this->users_model->getLatestfeed($onlyfreinds);
		 foreach ($latest as $lastType ) {
			$user_name = $this->users_model->getUserName($lastType['user_id']) ;
			$gender = $this->users_model->getUserGender($lastType['user_id']) ;
			$store = $this->users_model->getStoreName($lastType['store_id']) ;
			 if ($gender =='male') { 
				 $addText = ' הוסיף ' ;
			 } else {
				 $addText = ' הוסיפה ' ;
			 }
			 
			echo '<li class="box-row">
				<div class="line-contant">
					<img src="https://graph.facebook.com/' . $lastType['user_id'] . '/picture"/>
					<div class="feed_text">' .  $addText . ' ' . $lastType['feed'] . ' ב' . $store . ' ' .  $user_name .'</div>
					<div class="feed_text title"> ' .  $lastType['title'].'</div>
				</div>
			</li>';
		}
    }
	

	
}
