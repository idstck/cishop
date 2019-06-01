<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model 
{

	protected $table	= '';

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

		$this->form_validation->set_error_delimeters(
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
}

/* End of file MY_Model.php */
