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

	public function detail($invoice)
	{
		$data['order']	= $this->myorder->where('invoice', $invoice)->first();
		if (!$data['order']) {
			$this->session->set_flashdata('warning', 'Data tidak ditemukan.');
			redirect(base_url('/myorder'));
		}

		$this->myorder->table	= 'orders_detail';
		$data['order_detail']	= $this->myorder->select([
				'orders_detail.id_orders', 'orders_detail.id_product', 'orders_detail.qty',
				'orders_detail.subtotal', 'product.title', 'product.image', 'product.price'
			])
			->join('product')
			->where('orders_detail.id_orders', $data['order']->id)
			->get();
		
		$data['page']			= 'pages/myorder/detail';

		$this->view($data);
	}

}

/* End of file Myorder.php */
