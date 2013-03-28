<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shops extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Facebook_model');
		$this->load->model('catalog_model');
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
		$this->load->view('popups/shop',$data);
	}
}
