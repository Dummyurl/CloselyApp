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
		$this->load->model('products_model');
    }


	function categoryInfo($id)
	{
		
		 $data['info'] = $this->categories_model->getCategoryInfo($id);
		 $data['subcategories'] = $this->categories_model->getSubCategories($id);
		 $this->load->view('catalog/categories/subcategories',$data);
	}
	
	function getProduct()
    {
		$productId = $this->input->post('id');	
		$storeId = $this->input->post('store');	
		$data['info'] = $this->products_model->jsonInfo($storeId,$productId);
		$this->load->view('catalog/shopproduct',$data);
	}
	
	function getview()
    {	
		$tab = $this->input->post('tab');
		$categoryId = $this->input->post('category');	
		$view = $this->input->post('view');	
		$freinds = json_decode($this->input->post('freinds'));
		
		$data['categoryId'] = $categoryId;
		$data['view'] = $view;
		$data['freinds'] = $freinds;
		$data['page'] = 'category';
		
		if ($view == 2){
			$data['all_switch'] = '';
			$data['freinds_switch'] = 'selected_switch';
		} else {
			$data['all_switch'] = 'selected_switch';
			$data['freinds_switch'] = '';
		}
		switch ($tab) {
			case 'catshops':
				$table = 'shopping';
				$data['last_shops_cnt'] = $this->categories_model->countShops($categoryId);
				$data['last_shops'] = $this->categories_model->getRecords($table , $categoryId ,$view , $freinds,0,9);
				$this->load->view('blocks/shops',$data);
				break;
			case 'catcoupons':
				$table = 'coupons';
				$data['coupons'] = $this->categories_model->getRecords($table , $categoryId ,$view , $freinds,0,18);
				$this->load->view('blocks/bannerslist',$data);
				break;
			case 'catrecommands':
				$table = 'recommands';
				$data['recommands'] = $this->categories_model->getRecords($table , $categoryId ,$view , $freinds,0,9);
				$this->load->view('blocks/store_recommands',$data);
				break;
			case 'catproducts':
				$table = 'products';
				$data['products'] = $this->catalog_model->getProducts($categoryId ,1,0,9);
				$this->load->view('blocks/category_products',$data);
				break;
		}	

			
	}
	
	function gettab()
    {
		$tab = $this->input->post('tab');
		$categoryId = $this->input->post('category');	
		$view = $this->input->post('view');	
		$freinds = json_decode($this->input->post('freinds'));
		$data['categoryId'] = $categoryId;
		$data['view'] = $view;
		$data['freinds'] = $freinds;
		$data['page'] = 'category';

		switch ($tab) {
			case 'catshops':
				$table = 'shopping';
				$data['last_shops_cnt'] = $this->categories_model->countShops($categoryId);
				$data['last_shops'] = $this->categories_model->getRecords($table , $categoryId ,$view , $freinds,0,9);
				$this->load->view('blocks/shops',$data);
				break;
			case 'catcoupons':
				$table = 'coupons';
				$data['coupons'] = $this->categories_model->getRecords($table , $categoryId ,$view , $freinds,0,18);
				$this->load->view('blocks/bannerslist',$data);
				break;
			case 'catrecommands':
				$table = 'recommands';
				$data['recommands'] = $this->categories_model->getRecords($table , $categoryId ,$view , $freinds,0,9);
				$this->load->view('blocks/store_recommands',$data);
				break;
			case 'catproducts':
				$table = 'products';
				$data['products'] = $this->catalog_model->getProducts($categoryId ,1,0,9);
				$this->load->view('blocks/category_products',$data);
				break;
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
		$data['content']['category']['isloggin'] = $onlyfreinds;
		$data['content']['category']['subCategories'] = $this->categories_model->getSubCategories($id);
		$data['content']['category']['stores'] = $this->categories_model->getStoresInCategory($id);
		$data['content']['category']['view'] = $view;
		$data['content']['category']['coupons'] = $this->categories_model->getCoupons($id);
		$data['content']['category']['recommands'] = $this->categories_model->getRecommands($id);
		$data['content']['category']['shops']['last_shops'] = $this->categories_model->getShops($id,0,9);
		$data['content']['category']['shops']['last_shops_cnt'] = $this->categories_model->countShops($id);
		$data['content']['category']['shops']['page'] = 'category';
		$data['content']['category']['shops']['view'] = $view;
		$data['content']['category']['shops']['freinds'] = 1;
		$data['content']['category']['shops']['categoryId'] = $id;
		
		$data['fb_data'] = $fb_data;
		$data['content']['category']['freinds'] = null;
		if ($onlyfreinds){
			$freindslist = $this->users_model->getFreindsId($onlyfreinds);
			$data['content']['category']['freinds'] = $freindslist;
		
		}
		$this->load->view('home',$data);
	}
	
	function product($stroeName,$urlName)
	{
		$storeId = $this->stores_model->getStoreId($stroeName);
		$fb_data = $this->session->userdata('fb_data');
		$onlyfreinds = isset($fb_data['me']) ? $fb_data['me']['id'] : false ;
		$data['records']['categories'] = $this->categories_model->getAll();
		$data['feed']['latest'] = $this->users_model->getLatestfeed($onlyfreinds);
		$data['feed']['stores'] = $this->stores_model->getAll();
		$data['content']['page'] = 'product';
		$productId = $this->products_model->getProductId($urlName);
		$data['content']['product']['id'] = $productId;
		$data['content']['product']['urlName'] = $urlName;
		$data['content']['product']['info'] = $this->products_model->getInfo($storeId,$productId);
		$data['content']['product']['stores'] = $this->products_model->getStores($productId);
		$data['content']['product']['buyers'] = $this->products_model->getBuyers($productId);
		$data['content']['product']['blocks']['comments'] =  $this->catalog_model->getProductRecommands($productId);
		$data['content']['product']['iRateThisProduct'] = $this->products_model->ratedProduct($storeId,$productId,$onlyfreinds);
		$data['content']['product']['iBuyThisProduct'] = $this->products_model->checkForBuyer($storeId,$productId,$onlyfreinds);
		$data['content']['product']['totalRating'] = $this->products_model->getProductRating($storeId,$productId);
		$data['content']['product']['raters'] = $this->products_model->getRaterNum($storeId,$productId);
		$data['content']['product']['userId'] = $onlyfreinds ? $onlyfreinds : 0;
		$data['fb_data'] = $fb_data;
		$this->load->view('home',$data);
	}
	
		function shop($id)
	{
		$fb_data = $this->session->userdata('fb_data');
		$onlyfreinds = isset($fb_data['me']) ? $fb_data['me']['id'] : false ;
		$info = $this->catalog_model->getShopInfo($id);
		$mainProductId = $info[0]->main_product;
		$userId = $info[0]->user_id;
		$coupon = $this->catalog_model->getCoupon($info[0]->coupon_id);
		$storeId = $info[0]->store_id;
		$userName  = $this->users_model->getUserName($userId);
		$store = $this->stores_model->getStoreInfo($storeId);
		$products = $this->catalog_model->getShopProductsIds($id);
		$data['records']['categories'] = $this->categories_model->getAll();
		$data['feed']['latest'] = $this->users_model->getLatestfeed($onlyfreinds);
		$data['feed']['stores'] = $this->stores_model->getAll();
		$data['pageInfo']['title'] =  'אהבתי את הקנייה של' . $userName . 'בשופיקס';
		$data['pageInfo']['type'] =  $info[0]->shop_title;
		$data['pageInfo']['url'] =  base_url() . '/catalog/shop/' . $info[0]->shop_id;
		$data['pageInfo']['image'] =  base_url() . 'asset/img/store/' . $storeId .'/'. $info[0]->shop_image;
		$data['pageInfo']['site_name'] =  'Shoppix אתר שיתוף הקניות הראשון בישראל'; 
		$data['pageInfo']['description'] =  $info[0]->shop_description; 
		$data['content']['page'] = 'shop';
		$data['content']['shop']['id'] = $id;
		$data['content']['shop']['shopProducts'] = $this->catalog_model->getShopProducts($products,$storeId);
		$data['content']['shop']['info'] = $info[0];
		$data['content']['shop']['mainProduct'] = $this->products_model->getInfo($storeId,$mainProductId);
		$data['content']['shop']['store'] = $store[0];
		$data['content']['shop']['storeId'] = $storeId;
		$data['content']['shop']['coupon']['coupon'] =  $coupon[0];
		$data['content']['shop']['coupon']['store'] =  $store[0];
		$data['content']['shop']['coupon']['shop'] =  $info[0];
		$data['content']['shop']['coupon']['userId'] =  $userId;
		$data['content']['shop']['coupon']['user'] =  $userName;
		$data['content']['shop']['blocks']['comments'] =  $this->catalog_model->getShopComments($id);
		$data['fb_data'] = $fb_data;
		$this->load->view('home',$data);
	}
	
	
}
