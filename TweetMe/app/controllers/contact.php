<?php 

/**
 * =================
 * Contact Controller
 * =================
 */
class Contact extends Controller{

	public function index($param = ''){

		/*
		 * Check if session has the user_email set otherwise redirect back  	
		 */
		if( Session::get('user_email') ){


			$user = $this->model('User');

			/**
			 * Show who is following the user
			 */
			if($param == 'followers'){
				$followers = $user->getFollowers();
				$this->view('contact/followers', $followers);
			}

			/**
			 * Show who the user is following
			 */
			else if($param == 'following'){
				$following = $user->getFollowing();
				$this->view('contact/following', $following);
			}

			/**
			 * Show main contact page
			 */
			else{
				$allUsers = $user->getAllUserInfo();
				$this->view('contact/index', $allUsers);
			}


		} else {
			// Redirect to Home page
			header('Location:'.  BASE_URI . 'login/index');
		}
	}

	/**
	 * Follow user in Contacts
	 */
	public function follow($userIdOfContact ='')	{
		$user = $this->model('User');
		$user->followUser($userIdOfContact);

		header('Location:'.  BASE_URI . 'contact/index');
	}
	public function unfollow($userIdOfContact ='')	{
		$user = $this->model('User');
		$user->unFollowUser($userIdOfContact);

		header('Location:'.  BASE_URI . 'contact/index');
	}

}