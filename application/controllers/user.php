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
		$onlyfreinds = isset($fb_data['me']) ? $fb_data['me']['id'] : false ;
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
		$data['fb_data'] = $fb_data;
		$this->load->view('home',$data);
    }

	
}
