<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Facebook_model');
    }
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		//$this->load->model('Categories');
        // $data['query'] = $this->Categories->get_parents();
		$this->load->model('categories_model');
		$data['records']['categories'] = $this->categories_model->getAll();
		// Load model for coupons block
		$this->load->model('coupons_model');
		$data['content']['records']['coupons'] = $this->coupons_model->getAll();
		$data['content']['page'] = 'home';
		// Load model for shops block		
		$this->load->model('catalog_model');
		$data['content']['records']['last_shops'] = $this->catalog_model->fetch_shops(0,9);
		$data['content']['records']['last_shops_cnt'] = $this->catalog_model->countAll();
		$fb_data = $this->session->userdata('fb_data');
		// Load model for USERS	
		$this->load->model('users_model');
		$onlyfreinds = isset($fb_data['me']) ? $fb_data['me']['id'] : false ;
		$data['feed']['latest'] = $this->users_model->getLatestfeed($onlyfreinds);
		$this->load->model('stores_model');
		$data['feed']['stores'] = $this->stores_model->getAll();
		 $data['content']['blocks'] = array('slider','banners','shops');
		 $data['fb_data'] = $fb_data;
		$this->load->view('home',$data);
	}
	
	function topsecret()
	{
		$fb_data = $this->session->userdata('fb_data');
		$this->load->helper('url'); 
		if((!$fb_data['uid']) or (!$fb_data['me']))
		{
			redirect('main');
		}
		else
		{
			$data = array(
						'fb_data' => $fb_data,
						);
			
			$this->load->view('topsecret', $data);
		}
	}
	

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */