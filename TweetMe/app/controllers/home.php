<?php 

/**
 * =================
 * Home Controller
 * =================
 */
class Home extends Controller{
	
	function index($param = ''){

		/*
		 * Check if session has the user_email set otherwise redirect back  	
		 */
		if( Session::get('user_email') ){


			/**
			 * Instatiation of the Tweet Class 
			 */
			$tweet = $this->model('Tweet');
			/**
			 * Instatiation of the User Class 
			 */
			$user = $this->model('User');

			if( $user->getFollowingAndUser() )
				$data = $user->getFollowingAndUser();
			else
				$data = $tweet->getUserTweets();


			/**
			 * Add a new Tweet
			 * Shows form for tweet
			 */
			if($param == 'addtweet'){
				if( isset($_POST['submit_tweet']) ){
					if( !empty($_POST['message']) ){
						if( $tweet->addTweet() ) {					
							// Redirect to Home page
							header('Location:'.  BASE_URI . 'home/index/addtweet');
							// exit();
						} else{
							echo "Couldn´t add tweet.";
						}
					}
				}
				$userTweets = $tweet->getUserTweets();
				$this->view('home/addtweet', $userTweets);
			}

			/**
			 * Show User tweets only
			 */
			else if($param == 'showtweets'){
				$userTweets = $tweet->getUserTweets();
				$this->view('home/index', $userTweets);
			}


			else {
				$this->view('home/index', $data);
			}


		} 
		else {
			// Redirect to Home page
			header('Location:'.  BASE_URI . 'login/index');
		}

	}


	/**
	 * Delete the tweet
	 */
	public function deletetweet($tweetId = '')	{
		$tweet = $this->model('Tweet');
		$tweet->deleteTweet($tweetId);
		$userTweets = $tweet->getUserTweets();
		$this->view('home/index', $userTweets);
		//header('Location:'.  BASE_URI . 'home/index');

	}



}