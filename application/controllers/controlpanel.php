<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlpanel extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('ion_auth');
		$this->load->library('grocery_CRUD');	
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
		try{
			$crud = new grocery_CRUD();
			$crud->set_theme('flexigrid');
			$crud->where('store_id','656644');
			$crud->set_table('stores');
			$crud->set_subject('קניות שבוצעו בחנות');
			$crud->required_fields('store_name','store_address','description','phone','website','time_working');
			$crud->columns('store_id','store_name','store_address','create_date','description','phone','website','time_working');
			$crud->display_as('store_name','שם העסק')->display_as('store_address','כתובת העסק');
			$crud->edit_fields('store_name','store_address','description','phone','website','time_working');
			$output = $crud->render();
			
			$this->_cmspage($output);
			 print_r($user = $this->ion_auth->user()->row());
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	function hidden_test($office_id = 0)
{
    $crud = new grocery_CRUD();
 
    $crud->set_table('customers');
    $crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
    $crud->display_as('salesRepEmployeeNumber','from Employeer');
    $crud->set_subject('Customer');
    $crud->set_relation('salesRepEmployeeNumber','employees','lastName');
    $crud->add_fields('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit','office_id');
    $crud->edit_fields('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
 
    $crud->field_type('office_id', 'hidden', $office_id);
 
    $output = $crud->render();
 
    $this->_cmspage($output);
}   

	function employees_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->set_table('employees');
			$crud->set_relation('officeCode','offices','city');
			$crud->display_as('officeCode','Office City');
			$crud->set_subject('Employee');
			
			$crud->required_fields('lastName');
			
			$crud->set_field_upload('file_url','assets/uploads/files');
			
			$output = $crud->render();

			$this->_cmspage($output);
	}
	
	function customers_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('customers');
			$crud->columns('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit');
			$crud->display_as('salesRepEmployeeNumber','from Employeer')
				 ->display_as('customerName','Name')
				 ->display_as('contactLastName','Last Name');
			$crud->set_subject('Customer');
			$crud->set_relation('salesRepEmployeeNumber','employees','lastName');
			
			$output = $crud->render();
			
			$this->_cmspage($output);
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