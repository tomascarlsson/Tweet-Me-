<?php

/**
 * =====================================
 * Database Class
 * with useful PDO-methods from:
 * http://culttt.com/2012/10/01/roll-your-own-pdo-php-class/
 * =====================================
 */
class Database {
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $dbname = DB_NAME;
	
	private $dbHandler;
	private $error;
	private $statement;
	
	public function __construct() {
		/**
		 * Create Data Source Name variable that will contain information about a specific database
		 * @var string
		 */
		$dataSourceName = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;

		/**
		 * Set options
		 * @var array
		 */
		$options = array (
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
		);

		/**
		 * Create a new PDO instance
		 */
		try {
			$this->dbHandler = new PDO ($dataSourceName, $this->user, $this->pass, $options);
		}		// Catch any errors
		catch ( PDOException $e ) {
			$this->error = $e->getMessage();
		}
	}
	
	/**
	 * [query description]
	 */
	public function query($query) {
		$this->statement = $this->dbHandler->prepare($query);
	}
	
	/**
	 * Binds the inputs with the placeholders
	 */
	public function bind($param, $value, $type = null) {
		if (is_null ( $type )) {
			switch (true) {
				case is_int ( $value ) :
					$type = PDO::PARAM_INT;
					break;
				case is_bool ( $value ) :
					$type = PDO::PARAM_BOOL;
					break;
				case is_null ( $value ) :
					$type = PDO::PARAM_NULL;
					break;
				default :
					$type = PDO::PARAM_STR;
			}
		}
		$this->statement->bindValue ( $param, $value, $type );
	}
	
	/**
	 * Executes the prepared statment
	 */
	public function execute(){
		return $this->statement->execute();
	}
	
	/**
	 * Gets the result set rows
	 * @return array 
	 */
	public function resultset(){
		$this->execute();
		return $this->statement->fetchAll(PDO::FETCH_OBJ);
	}
	

	/**
	 * Get a single row
	 */
	public function single(){
		$this->execute();
		return $this->statement->fetch(PDO::FETCH_OBJ);
	}
	
	/**
	 * Get total amount of rows returned in statement
	 * @return [type] [description]
	 */
	public function rowCount(){
		return $this->statement->rowCount();
	}
	
	/**
	 * Get last inserted id
	 */
	public function lastInsertId(){
		return $this->dbHandler->lastInsertId();
	}
	
	/**
	 * Transactions
	 */
	public function beginTransaction(){
		return $this->dbHandler->beginTransaction();
	}
	
	public function endTransaction(){
		return $this->dbHandler->commit();
	}
	
	public function cancelTransaction(){
		return $this->dbHandler->rollBack();
	}


}