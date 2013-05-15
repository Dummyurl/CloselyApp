<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* stdClass Object ( [store_id] => 656644 [store_name] => ברשקה [store_address] => בלבבבבב [store_logo] => 656644.jpg [create_date] => 15/10/88 [description] => כגדכגדכדגגדכדג [phone] => 05244697777 [website] => www.root.co.il [location] => 32.11548300000006,34.77102100000002 [wall_image] => bersh.jpg [time_working] => ימים ראשון עד חמישי מהשעה 9 עד 23 
ימי שישי וערבי חג מ8 עד 14 [id] => 33 [email] => kalvaad@gmail.com [ip_address] => [username] => [password] => 4fe1edde298f8dd3fdefd0527c2415027ffe6f63 [salt] => [activation_code] => [forgotten_password_code] => fa6923e211f308c82ba6d9e4bc31154e8303a29d [forgotten_password_time] => 1368185434 [remember_code] => 6d8a758ca55b1f295daf04ba3780e1692de5cf3e [created_on] => 1368183813 [last_login] => 1368205219 [active] => 1 [first_name] => admin [last_name] => admin [company] => admin [user_id] => 33 )
 */
class Controlpanel extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('ion_auth');
		$this->load->library('grocery_CRUD');	
		$this->load->model('stores_model');
		$this->load->model('categories_model');
		$this->load->model('banners_model');
		
	}
	
	function _cmspage($output = null)
	{
		$this->load->view('cmspage.php',$output);	
	}
	
	function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_cmspage($output);
	}
	
	function index()
	{
		$this->session->set_flashdata('redirect',$this->uri->uri_string());
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		redirect('controlpanel/storeInfo');
	}	
	
	function storeInfo()
	{
		$this->session->set_flashdata('redirect',$this->uri->uri_string());
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		 $storeData = $this->ion_auth->user()->row();
		try{
			
			$crud = new grocery_CRUD();
			$crud->unset_add();
			$crud->unset_delete();
			$crud->set_theme('flexigrid');
			$crud->where('store_id',$storeData->store_id);
			$crud->set_table('stores');
			$crud->set_subject('פרטי העסק');
			$crud->required_fields('store_name','store_address','description','phone','time_working','first_name','last_name','email','store_logo','wall_image');
			$crud->columns('store_name','store_address','create_date','description','phone','website','time_working','first_name','last_name','email','store_logo','wall_image');
			$crud->display_as('store_name','שם העסק')
				->display_as('store_address','כתובת העסק')
				->display_as('description','תאור העסק')
				->display_as('phone','טלפון')
				->display_as('website','כתובת אתר')
				->display_as('time_working','שעות פעילות')
				->display_as('first_name','שם פרטי')
				->display_as('last_name','משפחה')
				->display_as('email','אימייל')
				->display_as('store_logo','לוגו')
				->display_as('wall_image','תמונה ראשית');
			$crud->fields('store_name','store_address','description','phone','website','time_working','first_name','last_name','email','store_logo','wall_image');
			$crud->set_field_upload('store_logo','asset/img/bizlogos');
			$crud->set_field_upload('wall_image','asset/img/bizwalls');
			$output = $crud->render();
			$this->_cmspage($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	function products()
	{
		$this->session->set_flashdata('redirect',$this->uri->uri_string());
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		 $storeData = $this->ion_auth->user()->row();
		try{
			$storeCategoriesId = $this->stores_model->getStoreCategories($storeData->store_id);
 			$websiteCategoriesId = $this->stores_model->getWebsiteCategories($storeData->store_id);
			// print_R($websiteCategoriesId);
 			$storeCategoriesList = array();
			$websiteCategoriesList = array(); 
			foreach($storeCategoriesId as $category){
 				$catNameObj = $this->categories_model->getStoreCategoryName($category->category_id);
				$storeCategoriesList[] =$catNameObj->category_name; 
			}  
  			foreach($websiteCategoriesId as $category){
				$catNameObj = $this->categories_model->getWebsiteCategoryName($category->category_id);
				$websiteCategoriesList[$catNameObj->category_id] = $catNameObj->category_name;
			}  
			/* 	print_R($categoriesList); */
			$crud = new grocery_CRUD();
			$crud->set_theme('flexigrid');
			$crud->where('store_id',$storeData->store_id);
			$crud->set_table('products');
			$crud->set_subject('מוצרים');
			$crud->required_fields('product_name','product_id','description','product_image','website_categories');
			$crud->columns('product_id','product_name','price','description','product_image','store_category','website_categories');
			$crud->display_as('product_name','שם המוצר')
				->display_as('description','תאור המוצר')
				->display_as('product_id','מק"ט')
				->display_as('price','מחיר')
				->display_as('product_image','תמונה')
				->display_as('store_category','קטגוריות בחנות')
				->display_as('website_categories','קטגוריות באתר');
			$crud->fields('store_id','product_name','product_id','description','product_image','store_category','website_categories','url_key');
			$crud->set_field_upload('product_image','asset/img/store/' . $storeData->store_id);
			if ($storeCategoriesList){
				$crud->field_type('store_category','multiselect',$storeCategoriesList);
		    } else {
				$crud->field_type('store_category','invisible');
			}
			if ($websiteCategoriesList){
				$crud->field_type('website_categories','dropdown',$websiteCategoriesList);
		    } else {
				$crud->field_type('website_categories','invisible');
			} 
			$crud->field_type('store_id','invisible');
			$crud->field_type('url_key','invisible');
			$crud->callback_before_insert(array($this,'addproduct'));
			$crud->callback_after_insert(array($this,'saveCategories'));
			$output = $crud->render();
			$this->_cmspage($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
 
 
 
	function saveCategories($post_array,$primary_key){
		$this->categories_model->saveCategory($post_array['website_categories'] ,1, $post_array);
	    $this->categories_model->saveCategory($post_array['store_category'] ,2, $post_array);
	}
 
 function addproduct($post_array){
    $post_array['store_id'] = $this->ion_auth->user()->row()->store_id;
	$post_array['url_key'] = str_replace(" ","_",$post_array['product_name']);
    return $post_array;
}

function test_callback($post_array){
    $post_array['store_id'] = $this->ion_auth->user()->row()->store_id;
    return $post_array;
}
 
 

	function discounts()
	{
		$this->session->set_flashdata('redirect',$this->uri->uri_string());
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		 $storeData = $this->ion_auth->user()->row();
		try{
 			$storeProducts = $this->stores_model->getStoreProducts($storeData->store_id);
 			$storeProductsList = array();
			foreach($storeProducts as $product){
				$storeProductsList[] =$product->product_name; 
			} 			
			$crud = new grocery_CRUD();
			$crud->set_theme('flexigrid');
			$crud->where('store_id',$storeData->store_id);
			$crud->set_table('store_discounts');
			$crud->set_subject('הנחות ומבצעים');
			$crud->required_fields('discount_type','discount_name','discount_end','discount_start');
			$crud->columns('discount_name','discount_type','discount_start','discount_end','discount_products','image');
			$crud->display_as('discount_type','סוג ההנחה /מבצע')
				->display_as('discount_name','שם ההנחה')
				->display_as('discount_end','תאריך סיום')
				->display_as('discount_products','מוצרים המשתתפים במבצע')
				->display_as('image','תמונה')
				->display_as('discount_start','תאריך התחלה');
			$crud->fields('store_id','discount_name','discount_type','discount_start','discount_end','discount_products','image');
			$crud->set_field_upload('image','asset/img/store/' . $storeData->store_id . '/discounts');
			$crud->field_type('store_id','invisible');
 			if ($storeProductsList){
				$crud->field_type('discount_products','multiselect',$storeProductsList);
		    } else {
				$crud->field_type('discount_products','invisible');
			} 
			$crud->callback_before_insert(array($this,'test_callback'));
			$output = $crud->render();
			$this->_cmspage($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function adv()
	{
		$this->session->set_flashdata('redirect',$this->uri->uri_string());
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		 $storeData = $this->ion_auth->user()->row();
		try{
			$posArray = array();
			$bannersPositions = $this->banners_model->getPositions();
			foreach($bannersPositions as $position){
				$posArray[$position->position_name] = $position->position_name; 
			} 
			$crud = new grocery_CRUD();
			$crud->set_theme('flexigrid');
			$crud->where('store_id',$storeData->store_id);
			$crud->set_table('banners');
			$crud->set_subject('באנרים');
			$crud->required_fields('banner_name','link','position','start_date','end_date','image');
			$crud->columns('banner_id','banner_name','link','position','start_date','end_date','days','costperday','cost','image');
			$crud->display_as('banner_name','כותרת הבאנר')
				->display_as('position','מיקום')
				->display_as('page','עמוד')
				->display_as('start_date','תאריך התחלה')
				->display_as('end_date','תאריך סיום')
				->display_as('image','באנר')
				->display_as('cost','סה"כ מחיר')
				->display_as('costperday','מחיר ליום')
				->display_as('link','קישור לבאנר')
				->display_as('days','משך הפרסום');
			$crud->fields('store_id','banner_name','link','position','start_date','end_date','image','cost','costperday','days');
			$crud->set_field_upload('image','asset/img/store/' . $storeData->store_id . '/banners');
			$crud->field_type('store_id','invisible');
			$crud->field_type('cost','invisible');
			$crud->field_type('days','invisible');
			$crud->field_type('costperday','invisible');
			$crud->field_type('position','dropdown',$posArray);
			$crud->callback_before_insert(array($this,'add_fields'));
			$crud->callback_before_update(array($this,'add_fields'));
			$output = $crud->render();
			$this->_cmspage($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function add_fields($post_array){
		$bannerCostPerDay = $this->banners_model->getCost($post_array['position']);
		// print_r($bannerCostPerDay);
		 $start = $post_array['start_date'];
		$end = $post_array['end_date'];
		$days_between = $end - $start; 
		$post_array['store_id'] = $this->ion_auth->user()->row()->store_id;
		 $post_array['cost'] = $bannerCostPerDay[0]->costperday * $days_between; 
		$post_array['costperday'] = $bannerCostPerDay[0]->costperday;
		$post_array['days'] = $days_between;
		return $post_array;
	}
	
	function setting()
	{
		$this->session->set_flashdata('redirect',$this->uri->uri_string());
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		 $storeData = $this->ion_auth->user()->row();
		try{
			
			$crud = new grocery_CRUD();
			$crud->unset_add();
			$crud->unset_delete();
			$crud->set_theme('flexigrid');
			$crud->where('store_id',$storeData->store_id);
			$crud->set_table('store_discounts');
			$crud->set_subject('הגדרות');
			$crud->required_fields('discount_type','discount_name','discount_duration','discount_products','discount_start');
			$crud->columns('discount_name','discount_type','discount_start','discount_duration','discount_products','image');
			$crud->display_as('discount_type','סוג ההנחה /מבצע')
				->display_as('discount_name','שם ההנחה')
				->display_as('discount_duration','משך ההנחה')
				->display_as('discount_products','מוצרים המשתתפים במבצע')
				->display_as('image','תמונה')
				->display_as('yes','תמונה')
				->display_as('discount_start','תאריך התחלת המבצע');
			$crud->fields('store_id','discount_name','discount_type','discount_start','discount_duration','discount_products','image');
			$crud->set_field_upload('image','asset/img/store/' . $storeData->store_id . '/discounts');
			$crud->field_type('store_id','invisible');
			$crud->callback_before_insert(array($this,'test_callback'));
			$output = $crud->render();
			$this->_cmspage($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
		function reports()
	{
		$this->session->set_flashdata('redirect',$this->uri->uri_string());
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		 $storeData = $this->ion_auth->user()->row();
		try{
			
			$crud = new grocery_CRUD();
			$crud->set_theme('flexigrid');
			$crud->where('store_id',$storeData->store_id);
			$crud->set_table('store_discounts');
			$crud->set_subject('הנחות ומבצעים');
			$crud->required_fields('discount_type','discount_name','discount_duration','discount_products','discount_start');
			$crud->columns('discount_name','discount_type','discount_start','discount_duration','discount_products','image');
			$crud->display_as('discount_type','סוג ההנחה /מבצע')
				->display_as('discount_name','שם ההנחה')
				->display_as('discount_duration','משך ההנחה')
				->display_as('discount_products','מוצרים המשתתפים במבצע')
				->display_as('image','תמונה')
				->display_as('discount_start','תאריך התחלת המבצע');
			$crud->fields('store_id','discount_name','discount_type','discount_start','discount_duration','discount_products','image');
			$crud->set_field_upload('image','asset/img/store/' . $storeData->store_id . '/discounts');
			$crud->field_type('store_id','invisible');
			$crud->callback_before_insert(array($this,'test_callback'));
			$output = $crud->render();
			$this->_cmspage($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	function messages()
	{
		$this->session->set_flashdata('redirect',$this->uri->uri_string());
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
		 $storeData = $this->ion_auth->user()->row();
		try{
			
			$crud = new grocery_CRUD();
			$crud->set_theme('flexigrid');
			$crud->where('store_id',$storeData->store_id);
			$crud->set_table('store_discounts');
			$crud->set_subject('הנחות ומבצעים');
			$crud->required_fields('discount_type','discount_name','discount_duration','discount_products','discount_start');
			$crud->columns('discount_name','discount_type','discount_start','discount_duration','discount_products','image');
			$crud->display_as('discount_type','סוג ההנחה /מבצע')
				->display_as('discount_name','שם ההנחה')
				->display_as('discount_duration','משך ההנחה')
				->display_as('discount_products','מוצרים המשתתפים במבצע')
				->display_as('image','תמונה')
				->display_as('discount_start','תאריך התחלת המבצע');
			$crud->fields('store_id','discount_name','discount_type','discount_start','discount_duration','discount_products','image');
			$crud->set_field_upload('image','asset/img/store/' . $storeData->store_id . '/discounts');
			$crud->field_type('store_id','invisible');
			$crud->callback_before_insert(array($this,'test_callback'));
			$output = $crud->render();
			$this->_cmspage($output);
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function orders_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_relation('customerNumber','customers','{contactLastName} {contactFirstName}');
			$crud->display_as('customerNumber','Customer');
			$crud->set_table('orders');
			$crud->set_subject('Order');
			$crud->unset_add();
			$crud->unset_delete();
			
			$output = $crud->render();
			
			$this->_cmspage($output);
	}
	
	function products_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('products');
			$crud->set_subject('Product');
			$crud->unset_columns('productDescription');
			$crud->callback_column('buyPrice',array($this,'valueToEuro'));
			
			$output = $crud->render();
			
			$this->_cmspage($output);
	}	
	
	function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}
	
	function film_management()
	{
		$crud = new grocery_CRUD();
		
		$crud->set_table('film');
		$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
		$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
		$crud->unset_columns('special_features','description','actors');
		
		$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');
		
		$output = $crud->render();
		
		$this->_cmspage($output);
	}
	
}