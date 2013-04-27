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

	function getview()
    {	
		$tab = $this->input->post('tab');
		$storeId = $this->input->post('store');	
		$view = $this->input->post('view');	
		$freinds = json_decode($this->input->post('freinds'));
		$actionsData = $this->stores_model->getRecords($tab , $storeId ,$view , $freinds);

		switch ($tab) {
			case 'shopping':
				$pagetab = 'freindsshop';
				$data['records']['last_shops'] = $actionsData;
				break;
			case 'coupons':
				$pagetab = 'storecoupons';
				$data['records']['coupons'] = $actionsData;
				break;
			case 'recommands':
				$pagetab = 'storerecommand';
				$data['records']['recommands'] = $actionsData;
				break;
		}	
		if ($view == 2){
			$data['all_switch'] = '';
			$data['freinds_switch'] = 'selected_switch';
		} else {
			$data['all_switch'] = 'selected_switch';
			$data['freinds_switch'] = '';
		}
		$this->load->view('page/store/'.$pagetab,$data);	
	}
	
	function gettab()
    {
		$tab = $this->input->post('tab');
		$storeId = $this->input->post('store');
		$data['id'] = $storeId;
		$data['current_tab'] = '';
		switch ($tab) {
			case 'freindsshop':
				$data['current_tab'] = 'shopping';
				break;
			case 'storecoupons':
				$data['current_tab'] = 'coupons';
				break;
			case 'storerecommands':
				$data['current_tab'] = 'recommands';
				break;
		}
		$data['isloggin'] = $this->input->post('loggin');
		$data['freinds'] = $this->input->post('freinds');
		$storeInfo = $this->stores_model->getStoreInfo($storeId);
		$data['records']['coupons'] = $this->coupons_model->get_store_coupons($storeId);
		$data['records']['recommands'] = $this->stores_model->getRecommands($storeId);
		$data['info'] = $storeInfo[0];
		$data['loadmap'] = 1;
		$data['branches']['locations'] = $this->stores_model->getBranches($storeId);
		$data['records']['last_shops'] = $this->catalog_model->fetch_store_shops($storeId,0,9);
		$data['records']['last_shops_cnt'] = $this->catalog_model->count_store_shops($storeId);
		$data['all_switch'] = 'selected_switch';
		$data['freinds_switch'] = '';
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
		$data['content']['store']['id'] = $storeId;
		$storeInfo = $this->stores_model->getStoreInfo($storeId);
		$data['content']['store']['info'] = $storeInfo[0];
		$data['content']['store']['isloggin'] = $onlyfreinds;
		$data['content']['store']['current_tab'] = 'shopping';
		$data['content']['store']['branches']['locations'] = $this->stores_model->getBranches($storeId);
		$data['content']['store']['recommandsCnt'] = $this->stores_model->recommandsCnt($storeId);
		$data['content']['store']['couponsCnt'] = $this->stores_model->couponsCnt($storeId);
		$data['content']['store']['shopsCnt'] = $this->stores_model->shopsCnt($storeId);
		$data['content']['store']['freinds'] = null;
		if ($onlyfreinds){
			$freindslist = $this->users_model->getFreindsId($onlyfreinds);
			$data['content']['records']['freinds'] = $freindslist;
			$data['content']['store']['freinds'] = $freindslist;			
		}
		
		$data['fb_data'] = $fb_data;
		$this->load->view('home',$data);
	}
	
}
