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
