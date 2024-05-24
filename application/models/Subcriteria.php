<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Subcriteria extends CI_Model
{

	public function get_data($table)
	{
		return $this->db
			->select($table.'.*, kriteria.name as kriteria_name, kriteria.code as code')
			->from('subkriteria')
			->join('kriteria', 'kriteria.id = subkriteria.criteria_id')
			->get();
	}

	public function insert_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function update_data($data, $table)
	{
		$this->db->where('id', $data['id']);
		$this->db->update($table, $data);
	}

	public function delete($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
}

/* End of file ModelName.php */
