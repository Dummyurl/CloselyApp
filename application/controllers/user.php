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
		$data['userId'] = $userId;
		$data['userName'] = $this->users_model->getUserName($userId);
		$data['actions']['shops'] = $this->users_model->countShops($userId);
		$data['actions']['coupons'] = $this->users_model->countCoupons($userId);
		$data['shops'] = $this->users_model->getShops($userId);
		$data['actions']['recommands'] = $this->users_model->countRecommands($userId);
		$this->load->view('popups/user',$data);
    }
	
	function index()
    {

    }

	
}
