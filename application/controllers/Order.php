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

	public function detail($id)
	{
		$data['order']			= $this->order->where('id', $id)->first();
		if (!$data['order']) {
			$this->session->set_flashdata('warning', 'Data tidak ditemukan.');
			redirect(base_url('order'));
		}

		$this->order->table	= 'orders_detail';
		$data['order_detail']	= $this->order->select([
				'orders_detail.id_orders', 'orders_detail.id_product', 'orders_detail.qty',
				'orders_detail.subtotal', 'product.title', 'product.image', 'product.price'
			])
			->join('product')
			->where('orders_detail.id_orders', $id)
			->get();

		if ($data['order']->status !== 'waiting') {
			$this->order->table = 'orders_confirm';
			$data['order_confirm']	= $this->order->where('id_orders', $id)->first();
		}
		
		$data['page']			= 'pages/order/detail';

		$this->view($data);
	}

}

/* End of file Order.php */
