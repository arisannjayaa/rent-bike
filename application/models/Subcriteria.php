<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Subcriteria extends CI_Model
{
	/**
	 * get data with relation
	 * @param $table
	 * @return mixed
	 */
	public function get_data($table)
	{
		return $this->db
			->select($table.'.*, kriteria.name as kriteria_name, kriteria.code as code')
			->from('subkriteria')
			->join('kriteria', 'kriteria.id = subkriteria.criteria_id')
			->get();
	}

	/**
	 * get data by id
	 * @param $id
	 * @return mixed
	 */
	public function get_data_by_id($id) {
		return $this->db->get_where('subkriteria', array('id' => $id))->row();
	}

	/**
	 * insert data
	 * @param $data
	 * @param $table
	 * @return void
	 */
	public function insert_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	/**
	 * update data
	 * @param $data
	 * @param $table
	 * @return void
	 */
	public function update_data($data, $table)
	{
		$this->db->where('id', $data['id']);
		$this->db->update($table, $data);
	}

	/**
	 * delete data
	 * @param $where
	 * @param $table
	 * @return void
	 */
	public function delete($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	/**
	 * make datatable
	 * @param $keyword
	 * @param $start
	 * @param $length
	 * @return mixed
	 */
	public function datatable($keyword = null, $start = 0, $length = 0)
	{
		$builder = $this->db->select('subkriteria.*, kriteria.name as kriteria_name, kriteria.code as code')
						->from('subkriteria')
						->join('kriteria', 'kriteria.id = subkriteria.criteria_id');

		if($keyword) {
			$arrKeyword = explode(" ", $keyword);
			for ($i=0; $i < count($arrKeyword); $i++) {
				$builder = $builder->or_like('subkriteria.name', $arrKeyword[$i]);
				$builder = $builder->or_like('subkriteria.weight', $arrKeyword[$i]);
			}
		}

		if($start != 0 || $length != 0) {
			$builder = $builder->limit($length, $start);
		}

		return $builder->get()->result();
	}
}

/* End of file ModelName.php */
