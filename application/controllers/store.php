<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Facebook_model');
    }

    function popup($storeId)
    {
		$this->load->view('popups/store',$data);
    }
	
	function index()
    {

    }

	function view($storeId)
    {

	}
	
}
