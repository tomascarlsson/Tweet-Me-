<?php 

/**
 * =====================================
 * App Class
 * Methods for making nice URL:s
 * =====================================
 */
class App{

	/**
	 * Default values for Controller and Method
	 * and an array to store the parameters in the URL
	 * eg. www.domain.com/CONTROLLER/METHOD/PARAMETER/PARAMETER/.....
	 */
	protected $controller = 'login';
	protected $method = 'index';
	protected $params = [];

	/**
	 * Constructor for the application
	 */
	public function __construct()
	{
		$url = $this->parseUrl();

		/**
		 * First (CONTROLLER) part of URL
		 * Checks if the "controller" exists.
		 */
		if(file_exists('../app/controllers/' . $url[0] . '.php')){
			$this->controller = $url[0];
			unset($url[0]);
		}
		require_once '../app/controllers/'. $this->controller . '.php';

		// Creates an object of the controller
		$this->controller = new $this->controller;

		/**
		 * Second (METHOD) part of URL
		 * Checks if the method exists in the Controller-object.
		 */		
		if (isset($url[1])) {
			if (method_exists($this->controller, $url[1])) {
				$this->method = $url[1];
				unset($url[1]);

			}
		}
		// Checks if $url has content
		$this->params = $url ? array_values($url) : [];

		// Call the the method in controller-object and passes in params as arguments
		call_user_func_array([$this->controller, $this->method], $this->params);

	}

	/**
	 * Checks, santize, splits and trims the URL and make array of the parts in the URL
	 * @return Array
	 */
	public function parseUrl()
	{
		if (isset($_GET['url'])) {
			// echo $_GET['url'];
			return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
}
