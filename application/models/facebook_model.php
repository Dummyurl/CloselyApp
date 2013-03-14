<?php
class Facebook_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		
		$config = array(
						'appId'  => '233297683465645',
						'secret' => 'de692723f1d70b69e1edbae46c5ce0a8',
						'fileUpload' => true, // Indicates if the CURL based @ syntax for file uploads is enabled.
						);
		
		$this->load->library('Facebook', $config);
		
		$user = $this->facebook->getUser();

		// We may or may not have this data based on whether the user is logged in.
		//
		// If we have a $user id here, it means we know the user is logged into
		// Facebook, but we don't know if the access token is valid. An access
		// token is invalid if the user logged out of Facebook.
		$profile = null;
		$friends = null;
		$likes = null;
		$data = array();
		if($user)
		{
			try {
			    // Proceed knowing you have a logged in user who's authenticated.
				$profile = $this->facebook->api('/me');
				$friends = $this->facebook->api('/me/friends?limit=1000');
				$likes = $this->facebook->api('/me/likes');
				$this->load->model('users_model');
				$data = array('info' => $profile , 'freinds' => $friends , 'likes' => $likes);
				$this->users_model->updateMembers($data);
			} catch (FacebookApiException $e) {
				error_log($e);
			    $user = null;
			}		
		}
		
		$fb_data = array(
						'me' => $profile,
						'uid' => $user,
						'loginUrl' => $this->facebook->getLoginUrl(
							array(
								'scope' => 'manage_pages,user_likes,user_checkins,user_activities,publish_checkins,create_event,ads_management,read_friendlists,email,read_stream, publish_stream, user_birthday, user_location, user_hometown, user_photos', // app permissions
								'redirect_uri' => 'http://getlike.net' // URL where you want to redirect your users after a successful login
							)
						),
						'logoutUrl' => $this->facebook->getLogoutUrl(),
					);

		$this->session->set_userdata('fb_data', $fb_data);
		
	}
	

	
	
}

