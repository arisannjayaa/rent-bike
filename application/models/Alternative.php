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
		$select = "bk.id,
				bk.name,
				bk.price,
				bk.year_release,
				bk.engine_power,
				bk.fuel,
                MAX(CASE WHEN k.code = 'C1' THEN sk.weight ELSE NULL END) AS c1,
                MAX(CASE WHEN k.code ='C2' THEN sk.weight ELSE NULL END) AS c2,
                MAX(CASE WHEN k.code ='C3' THEN sk.weight ELSE NULL END) AS c3,
                MAX(CASE WHEN k.code ='C4' THEN sk.weight ELSE NULL END) AS c4,
                MAX(CASE WHEN k.code = 'C1' THEN sk.id ELSE NULL END) AS sub_id_1,
                MAX(CASE WHEN k.code = 'C2' THEN sk.id ELSE NULL END) AS sub_id_2,
                MAX(CASE WHEN k.code = 'C3' THEN sk.id ELSE NULL END) AS sub_id_3,
                MAX(CASE WHEN k.code = 'C4' THEN sk.id ELSE NULL END) AS sub_id_4";

		$builder = $this->db
			->select($select)
			->from('alternatif alt')
			->join('kriteria k', 'k.id = alt.criteria_id')
			->join('subkriteria sk', 'sk.id = alt.subcriteria_id')
			->join('bike bk', 'bk.id = alt.bike_id')
			->where('bk.id', $id)
			->group_by('bk.id, bk.name, bk.year_release, bk.price, bk.engine_power, bk.fuel');

		return $builder->get();
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
		$this->db->where('bike_id', $data['bike_id']);
		$this->db->where('criteria_id', $data['criteria_id']);
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
		$select = "bk.id,
				bk.name,
				bk.price,
				bk.year_release,
				bk.engine_power,
				bk.fuel,
                MAX(CASE WHEN k.code = 'C1' THEN sk.weight ELSE NULL END) AS c1,
                MAX(CASE WHEN k.code ='C2' THEN sk.weight ELSE NULL END) AS c2,
                MAX(CASE WHEN k.code ='C3' THEN sk.weight ELSE NULL END) AS c3,
                MAX(CASE WHEN k.code ='C4' THEN sk.weight ELSE NULL END) AS c4,
                MAX(CASE WHEN k.code ='C1' THEN sk.name ELSE NULL END) AS c1_sub_name,
                MAX(CASE WHEN k.code ='C2' THEN sk.name ELSE NULL END) AS c2_sub_name,
                MAX(CASE WHEN k.code ='C3' THEN sk.name ELSE NULL END) AS c3_sub_name,
                MAX(CASE WHEN k.code ='C4' THEN sk.name ELSE NULL END) AS c4_sub_name";

		$builder = $this->db
			->select($select)
			->from('alternatif alt')
			->join('kriteria k', 'k.id = alt.criteria_id')
			->join('subkriteria sk', 'sk.id = alt.subcriteria_id')
			->join('bike bk', 'bk.id = alt.bike_id')
			->group_by('bk.id, bk.name, bk.year_release, bk.price, bk.engine_power, bk.fuel');

		if($keyword) {
			$arrKeyword = explode(" ", $keyword);
			for ($i=0; $i < count($arrKeyword); $i++) {
				$builder = $builder->or_like('bk.name', $arrKeyword[$i]);
			}
		}

		if($start != 0 || $length != 0) {
			$builder = $builder->limit($length, $start);
		}

		return $builder->get()->result();
	}
}

/* End of file ModelName.php */
