<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Facebook_model');
		$this->load->model('users_model');
    }

    function popup($userId)
    {
		$data=array();
		$this->load->view('popups/user',$data);
    }
	
	function index()
    {

    }

	
}
