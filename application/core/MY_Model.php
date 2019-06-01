<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model 
{

	protected $table	= '';

	public function __construct()
	{
		parent::__construct();
		
		if (!$this->table) {
			$this->table = strtolower(
				str_replace('_model', '', get_class($this))
			);
		}
	}
	

}

/* End of file MY_Model.php */
