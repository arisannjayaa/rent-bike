<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bike extends CI_Model
{
	/**
	 * get all data
	 * @param $table
	 * @return mixed
	 */
	public function get_data($table)
	{
		return $this->db->get($table);
	}

	/**
	 * get data where not in
	 * @param $table
	 * @return mixed
	 */
	public function get_data_where_not($table)
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

		if (count($arrAlternative) == 0) {
			return $this->get_data($table);
		}

		return $this->db
			->select('*')
			->from($table)
			->where_not_in('id', $arrAlternative)
			->get();
	}

	/**
	 * get data by id
	 * @param $id
	 * @return mixed
	 */
	public function get_data_by_id($id) {
		return $this->db->get_where('bike', array('id' => $id))->row();
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
		$builder = $this->db->select("*")->from('bike');

		if($keyword) {
			$arrKeyword = explode(" ", $keyword);
			for ($i=0; $i < count($arrKeyword); $i++) {
				$builder = $builder->or_like('name', $arrKeyword[$i]);
				$builder = $builder->or_like('price', $arrKeyword[$i]);
				$builder = $builder->or_like('year_release', $arrKeyword[$i]);
				$builder = $builder->or_like('engine_power', $arrKeyword[$i]);
				$builder = $builder->or_like('fuel', $arrKeyword[$i]);
			}
		}

		if($start != 0 || $length != 0) {
			$builder = $builder->limit($length, $start);
		}

		return $builder->get()->result();
	}

	public function insert_batch($table, $data)
	{
		$this->db->empty_table("alternatif");
		$this->db->empty_table($table);
		return $this->db->insert_batch($table, $data);
	}
}

/* End of file ModelName.php */
