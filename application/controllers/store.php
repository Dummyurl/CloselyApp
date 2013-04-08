<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Facebook_model');
		$this->load->model('stores_model');
    }

    function popup($storeId)
    {
		$store = $this->stores_model->getStoreInfo($storeId);
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
