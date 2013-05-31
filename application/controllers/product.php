<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller {

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
	
	
	function sortStores()
    {
		$order = $this->input->post('order');
		$sortBy = $this->input->post('attribute');
		$stores = json_decode($this->input->post('data'),true);
		
		foreach ($stores as $key => $row) {
		 $storeInfo = $this->catalog_model->getStoreInfo($row['store_id']);
			$row['logo'] = $storeInfo[0]->store_logo;
			$attr[$key]  = $row[$sortBy];			
		}
		if($order == 'desc'){
				array_multisort($attr, SORT_DESC, $stores);
		} else {
				array_multisort($attr, SORT_ASC, $stores);
		}
		 $data['stores'] = $stores ;
		 $this->load->view('blocks/product_stores',$data);
    }
	
	
	function rateproduct()
    {
		$rating = $this->input->post('rating');
		$user = $this->input->post('user');
		$productId = $this->input->post('product');	
		$storeId = $this->input->post('store');


		if(!$this->catalog_model->getRate($productId,$rating,$storeId,$user)){
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
