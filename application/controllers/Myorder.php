<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Myorder extends MY_Controller 
{
	private $id;

	public function __construct()
	{
		parent::__construct();
		$is_login	= $this->session->userdata('is_login');
		$this->id	= $this->session->userdata('id');

		if (! $is_login) {
			redirect(base_url());
			return;
		}
	}

	public function index()
	{
		$data['title']		= 'Daftar Order';
		$data['content']	= $this->myorder->where('id_user', $this->id)
								->orderBy('date', 'DESC')->get();
		$data['page']		= 'pages/myorder/index';

		$this->view($data);
	}

}

/* End of file Myorder.php */
