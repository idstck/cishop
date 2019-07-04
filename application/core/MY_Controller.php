<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$model = strtolower(get_class($this));
		if (file_exists(APPPATH . 'models/'. ucfirst($model) . '_model.php')) {
			$this->load->model(ucfirst($model) . '_model', $model, true);
		}
	}
	
	/**
	 * Load view with default layouts
	 *
	 * @param [type] $data
	 * @return void
	 */
	public function view($data)
	{
		$this->load->view('layouts/app', $data);
	}

}

/* End of file MY_Controller.php */
