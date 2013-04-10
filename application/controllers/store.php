<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Facebook_model');
		$this->load->model('stores_model');
		$this->load->model('users_model');
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

	function view($storeId)
    {

	}
	
}
