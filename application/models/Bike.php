<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bike extends CI_Model
{

	public function get_data($table)
	{
		$alternative =  $this->db
			->select('bike.id')
			->from('alternatif')
			->join('kriteria', 'kriteria.id = alternatif.criteria_id')
			->join('subkriteria', 'subkriteria.id = alternatif.subcriteria_id')
			->join('bike', 'bike.id = alternatif.bike_id')
			->group_by('bike.id')
			->get()
			->result_array();

		$arrAlternative = array_column($alternative, 'id');
		return $this->db
			->select('*')
			->from($table)
			->where_not_in('id', $arrAlternative)
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
