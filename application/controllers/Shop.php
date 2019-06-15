<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends MY_Controller 
{

	public function sortby($sort, $page = null)
	{
		$data['title']	= 'Belanja';
		$data['content']	= $this->shop->select(
				[
					'product.id', 'product.title AS product_title', 
					'product.description', 'product.image', 
					'product.price', 'product.is_available',
					'category.title AS category_title'
				]
			)
			->join('category')
			->where('product.is_available', 1)
			->orderBy('product.price', $sort)
			->paginate($page)
			->get();
		$data['total_rows']	= $this->shop->where('product.is_available', 1)->count();
		$data['pagination']	= $this->shop->makePagination(
			base_url("shop/sortby/$sort"), 4, $data['total_rows']
		);
		$data['page']	= 'pages/home/index';
		
		$this->view($data);
	}

}

/* End of file Shop.php */
