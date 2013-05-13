<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Facebook_model');
		$this->load->model('catalog_model');
    }

    function popup($productId)
    {

    }
	
    function index($page)
    {
		$store = $this->input->post('store');
 		$requested_page = $page;
		$offset = (($requested_page - 1) * 9);
		$data['products'] = $this->catalog_model->fetch_store_products($store,$offset , 9) ;
		$this->load->view('catalog/productscroll',$data); 
	}

	function view($productId)
    {

	}
	
}
