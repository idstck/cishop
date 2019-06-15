<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

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

	public function add()
	{
		if (!$_POST) {
			redirect(base_url());
		} else {
			$input				= (object) $this->input->post(null, true);

			$this->cart->table	= 'product';
			$product			= $this->cart->where('id', $input->id_product)->first();

			$subtotal			= $product->price * $input->qty;

			$this->cart->table	= 'cart';
			$cart				= $this->cart->where('id_user', $this->id)->where('id_product', $input->id_product)->first();
			
			
			if ($cart) {
				$data = [
					'qty' 		=> $cart->qty + $input->qty,
					'subtotal'	=> $cart->subtotal + $subtotal
				];

				if ($this->cart->where('id', $cart->id)->update($data)) {
					$this->session->set_flashdata('success', 'Produk berhasil ditambahkan!');
				} else {
					$this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
				}

				redirect(base_url(''));
			}

			$data = [
				'id_user'		=> $this->id,
				'id_product'	=> $input->id_product,
				'qty' 			=> $input->qty,
				'subtotal'		=> $subtotal
			];

			if ($this->cart->create($data)) {
				$this->session->set_flashdata('success', 'Produk berhasil ditambahkan!');
			} else {
				$this->session->set_flashdata('error', 'Oops! Terjadi kesalahan.');
			}

			redirect(base_url(''));
		}
	}

}

/* End of file Cart.php */
