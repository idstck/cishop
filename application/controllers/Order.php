<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$role = $this->session->userdata('role');
		if ($role != 'admin') {
			redirect(base_url('/'));
			return;
		}
	}

	public function index($page = null)
	{
		$data['title']		= 'Admin: Order';
		$data['content']	= $this->order->orderBy('date', 'DESC')->paginate($page)->get();
		$data['total_rows']	= $this->order->count();
		$data['pagination']	= $this->order->makePagination(
			base_url('order'), 2, $data['total_rows']
		);
		$data['page']		= 'pages/order/index';
		
		$this->view($data);
	}

}

/* End of file Order.php */
