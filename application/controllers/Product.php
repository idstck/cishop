<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	

	public function index($page = null)
	{
		$data['title']		= 'Admin: Produk';
		$data['content']	= $this->product->select(
				[
					'product.id', 'product.title AS product_title', 'product.image', 
					'product.price', 'product.is_available',
					'category.title AS category_title'
				]
			)
			->join('category')
			->paginate($page)
			->get();
		$data['total_rows']	= $this->product->count();
		$data['pagination']	= $this->product->makePagination(
			base_url('product'), 2, $data['total_rows']
		);
		$data['page']		= 'pages/product/index';

		$this->view($data);
	}

	public function create()
	{
		if (!$_POST) {
			$input	= (object) $this->product->getDefaultValues();
		} else {
			$input	= (object) $this->input->post(null, true);
		}

		if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
			$imageName	= url_title($input->title, '-', true) . '-' . date('YmdHis');
			$upload		= $this->product->uploadImage('image', $imageName);
			if ($upload) {
				$input->image	= $upload['file_name'];
			} else {
				redirect(base_url('product/create'));
			}
		}

		if (!$this->product->validate()) {
			$data['title']			= 'Tambah Produk';
			$data['input']			= $input;
			$data['form_action']	= base_url('product/create');
			$data['page']			= 'pages/product/form';

			$this->view($data);
			return;
		}

		if ($this->product->create($input)) {
			$this->session->set_flashdata('success', 'Data berhasil disimpan!');
		} else {
			$this->session->set_flashdata('error', 'Oops! Terjadi suatu kesalahan');
		}

		redirect(base_url('product'));
	}

}

/* End of file Product.php */
