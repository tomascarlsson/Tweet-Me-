<?php 
/**
 * ========================
 * Login Controller
 * Sign in & Registration
 * ========================
 */
class Login extends Controller
{
	public function index($name = ''){

		// Instatiation of User Class
		$user = $this->model('User');

		/**
		 * Register a new user
		 */
		if( isset($_POST['register']) ){
			if(!empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['password'])){
				if( $user->register() ) {					
					Session::set('user_email', $_POST['email'] );
					// Redirect to Home page
					header('Location:'.  BASE_URI . 'home/index');
					exit();
				} else{
					echo "No user with this email has been registered.";
				}
			}
		}

		/**
		 * Sign in user
		 */
		if( isset($_POST['sign_in']) ){
			if(!empty($_POST['email']) && !empty($_POST['password'])){
			
				if( $user->login() ) {					
					Session::set('user_email', $_POST['email'] );
					// Redirect to Home page
					header('Location:'.  BASE_URI . 'home/index');
					exit();
				} else{
					echo "No user with this email has been registered.";
				}
			}
		}


		// Calling a View
		$this->view('login/index');
	}

	public function logout(){
		Session::destroy();
		header('Location:'.  BASE_URI . 'login/index');
	}


}