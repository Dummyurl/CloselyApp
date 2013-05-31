<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Facebook_model');
		$this->load->model('catalog_model');
		$this->load->model('categories_model');
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
	
	function category($page)
    {
		$category = $this->input->post('category');
 		$requested_page = $page;
		$offset = (($requested_page - 1) * 9);
		$data['products'] = $this->categories_model->getProducts($category ,1, $offset,9) ;
		$this->load->view('catalog/productscroll',$data); 
	}
	
	function rateproduct()
    {
		$ip = $this->input->ip_address();
		$rating = $this->input->post('rating');
		$productId = $this->input->post('product');	
		$storeId = $this->input->post('store');
		if(!$this->catalog_model->getRate($productId,$rating,$storeId,$ip)){
			if (!get_cookie('rateProduct-' . $productId . '-' . $storeId)) {
			// cookie not set, first visit

			// create cookie to avoid hitting this case again
			$cookie = array(
				'name'   => 'rateProduct-' . $productId . '-' . $storeId,
				'value'  => $rating,
				'expire' => time()+86500,
				'prefix' => '',
			);
			set_cookie($cookie);
			}
		}
				
    }

	function view($productId)
    {

	}
	
}
