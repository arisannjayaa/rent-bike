<?php

function getSubcriteriaByCriteriaId($id)
{
	$CI =& get_instance();
	$CI->load->database();

	$CI->db->where('criteria_id', $id);
	$query = $CI->db->get('subkriteria');
	return $query->result();
}

function getSubcriteriaById($id)
{
	$CI =& get_instance();
	$CI->load->database();

	$query = $CI->db
		->select('subkriteria.*, kriteria.name as kriteria_name, kriteria.code as code')
		->from('subkriteria')
		->join('kriteria', 'kriteria.id = subkriteria.criteria_id')
		->where('subkriteria.id', $id)
		->get();

	return $query->row();
}

function upload_attachment($path, $key_name)
{
	if (!is_dir($path)) {
		mkdir($path, 0777, TRUE);
	}

	$config['upload_path'] 		= './'.$path;
	$config['allowed_types'] 	= 'jpg|png';
	$config['max_filename']	 	= '255';
	$config['encrypt_name'] 	= TRUE;
	$config['max_size'] 		= 1024;
	$this->load->library('upload', $config);

	if (!$this->upload->do_upload($key_name)) {
		$this->output->set_status_header(400);

		echo json_encode(array('errors' => "Terjadi error saat upload"));
		return;
	}
}
