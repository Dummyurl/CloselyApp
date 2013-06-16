<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Facebook_model');
		$this->load->model('users_model');
		$this->load->model('catalog_model');
		$this->load->model('coupons_model');
		$this->load->model('stores_model');
		$this->load->helper('url');
		$this->load->helper('captcha');
    }

    function popup($userId)
    {
		$data['userId'] = $userId;
		$data['userName'] = $this->users_model->getUserName($userId);
		$data['actions']['shops'] = $this->users_model->countShops($userId);
		$data['actions']['coupons'] = $this->users_model->countCoupons($userId);
		$data['shops'] = $this->users_model->getShops($userId);
		$data['actions']['recommands'] = $this->users_model->countRecommands($userId);
		$this->load->view('popups/user',$data);
    }
	
	function follow($userId)
    {
		$follower = $this->input->post('user');
		if($this->users_model->isFollowed($userId,$follower)){
			$folowed = 1;
		} else {
			$folowed = 0;
		}
		
		$errors = $this->users_model->followMe($userId , $follower, $folowed);
		echo $errors;	
    }

	function generatecaptcha()
    {
		$vals = array(
			'img_path'     => './captcha/',
			'img_url'     => base_url() . 'captcha/',
			'img_width'     => '150',
			'img_height' => 30,
			'border' => 0, 
			'expiration' => 7200
		);
		$cap = create_captcha($vals);
		$word = $this->session->set_userdata('word', strtolower($cap['word']));
		
		echo json_encode($cap);
	}
	
	function addtofreinds()
    {
		$fb_data = $this->session->userdata('fb_data');
		$user = isset($fb_data['me']) ? $fb_data['me']['id'] : 1649208165;
		if($user){
			$vals = array(
				'img_path'     => './captcha/',
				'img_url'     => base_url() . 'captcha/',
				'img_width'     => '150',
				'img_height' => 30,
				'border' => 0, 
				'expiration' => 7200
			);
			$cap = create_captcha($vals);
			$data['image'] = $cap['image'];
			$this->session->set_userdata('word', strtolower($cap['word']));
			// log_message('debug',$this->session->userdata('word'));
			$data['requester'] = $this->users_model->getUser($user);
			$data['user'] =$this->users_model->getUser($this->input->get('user')) ;
			$this->load->view('popups/addfreind',$data);
		}
		// 1384303991782967
    }
	
	function submitfreindrequest()
    {
		$requesterId = $this->input->post('requesterId');
		$requestFrom = $this->input->post('requestfrom');
		$Message = $this->input->post('requestMessage');
		echo $this->users_model->postFreindshipRequest($requesterId,$requestFrom,$Message);
    }

	function postusermessage()
    {
		$sender = $this->input->post('senderId');
		$recipt = $this->input->post('recipt');
		$message = $this->input->post('message');
		echo $this->users_model->postUserMessage($sender,$recipt,$message);
    }

	
	function sendmessage()
    {
		$fb_data = $this->session->userdata('fb_data');
		$user = isset($fb_data['me']) ? $fb_data['me']['id'] : 1649208165;
		if ($user){

			$data['sender'] = $this->users_model->getUser($user);
			$data['user'] =$this->users_model->getUser($this->input->get('user')) ;
			$this->load->view('popups/sendmessage',$data);
		}
		// 1384303991782967
    }	
	
	function gettab()
    {
		$tab = $this->input->post('tab');
		$userId = $this->input->post('user');
		$data['id'] = $userId;
		$userInfo = $this->users_model->getUser($userId);
		$data['records']['coupons'] = $this->users_model->getCoupons($userId);
		$data['records']['recommands'] = $this->users_model->getRecommands($userId);
		$data['info'] = $userInfo[0];
		$data['records']['last_shops'] = $this->catalog_model->fetch_user_shopping($userId,0,9);
		$data['records']['last_shops_cnt'] = $this->catalog_model->count_user_shops($userId);
		$data['records']['page'] = 'user';
		$data['records']['userId'] = $userId;
		// $data['records']['last_shops_cnt'] = $this->users_model->count_store_shops($storeId);
		$this->load->view('page/user/'.$tab,$data);
    }
	
	function page($userId , $view = null)
    {
			
		$fb_data = $this->session->userdata('fb_data');
		$onlyfreinds = isset($fb_data['me']) ? $fb_data['me']['id'] : 0 ;
		$this->load->model('categories_model');
		$this->load->model('stores_model');
		$shopStores = $this->users_model->getUserShopStores($userId);
		$data['records']['categories'] = $this->categories_model->getAll();
		$data['feed']['latest'] = $this->users_model->getLatestfeed($onlyfreinds);
		$data['feed']['stores'] = $this->stores_model->getAll();
		$data['content']['page'] = 'user';
		$data['content']['user']['id'] = $userId;
		$userInfo = $this->users_model->getUser($userId);
		$data['content']['user']['info'] = $userInfo[0];
		$data['content']['user']['last_shops'] = $this->catalog_model->fetch_user_shopping($userId,0,9);
		$data['content']['user']['last_shops_cnt'] = $this->catalog_model->count_user_shops($userId);
		$data['content']['user']['page'] = 'user';
		$data['content']['user']['userId'] = $userId;
		$data['content']['user']['freinds'] = $this->users_model->getFreindsId($userId);
		$data['content']['user']['shopstores']['locations'] = $this->stores_model->getShopStoreLocation($shopStores);
		$data['content']['user']['view'] = $view;
		$onlyfreinds = 1649208165;
		$data['content']['user']['loginuser'] = $onlyfreinds;
		
		if ($onlyfreinds){
			$data['content']['user']['isFollowed'] = $this->users_model->isFollowed($userId,$onlyfreinds);
			$data['content']['user']['followStatus'] = $this->users_model->getFollowStatus($userId,$onlyfreinds);
			$data['content']['user']['isMyFreind'] = $this->users_model->isMyFreind($userId,$onlyfreinds);
		if(is_numeric($userId)){
			$data['content']['user']['FreindRequest'] = $this->users_model->freindshipRequest($userId,$onlyfreinds);
		}
		} else {
			$data['content']['user']['isFollowed'] = 0;
			$data['content']['user']['followStatus'] = 0;
			$data['content']['user']['isMyFreind'] = 0;
			$data['content']['user']['FreindRequest'] = 0;
		}
		$data['fb_data'] = $fb_data;
		$this->load->view('home',$data);
    }

	
}
