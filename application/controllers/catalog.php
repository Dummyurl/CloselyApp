<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Facebook_model');
		$this->load->model('categories_model');
		$this->load->model('stores_model');
		$this->load->model('users_model');
		$this->load->model('catalog_model');
		$this->load->model('coupons_model');
    }


	function categoryInfo($id)
	{
		 $data['info'] = $this->categories_model->getCategoryInfo($id);
		 $data['subcategories'] = $this->categories_model->getSubCategories($id);
		 $this->load->view('catalog/categories/subcategories',$data);
	}
	
	function gettab()
    {
		$tab = $this->input->post('tab');
		$id = $this->input->post('category');
		switch ($tab) {
			case 'catshops':
				$data['last_shops'] = $this->categories_model->getShops($id);
				$this->load->view('blocks/shops',$data);
				break;
			case 'catcoupons':
				$data['coupons'] = $this->categories_model->getCoupons($id);
				$this->load->view('blocks/bannerslist',$data);
				break;
			case 'catrecommands':
				$data['recommands'] = $this->categories_model->getRecommands($id);
				$this->load->view('blocks/store_recommands',$data);
				break;
			case 'catproducts':
				$this->load->view('blocks/products',$data);
				break;
			default:
			   echo "i is not equal to 0, 1 or 2";
		}
    }
	
	
	function category($urlName,$view = null)
	{		
		$fb_data = $this->session->userdata('fb_data');
		$onlyfreinds = isset($fb_data['me']) ? $fb_data['me']['id'] : false ;
		$data['records']['categories'] = $this->categories_model->getAll();
		$data['feed']['latest'] = $this->users_model->getLatestfeed($onlyfreinds);
		$data['feed']['stores'] = $this->stores_model->getAll();
		$data['content']['page'] = 'category';
		$data['content']['category']['urlName'] = $urlName;
		$id = $this->categories_model->getCategoryId($urlName);
		$data['content']['category']['id'] = $id;
		$data['content']['category']['info'] = $this->categories_model->getCategoryInfo($id);
		$data['content']['category']['all_switch'] = 'selected_switch';
		$data['content']['category']['freinds_switch'] = '';
		$data['content']['category']['subCategories'] = $this->categories_model->getSubCategories($id);
		$data['content']['category']['stores'] = $this->categories_model->getStoresInCategory($id);
		$data['content']['category']['view'] = $view;
		$data['content']['category']['coupons'] = $this->categories_model->getCoupons($id);
		$data['content']['category']['recommands'] = $this->categories_model->getRecommands($id);
		$data['content']['category']['shops']['last_shops'] = $this->categories_model->getShops($id);
		$data['fb_data'] = $fb_data;
		$this->load->view('home',$data);
	}
	
	function product($id)
	{
		$fb_data = $this->session->userdata('fb_data');
		$onlyfreinds = isset($fb_data['me']) ? $fb_data['me']['id'] : false ;
		$data['records']['categories'] = $this->categories_model->getAll();
		$data['feed']['latest'] = $this->users_model->getLatestfeed($onlyfreinds);
		$data['feed']['stores'] = $this->stores_model->getAll();
		$data['content']['page'] = 'product';
		$data['content']['product'] = $id;
		$data['fb_data'] = $fb_data;
		$this->load->view('home',$data);
	}
	
		function shop($id)
	{
		$fb_data = $this->session->userdata('fb_data');
		$onlyfreinds = isset($fb_data['me']) ? $fb_data['me']['id'] : false ;
		$data['records']['categories'] = $this->categories_model->getAll();
		$data['feed']['latest'] = $this->users_model->getLatestfeed($onlyfreinds);
		$data['feed']['stores'] = $this->stores_model->getAll();
		$data['content']['page'] = 'shop';
		$data['content']['shop'] = $id;
		$data['fb_data'] = $fb_data;
		$this->load->view('home',$data);
	}
	
	
}
