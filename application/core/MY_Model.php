<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model 
{

	protected $table	= '';
	protected $perPage	= 5;

	public function __construct()
	{
		parent::__construct();
		
		if (!$this->table) {
			$this->table = strtolower(
				str_replace('_model', '', get_class($this))
			);
		}
	}


	/**
	 * Fungsi Validasi Input
	 * Rules: Dideklarasikan dalam masing-masing model
	 *
	 * @return void
	 */
	public function validate()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters(
			'<small class="form-text text-danger">', '</small>'
		);
		$validationRules = $this->getValidationRules();

		$this->form_validation->set_rules($validationRules);

		return $this->form_validation->run();
	}


	/**
	 * Seleksi data per-kolom
	 * Chain Method
	 *
	 * @param [type] $columns
	 * @return void
	 */
	public function select($columns)
	{
		$this->db->select($columns);
		return $this;
	}

	/**
	 * Mencari suatu data pada kolom tertentu dengan data yang sama
	 * Chain Method
	 * @param [type] $column
	 * @param [type] $condition
	 * @return void
	 */
	public function where($column, $condition)
	{
		$this->db->where($column, $condition);
		return $this;
	}

	/**
	 * Mencari suatu data pada kolom tertentu dengan data yang mirip
	 * Chain Method
	 * @param [type] $column
	 * @param [type] $condition
	 * @return void
	 */
	public function like($column, $condition)
	{
		$this->db->like($column, $condition);
		return $this;
	}

	/**
	 * Mencari suatu data selanjutnya pada kolom tertentu dengan data yang mirip
	 * Chain Method
	 * @param [type] $column
	 * @param [type] $condition
	 * @return void
	 */
	public function orLike($column, $condition)
	{
		$this->db->or_like($column, $condition);
		return $this;
	}

	/**
	 * Menggabungkan Table yang berelasi yang memiliki foreign key id_namatable
	 * Chain Method
	 * @param [type] $table
	 * @param string $type
	 * @return void
	 */
	public function join($table, $type = 'left')
	{
		$this->db->join($table, "$this->table.id_$table = $table.id", $type);
		return $this;
	}

	/**
	 * Mengurutkan data dari hasil query dan kondisi
	 * Chain Method
	 * @param [type] $column
	 * @param string $order
	 * @return void
	 */
	public function orderBy($column, $order = 'asc')
	{
		$this->db->order_by($column, $order);
		return $this;
	}

	/**
	 * Menampilkan satu data dari hasil query dan kondisi
	 * Hasil Akhir Chain Method
	 * @return void
	 */
	public function first()
	{
		return $this->db->get($this->table)->row();
	}

	/**
	 * Menampilkan banyak data dari hasil query dan kondisi
	 * Hasil Akhir Chain Method
	 * @return void
	 */
	public function get()
	{
		return $this->db->get($this->table)->result();
	}

	/**
	 * Menampilkan nilai jumlah data dari hasil query dan kondisi
	 * Hasil Akhir Chain Method
	 * @return void
	 */
	public function count()
	{
		return $this->db->count_all_results($this->table);
	}

	/**
	 * Menyimpan data baru ke dalam suatu tabel
	 *
	 * @param [type] $data
	 * @return void
	 */
	public function create($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	/**
	 * Mengubah data yang ada pada suatu tabel dengan data baru
	 *
	 * @param [type] $data
	 * @return void
	 */
	public function update($data)
	{
		return $this->db->update($this->table, $data);
	}
	
	/**
	 * Menghapus suatu data dari hasil query dan kondisi
	 * 
	 * @return void
	 */
	public function delete()
	{
		$this->db->delete($this->table);
		return $this->db->affected_rows();
	}

	/**
	 * Menentukan Limit data untuk ditampilkan
	 *
	 * @param [type] $page
	 * @return void
	 */
	public function paginate($page)
	{
		$this->db->limit(
			$this->perPage,
			$this->calculateRealOffset($page)
		);

		return $this;
	}

	/**
	 * Menggantikan offset dengan nilai sesuai halaman
	 *
	 * @param [type] $page
	 * @return void
	 */
	public function calculateRealOffset($page)
	{
		if (is_null($page) || empty($page)) {
			$offset = 0;
		} else {
			$offset = ($page * $this->perPage) - $this->perPage;
		}

		return $offset;
	}

	/**
	 * Membuat Pagination dengan style bootstrap 4
	 *
	 * @param [type] $baseUrl
	 * @param [type] $uriSegment
	 * @param [type] $totalRows
	 * @return void
	 */
	public function makePagination($baseUrl, $uriSegment, $totalRows = null)
	{
		$this->load->library('pagination');

		$config = [
			'base_url'			=> $baseUrl,
			'uri_segment'		=> $uriSegment,
			'per_page'			=> $this->perPage,
			'total_rows'		=> $totalRows,
			'use_page_numbers'	=> true,
			
			'full_tag_open'		=> '<ul class="pagination">',
			'full_tag_close'	=> '</ul>',
			'attributes'		=> ['class' => 'page-link'],
			'first_link'		=> false,
			'last_link'			=> false,
			'first_tag_open'	=> '<li class="page-item">',
			'first_tag_close'	=> '</li>',
			'prev_link'			=> '&laquo',
			'prev_tag_open'		=> '<li class="page-item">',
			'prev_tag_close'	=> '</li>',
			'next_link'			=> '&raquo',
			'next_tag_open'		=> '<li class="page-item">',
			'next_tag_close'	=> '</li>',
			'last_tag_open'		=> '<li class="page-item">',
			'last_tag_close'	=> '</li>',
			'cur_tag_open'		=> '<li class="page-item active"><a href="#" class="page-link">',
			'cur_tag_close'		=> '<span class="sr-only">(current)</span></a></li>',
			'num_tag_open'		=> '<li class="page-item">',
			'num_tag_close'		=> '</li>',
		];

		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}
}

/* End of file MY_Model.php */
