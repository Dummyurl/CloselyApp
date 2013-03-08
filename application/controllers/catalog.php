<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Facebook_model');
    }


	function categoryInfo($id)
	{
		 $this->load->model('categories_model');
		 $data['info'] = $this->categories_model->getCategoryInfo($id);
		 $data['subcategories'] = $this->categories_model->getSubCategories($id);
		 $this->load->view('catalog/categories/subcategories',$data);
	}
	
	
}
