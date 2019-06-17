<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends MY_Controller 
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
		$this->checkout->table = 'cart';

		$data['cart']	= $this->checkout->select([
				'cart.id', 'cart.qty', 'cart.subtotal',
				'product.title', 'product.image', 'product.price'
			])
			->join('product')
			->where('cart.id_user', $this->id)
			->get();

		if (! $data['cart']) {
			$this->session->set_flashdata('warning', 'Tidak ada produk di dalam keranjang.');
			redirect(base_url('/'));
		}

		$data['input']	= (object) $this->checkout->getDefaultValues();
		$data['title']	= 'Checkout';
		$data['page']	= 'pages/checkout/index';

		$this->view($data);
	}

}

/* End of file Checkout.php */
