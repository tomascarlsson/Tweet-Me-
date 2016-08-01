<?php 
/**
 * ===================================
 * The User Model Class
 * Handles user-related database tasks 
 * ===================================
 */
class User{
	// Database property
	private $db;

	// User property
	private $user;

	/**
	 * Constructor method
	 * creates a new database object
	 */
	public function __construct(){
		$this->db = new Database;
	}


	/**
	 * Get all User details
	 */
	public function getAllUserInfo(){
		$userId = getUserId( Session::get('user_email') );
		$this->db->query('SELECT * FROM user_detail WHERE user_id != (:user_id) ORDER BY fullname ASC');
		
		$this->db->bind(':user_id', $userId);

		$results = $this->db->resultset();

		return $results;
	}



	/**
	 * Get the Followers and the User
	 * @return array
	 */
	public function getFollowingAndUser() {
		$userId = getUserId( Session::get('user_email') );
		try{
			$this->db->query('
SELECT user_detail.fullname, user_detail.picture, user_detail.username, user_detail.user_id, tweet.id, tweet.message, tweet.date FROM user_detail 
	JOIN tweet
		ON tweet.user_id = user_detail.user_id
			WHERE user_detail.user_id =  (:user_id)
UNION
SELECT user_detail.fullname, user_detail.picture, user_detail.username, user_detail.user_id, tweet.id, tweet.message, tweet.date FROM user_detail 
		JOIN user_following
			ON user_detail.user_id = user_following.follow_id
		JOIN tweet
			ON tweet.user_id = user_following.follow_id
	WHERE user_following.user_id = (:user_id)
				GROUP BY tweet.message
				ORDER BY date	DESC		
				LIMIT 50
				');
			
			$this->db->bind(':user_id', $userId);
			$this->db->execute();

			// Assign Result Set
			$results = $this->db->resultset();

			// If a row was not found, run function to get only the user tweets
			if ( $this->db->rowCount() > 0){
				return $results;
			}
			else{
				return false;
			}

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}

	}

	/**
	 * Get the Followers of the user
	 * @return array
	 */
	public function getFollowers() {
	$userId = getUserId( Session::get('user_email') );
		try{
			$this->db->query('
				SELECT * FROM user_detail 
				JOIN user_following
					ON user_detail.user_id = user_following.user_id
				WHERE user_following.follow_id = (:user_id)
				ORDER BY user_detail.fullname DESC		
				LIMIT 50
				');
			
			$this->db->bind(':user_id', $userId);
			$this->db->execute();

			// Assign Result Set
			$results = $this->db->resultset();
			return $results;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	/**
	 * Get the Followers of the user
	 * @return array
	 */
	public function getFollowing() {
	$userId = getUserId( Session::get('user_email') );
		try{
			$this->db->query('
				SELECT * FROM user_detail 
				JOIN user_following
					ON user_detail.user_id = user_following.follow_id
				WHERE user_following.user_id = (:user_id)
				ORDER BY user_detail.fullname	DESC		
				LIMIT 50
				');
			
			$this->db->bind(':user_id', $userId);
			$this->db->execute();

			// Assign Result Set
			$results = $this->db->resultset();
			return $results;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}


	/**
	 * Check registration
	 */
	public function register(){
		$this->user = new User;
		
		// Array containing registration data
		$data = array();
		$data['fullname'] = $_POST['fullname'];
		$data['email'] = $_POST['email'];
		$data['password'] = sha1($_POST['password']);
		
		// $field_array = array('fullname','email','password');
		
		// Create user in database
		if($this->user->createNewUser($data)){
			return true;
		} 
		else {
			echo "Couldn´t register new user";
		}

	}

	/*
	 * Register new User
	 * Make use of PDO-transactions to insert multiple queries
	 * @return boolean 
	 */
	public function createNewUser($data){

		$this->db->beginTransaction();

			// Insert User
			$this->db->query('INSERT INTO user (email, password) VALUES (:email, :password)');
			//Bind Values
			$this->db->bind(':email', $data['email']);
			$this->db->bind(':password', $data['password']);
			//Execute
			$this->db->execute();

			// Insert User details
			$this->db->query('INSERT INTO user_detail (user_id, fullname) VALUES (:user_id, :fullname)');
			//Bind Values
			$this->db->bind(':fullname', $data['fullname']);
			$this->db->bind(':user_id', $this->db->lastInsertId());
			//Execute
			$this->db->execute();

			// echo $this->db->lastInsertId();

		$this->db->endTransaction();

		return true;

	}

	/**
	 * User Log in
	 * Checks if the sent in email and sha1 crypted password is matching any row in the database
	 * On success redirect to home page
	 */
	public function login(){
		$email = $_POST['email'];
		$hashedPassword = sha1($_POST['password']);
		try{
			$this->db->query('SELECT * FROM user WHERE email = (:email) && password = (:hashedPassword)');
			$this->db->bind(':email', $email);
			$this->db->bind(':hashedPassword', $hashedPassword);
			$this->db->execute();
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}

		// If a row was found return true
		if ($this->db->rowCount() > 0){
			return true; 
		}
		else{
			return false;
		}

	}

	/**
	 * Update Full name
	 */
	public function updateFullname()
	{
		$fullname = $_POST['full_name']; 
		$userId = getUserId( Session::get('user_email') );
		//$userId = getUserId( Session::get($_SESSION['user_email']) );

		try{
			$this->db->query('UPDATE user_detail SET fullname = (:fullname)	WHERE user_id = (:userId) ');

			$this->db->bind(':fullname', $fullname);
			$this->db->bind(':userId', $userId);
			$this->db->execute();
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}

	}

	/**
	 * Update Username
	 */
	public function updateUserName(){
		$username = $_POST['user_name'];
		$userId = getUserId( Session::get('user_email') );
			if( checkUsernameInDatabase($username) ) {
				try{
					$this->db->query('
						UPDATE user_detail
						SET username = (:username)
						WHERE user_id = (:userId) 
						');

					$this->db->bind(':username', $username);
					$this->db->bind(':userId', $userId);
					$this->db->execute();
				}
				catch(PDOException $e){
					echo $e->getMessage();
				}
			} 
			else{
				echo "Username already taken.";
			}


	}


	/*
	 * Upload User profilepicture
	*/
	public function uploadProfilePicture(){

		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["profilepicture"]["name"]);
		$extension = end($temp);
		if ((($_FILES["profilepicture"]["type"] == "image/gif")
				|| ($_FILES["profilepicture"]["type"] == "image/jpeg")
				|| ($_FILES["profilepicture"]["type"] == "image/jpg")
				|| ($_FILES["profilepicture"]["type"] == "image/pjpeg")
				|| ($_FILES["profilepicture"]["type"] == "image/x-png")
				|| ($_FILES["profilepicture"]["type"] == "image/png"))
				&& ($_FILES["profilepicture"]["size"] < 1000000)
				&& in_array($extension, $allowedExts)) {
			if ($_FILES["profilepicture"]["error"] > 0) {
				echo "An error occured during the file upload. Please try again.";
			} 
			else {
				// if (file_exists(getcwd()."/images/profilepictures/" . $_FILES["profilepicture"]["name"])) {
				// 	echo "File already exists";
				// } 
				// else {
					move_uploaded_file($_FILES["profilepicture"]["tmp_name"],
						getcwd(). '/images/profilepictures/' . $_FILES["profilepicture"]["name"]);
					
				// Insert into database
				try{

					$userId = getUserId( Session::get('user_email') );
					//$userId = getUserId( Session::get($_SESSION['user_email']) );
					$userPicture = $_FILES["profilepicture"]["name"];
					$this->db->query('UPDATE user_detail SET picture = (:picture) WHERE user_id = (:userId)');

					//Bind Values
					$this->db->bind(':picture', $userPicture);
					$this->db->bind(':userId', $userId);
					//Execute
					$this->db->execute();
				}
				catch(PDOException $e){
					echo $e->getMessage();
				}

				// }
			}
		} 
		else {
			echo "Format on the profile picture is not allowed or size of file to large";
		}
	}



	public function followUser($followId)
	{
		$userId = getUserId( Session::get('user_email') );

		try{
			$this->db->query('INSERT INTO user_following (user_id, follow_id) VALUES (:user_id, :follow_id)');

			$this->db->bind(':user_id', $userId);
			$this->db->bind(':follow_id', $followId);

			$this->db->execute();
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function unFollowUser($followId)
	{
		$userId = getUserId( Session::get('user_email') );
		try{
			$this->db->query('DELETE FROM user_following WHERE user_id = (:user_id) AND follow_id = (:follow_id)');

			$this->db->bind(':user_id', $userId);
			$this->db->bind(':follow_id', $followId);

			$this->db->execute();
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}


}




		
