<?php 

/**
 * =================
 * Settings Controller
 * =================
 */
class Settings extends Controller{

	public function index($name = ''){

		/*
		 * Check if session has the user_email set otherwise redirect back  	
		 */
		if( Session::get('user_email') ){

			// Calling a Model
			$user = $this->model('User');

			/**
			 * Update user info
			 */
			if(isset($_POST['save_changes'])){
				if( isset($_POST['full_name']) && !empty($_POST['full_name']) ){
					$user->updateFullName();
					
				}
				if( isset($_POST['user_name']) && !empty($_POST['user_name']) ){
					$user->updateUserName();
				}
				
				if( isset($_FILES['profilepicture'])  && !empty($_FILES['profilepicture']) && $_FILES["profilepicture"]["error"] == 0 ) {
					//Upload profilepicture Image
					$user->uploadProfilePicture();
			
				}

			}

			// Calling a View
			$this->view('settings/index');
	


		} else {
		// Redirect to Home page
		header('Location:'.  BASE_URI . 'login/index');
		}		
	}

}