<?php 

/**
 * =========================
 * Base Controller Class
 * view and model methods 
 * =========================
 */
class Controller{

	protected function model($model)
	{
		if(file_exists('../app/models/' . $model . '.php')){
			require_once '../app/models/' . $model . '.php'; 
			return new $model(); // Returns the modelname passed in as an object
		}else{
			echo "no Model File existed";
		}
	}

	public function view($view, $data = [])
	{
		if(file_exists('../app/views/' . $view . '.php')){
			require_once '../app/views/' . $view . '.php';
		} else{
			echo "no View File existed";
		}

	}

}