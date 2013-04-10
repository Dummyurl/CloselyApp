<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shops extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Facebook_model');
		$this->load->model('catalog_model');
		$this->load->model('stores_model');
		$this->load->model('users_model');

		
    }

    function index($page)
    {
		$requested_page = $page;
		$offset = (($requested_page - 1) * 9);
		$data['shops'] = $this->catalog_model->fetch_shops($offset , 9) ;
		$this->load->view('catalog/shopscroll',$data);
	}
	
	function view($userId)
    {

	}
	
	function popup($shopId)
    {
		$info = $this->catalog_model->getShopInfo($shopId);
		$userId = $info[0]->user_id;
		$data['shop'] = $info[0];
		$storeId = $info[0]->store_id;
		$store = $this->stores_model->getStoreInfo($storeId);
		$data['location']['point'] =  explode(",",$store[0]->location);
		$data['location']['info'] =  $store[0];
		$coupon = $this->catalog_model->getCoupon($info[0]->coupon_id);
		$data['coupon']['coupon'] =  $coupon[0];
		$data['coupon']['store'] =  $store[0];
		$data['coupon']['shop'] =  $info[0];
		$data['coupon']['userId'] =  $userId;
		$data['coupon']['user'] =  $this->users_model->getUserName($userId);
		$data['category'] =  $this->catalog_model->getCategory($info[0]->shop_category);
		$data['lastRecommands'] = $this->stores_model->getLastRecommands($storeId);
		$this->load->view('popups/shop',$data);
	}
}
