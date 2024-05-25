<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Alternative extends CI_Model
{

	/**
	 * get all data
	 * @param $table
	 * @return mixed
	 */
	public function get_data($table)
	{
		return $this->db
			->select('bike.id, bike.name, bike.year_release, bike.price, bike.engine_power, bike.fuel')
			->from($table)
			->join('kriteria', 'kriteria.id = alternatif.criteria_id')
			->join('subkriteria', 'subkriteria.id = alternatif.subcriteria_id')
			->join('bike', 'bike.id = alternatif.bike_id')
			->group_by('bike.id, bike.name, bike.year_release, bike.price, bike.engine_power, bike.fuel')
			->get();
	}

	/**
	 * get data by id
	 * @param $id
	 * @return mixed
	 */
	public function get_data_by_id($id) {
		return $this->db->get_where('kriteria', array('id' => $id))->row();
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
		$builder = $this->db
			->select('bike.id, bike.name, bike.year_release, bike.price, bike.engine_power, bike.fuel')
			->from('alternatif')
			->join('kriteria', 'kriteria.id = alternatif.criteria_id')
			->join('subkriteria', 'subkriteria.id = alternatif.subcriteria_id')
			->join('bike', 'bike.id = alternatif.bike_id')
			->group_by('bike.id, bike.name, bike.year_release, bike.price, bike.engine_power, bike.fuel');

		if($keyword) {
			$arrKeyword = explode(" ", $keyword);
			for ($i=0; $i < count($arrKeyword); $i++) {
				$builder = $builder->or_like('bike.id', $arrKeyword[$i]);
				$builder = $builder->or_like('bike.name', $arrKeyword[$i]);
				$builder = $builder->or_like('bike.year_release', $arrKeyword[$i]);
				$builder = $builder->or_like('bike.engine_power', $arrKeyword[$i]);
				$builder = $builder->or_like('bike.fuel', $arrKeyword[$i]);
			}
		}

		if($start != 0 || $length != 0) {
			$builder = $builder->limit($length, $start);
		}

		return $builder->get()->result();
	}
}

/* End of file ModelName.php */
