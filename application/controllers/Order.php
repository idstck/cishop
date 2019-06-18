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

	public function search($page = null)
	{
		if (isset($_POST['keyword'])) {
			$this->session->set_userdata('keyword', $this->input->post('keyword'));
		} else {
			redirect(base_url('order'));
		}

		$keyword	= $this->session->userdata('keyword');
		$data['title']		= 'Admin: Order';
		$data['content']	= $this->order->like('invoice', $keyword)
								->orderBy('date', 'DESC')
								->paginate($page)->get();
		$data['total_rows']	= $this->order->like('invoice', $keyword)->count();
		$data['pagination']	= $this->order->makePagination(
			base_url('order/search'), 3, $data['total_rows']
		);
		$data['page']		= 'pages/order/index';
		
		$this->view($data);
	}

	public function reset()
	{
		$this->session->unset_userdata('keyword');
		redirect(base_url('order'));
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

	public function update($id)
	{
		if (!$_POST) {
			$this->session->set_flashdata('error', 'Oops! Terjadi kesalahan!');
			redirect(base_url("order/detail/$id"));
		}

		if ($this->order->where('id', $id)->update(['status' => $this->input->post('status')])) {
			$this->session->set_flashdata('success', 'Data berhasil diperbaharui.');
		} else {
			$this->session->set_flashdata('error', 'Oops! Terjadi kesalahan!');
		}

		redirect(base_url("order/detail/$id"));
	}

}

/* End of file Order.php */
