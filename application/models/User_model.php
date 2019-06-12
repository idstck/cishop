<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model 
{

	public function getDefaultValues()
	{
		return [
			'name'		=> '',
			'email'		=> '',
			'role'		=> '',
			'is_active'	=> ''
		];
	}

	public function getValidationRules()
	{
		$validationRules = [
			[
				'field'	=> 'name',
				'label'	=> 'Nama',
				'rules'	=> 'trim|required'
			],
			[
				'field'	=> 'email',
				'label'	=> 'E-Mail',
				'rules'	=> 'trim|required|valid_email|callback_unique_email'
			],
			[
				'field'	=> 'role',
				'label'	=> 'Role',
				'rules'	=> 'required'
			],
		];

		return $validationRules;
	}

	public function uploadImage($fieldName, $fileName)
	{
		$config	= [
			'upload_path'		=> './images/user',
			'file_name'			=> $fileName,
			'allowed_types'		=> 'jpg|gif|png|jpeg|JPG|PNG',
			'max_size'			=> 1024,
			'max_width'			=> 0,
			'max_height'		=> 0,
			'overwrite'			=> true,
			'file_ext_tolower'	=> true
		];

		$this->load->library('upload', $config);

		if ($this->upload->do_upload($fieldName)) {
			return $this->upload->data();
		} else {
			$this->session->set_flashdata('image_error', $this->upload->display_errors('', ''));
			return false;
		}
	}

	public function deleteImage($fileName)
	{
		if (file_exists("./images/user/$fileName")) {
			unlink("./images/user/$fileName");
		}
	}

}

/* End of file User_model.php */
