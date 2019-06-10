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

}

/* End of file Product.php */
