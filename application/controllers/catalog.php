<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Facebook_model');
		$this->load->model('categories_model');
		$this->load->model('stores_model');
		$this->load->model('users_model');
    }


	function categoryInfo($id)
	{
		 $data['info'] = $this->categories_model->getCategoryInfo($id);
		 $data['subcategories'] = $this->categories_model->getSubCategories($id);
		 $this->load->view('catalog/categories/subcategories',$data);
	}
	
	function category($id)
	{		
		$fb_data = $this->session->userdata('fb_data');
		$onlyfreinds = isset($fb_data['me']) ? $fb_data['me']['id'] : false ;
		$data['records']['categories'] = $this->categories_model->getAll();
		$data['feed']['latest'] = $this->users_model->getLatestfeed($onlyfreinds);
		$data['feed']['stores'] = $this->stores_model->getAll();
		$data['content']['page'] = 'category';
		$data['content']['category'] = $id;
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
