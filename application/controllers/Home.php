<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller 
{

	public function index()
	{
		$data['title']	= 'Homepage';
		$data['page']	= 'pages/home/index';
		
		$this->view($data);
	}

}

/* End of file Home.php */
