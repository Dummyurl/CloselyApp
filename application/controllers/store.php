<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Facebook_model');
		$this->load->model('stores_model');
		$this->load->model('users_model');
		$this->load->model('coupons_model');
		$this->load->model('catalog_model');
    }

    function popup($storeId)
    {
		$store = $this->stores_model->getStoreInfo($storeId);
		$data['location']['point'] =  $this->stores_model->getlocation($storeId);
		$data['location']['info'] =  $store[0];
		$data['customers'] =  $this->stores_model->getLastCustomers($storeId);
		$data['lastRecommands'] = $this->stores_model->getLastRecommands($storeId);
		$data['store']= $store[0];
		$this->load->view('popups/store',$data);
    }
	
	function index()
    {

    }

	function gettab()
    {
		$tab = $this->input->post('tab');
		$storeId = $this->input->post('store');
		$data['id'] = $storeId;
		$data['records']['coupons'] = $this->coupons_model->get_store_coupons($storeId);
		$data['records']['last_shops'] = $this->catalog_model->fetch_store_shops($storeId,0,9);
		$data['records']['last_shops_cnt'] = $this->catalog_model->count_store_shops($storeId);
		$this->load->view('page/store/'.$tab,$data);
    }
	
	function page($storeId)
    {
		$fb_data = $this->session->userdata('fb_data');
		$onlyfreinds = isset($fb_data['me']) ? $fb_data['me']['id'] : false ;
		$this->load->model('categories_model');
		$this->load->model('stores_model');
		$data['records']['categories'] = $this->categories_model->getAll();
		$data['feed']['latest'] = $this->users_model->getLatestfeed($onlyfreinds);
		$data['feed']['stores'] = $this->stores_model->getAll();
		$data['content']['page'] = 'store';
		$data['content']['store'] = $storeId;
		$store = $this->stores_model->getStoreInfo($storeId);
		$data['content']['store']['info'] = $store[0];
		if ($onlyfreinds){
			$data['content']['records']['freinds'] = $this->users_model->getFreindsId($onlyfreinds);	
		}
		
		$data['fb_data'] = $fb_data;
		$this->load->view('home',$data);
	}
	
}
