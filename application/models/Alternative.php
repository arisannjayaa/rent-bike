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
				bk.attachment,
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

	public function matrix_normalization()
	{
		$select = "WITH subquery AS (
            SELECT
                bk.id,
		        bk.name,
		        bk.price,
		        bk.year_release,
		        bk.engine_power,
		        bk.fuel,
        		MAX(CASE WHEN k.code = 'C1' THEN sk.weight ELSE NULL END) AS c1_weight,
                MAX(CASE WHEN k.code = 'C2' THEN sk.weight ELSE NULL END) AS c2_weight,
                MAX(CASE WHEN k.code = 'C3' THEN sk.weight ELSE NULL END) AS c3_weight,
                MAX(CASE WHEN k.code = 'C4' THEN sk.weight ELSE NULL END) AS c4_weight,
                MAX(CASE WHEN k.code = 'C1' THEN sk.id ELSE NULL END) AS sub_id_1,
                MAX(CASE WHEN k.code = 'C2' THEN sk.id ELSE NULL END) AS sub_id_2,
                MAX(CASE WHEN k.code = 'C3' THEN sk.id ELSE NULL END) AS sub_id_3,
                MAX(CASE WHEN k.code = 'C4' THEN sk.id ELSE NULL END) AS sub_id_4,
                MAX(CASE WHEN k.code = 'c1' THEN k.attribute ELSE NULL END) AS c1_attribute,
                MAX(CASE WHEN k.code = 'c2' THEN k.attribute ELSE NULL END) AS c2_attribute,
                MAX(CASE WHEN k.code = 'c3' THEN k.attribute ELSE NULL END) AS c3_attribute,
                MAX(CASE WHEN k.code = 'c4' THEN k.attribute ELSE NULL END) AS c4_attribute
            FROM
                alternatif alt
            JOIN
                bike bk ON alt.bike_id = bk.id
            JOIN
                subkriteria sk ON alt.subcriteria_id = sk.id
            JOIN
                kriteria k ON alt.criteria_id = k.id
            GROUP BY
                bk.id,
		        bk.name,
		        bk.price,
		        bk.year_release,
		        bk.engine_power,
		        bk.fuel
        ),
        min_max AS (
            SELECT
                MIN(c1_weight) AS c1_min,
                MIN(c2_weight) AS c2_min,
                MIN(c3_weight) AS c3_min,
                MIN(c4_weight) AS c4_min,
                MAX(c1_weight) AS c1_max,
                MAX(c2_weight) AS c2_max,
                MAX(c3_weight) AS c3_max,
                MAX(c4_weight) AS c4_max
            FROM subquery
        )
        SELECT
            	subquery.id,
		        subquery.name,
		        subquery.price,
		        subquery.year_release,
		        subquery.engine_power,
		        subquery.fuel,
            CASE
                WHEN c1_attribute = 'Benefit' THEN subquery.c1_weight / min_max.c1_max
                WHEN c1_attribute = 'Cost' THEN min_max.c1_min / subquery.c1_weight
            END AS c1,
            CASE
                WHEN c2_attribute = 'Benefit' THEN subquery.c2_weight / min_max.c2_max
                WHEN c2_attribute = 'Cost' THEN min_max.c2_min / subquery.c2_weight
            END AS c2,
            CASE
                WHEN c3_attribute = 'Benefit' THEN subquery.c3_weight / min_max.c3_max
                WHEN c3_attribute = 'Cost' THEN min_max.c3_min / subquery.c3_weight
            END AS c3,
            CASE
                WHEN c4_attribute = 'Benefit' THEN subquery.c4_weight / min_max.c4_max
                WHEN c4_attribute = 'Cost' THEN min_max.c4_min / subquery.c4_weight
            END AS c4
        FROM
            subquery
        JOIN
        min_max order by name asc";

		return $this->db->query($select);
	}

	public function matrix_alternative()
	{
		$select = "SELECT bk.id,
						bk.name,
						bk.price,
						bk.year_release,
						bk.engine_power,
						bk.fuel,
						bk.attachment,
						MAX(CASE WHEN k.code = 'C1' THEN sk.weight ELSE NULL END) AS c1,
						MAX(CASE WHEN k.code ='C2' THEN sk.weight ELSE NULL END) AS c2,
						MAX(CASE WHEN k.code ='C3' THEN sk.weight ELSE NULL END) AS c3,
						MAX(CASE WHEN k.code ='C4' THEN sk.weight ELSE NULL END) AS c4,
						MAX(CASE WHEN k.code ='C1' THEN sk.name ELSE NULL END) AS c1_sub_name,
						MAX(CASE WHEN k.code ='C2' THEN sk.name ELSE NULL END) AS c2_sub_name,
						MAX(CASE WHEN k.code ='C3' THEN sk.name ELSE NULL END) AS c3_sub_name,
						MAX(CASE WHEN k.code ='C4' THEN sk.name ELSE NULL END) AS c4_sub_name
						FROM
						alternatif alt
					JOIN
						bike bk ON alt.bike_id = bk.id
					JOIN
						subkriteria sk ON alt.subcriteria_id = sk.id
					JOIN
						kriteria k ON sk.criteria_id = k.id
					GROUP BY
						 bk.id,
				bk.name,
				bk.price,
				bk.year_release,
				bk.engine_power,
				bk.attachment,
				bk.fuel order by name asc";

		return $this->db->query($select);
	}

	public function matrix_preferences()
	{
		$select = "WITH subquery AS (
				SELECT
					bk.id,
					bk.name,
					bk.price,
					bk.year_release,
					bk.engine_power,
					bk.fuel,
					MAX(CASE WHEN k.code = 'C1' THEN sk.weight ELSE NULL END) AS c1_weight,
					MAX(CASE WHEN k.code = 'C2' THEN sk.weight ELSE NULL END) AS c2_weight,
					MAX(CASE WHEN k.code = 'C3' THEN sk.weight ELSE NULL END) AS c3_weight,
					MAX(CASE WHEN k.code = 'C4' THEN sk.weight ELSE NULL END) AS c4_weight,
					MAX(CASE WHEN k.code = 'c1' THEN k.weight ELSE NULL END) AS c1_c_weight,
					MAX(CASE WHEN k.code = 'c2' THEN k.weight ELSE NULL END) AS c2_c_weight,
					MAX(CASE WHEN k.code = 'c3' THEN k.weight ELSE NULL END) AS c3_c_weight,
					MAX(CASE WHEN k.code = 'c4' THEN k.weight ELSE NULL END) AS c4_c_weight,
					MAX(CASE WHEN k.code = 'C1' THEN sk.id ELSE NULL END) AS sub_id_1,
					MAX(CASE WHEN k.code = 'C2' THEN sk.id ELSE NULL END) AS sub_id_2,
					MAX(CASE WHEN k.code = 'C3' THEN sk.id ELSE NULL END) AS sub_id_3,
					MAX(CASE WHEN k.code = 'C4' THEN sk.id ELSE NULL END) AS sub_id_4,
					MAX(CASE WHEN k.code = 'c1' THEN k.attribute ELSE NULL END) AS c1_attribute,
					MAX(CASE WHEN k.code = 'c2' THEN k.attribute ELSE NULL END) AS c2_attribute,
					MAX(CASE WHEN k.code = 'c3' THEN k.attribute ELSE NULL END) AS c3_attribute,
					MAX(CASE WHEN k.code = 'c4' THEN k.attribute ELSE NULL END) AS c4_attribute
				FROM
					alternatif alt
					JOIN bike bk ON alt.bike_id = bk.id
					JOIN subkriteria sk ON alt.subcriteria_id = sk.id
					JOIN kriteria k ON alt.criteria_id = k.id
				GROUP BY
					bk.id,
					bk.name,
					bk.price,
					bk.year_release,
					bk.engine_power,
					bk.fuel
			),
			min_max AS (
				SELECT
					MIN(c1_weight) AS c1_min,
					MIN(c2_weight) AS c2_min,
					MIN(c3_weight) AS c3_min,
					MIN(c4_weight) AS c4_min,
					MAX(c1_weight) AS c1_max,
					MAX(c2_weight) AS c2_max,
					MAX(c3_weight) AS c3_max,
					MAX(c4_weight) AS c4_max
				FROM
					subquery
			),
			normalize_data AS (
				SELECT
					subquery.id,
					subquery.name,
					subquery.price,
					subquery.year_release,
					subquery.engine_power,
					subquery.fuel,
					CASE
						WHEN c1_attribute = 'Benefit' THEN subquery.c1_weight / min_max.c1_max
						WHEN c1_attribute = 'Cost' THEN min_max.c1_min / subquery.c1_weight
					END AS c1,
					CASE
						WHEN c2_attribute = 'Benefit' THEN subquery.c2_weight / min_max.c2_max
						WHEN c2_attribute = 'Cost' THEN min_max.c2_min / subquery.c2_weight
					END AS c2,
					CASE
						WHEN c3_attribute = 'Benefit' THEN subquery.c3_weight / min_max.c3_max
						WHEN c3_attribute = 'Cost' THEN min_max.c3_min / subquery.c3_weight
					END AS c3,
					CASE
						WHEN c4_attribute = 'Benefit' THEN subquery.c4_weight / min_max.c4_max
						WHEN c4_attribute = 'Cost' THEN min_max.c4_min / subquery.c4_weight
					END AS c4,
					c1_c_weight, c2_c_weight, c3_c_weight, c4_c_weight
				FROM
					subquery
					JOIN min_max ON 1 = 1
			)
			SELECT
				id,
				name,
				price,
				year_release,
				engine_power,
				fuel,
				c1 * c1_c_weight AS c1,
				c2 * c2_c_weight AS c2,
				c3 * c3_c_weight AS c3,
				c4 * c4_c_weight AS c4,
				(c1 * c1_c_weight) + (c2 * c2_c_weight) + (c3 * c3_c_weight) + (c4 * c4_c_weight) AS result
			FROM
				normalize_data order by name asc
			";

		return $this->db->query($select);
	}

	public function matrix_result()
	{
		$select = "WITH subquery AS (
				SELECT
					bk.id,
					bk.name,
					bk.price,
					bk.year_release,
					bk.engine_power,
					bk.fuel,
					MAX(CASE WHEN k.code = 'C1' THEN sk.weight ELSE NULL END) AS c1_weight,
					MAX(CASE WHEN k.code = 'C2' THEN sk.weight ELSE NULL END) AS c2_weight,
					MAX(CASE WHEN k.code = 'C3' THEN sk.weight ELSE NULL END) AS c3_weight,
					MAX(CASE WHEN k.code = 'C4' THEN sk.weight ELSE NULL END) AS c4_weight,
					MAX(CASE WHEN k.code = 'c1' THEN k.weight ELSE NULL END) AS c1_c_weight,
					MAX(CASE WHEN k.code = 'c2' THEN k.weight ELSE NULL END) AS c2_c_weight,
					MAX(CASE WHEN k.code = 'c3' THEN k.weight ELSE NULL END) AS c3_c_weight,
					MAX(CASE WHEN k.code = 'c4' THEN k.weight ELSE NULL END) AS c4_c_weight,
					MAX(CASE WHEN k.code = 'C1' THEN sk.id ELSE NULL END) AS sub_id_1,
					MAX(CASE WHEN k.code = 'C2' THEN sk.id ELSE NULL END) AS sub_id_2,
					MAX(CASE WHEN k.code = 'C3' THEN sk.id ELSE NULL END) AS sub_id_3,
					MAX(CASE WHEN k.code = 'C4' THEN sk.id ELSE NULL END) AS sub_id_4,
					MAX(CASE WHEN k.code = 'c1' THEN k.attribute ELSE NULL END) AS c1_attribute,
					MAX(CASE WHEN k.code = 'c2' THEN k.attribute ELSE NULL END) AS c2_attribute,
					MAX(CASE WHEN k.code = 'c3' THEN k.attribute ELSE NULL END) AS c3_attribute,
					MAX(CASE WHEN k.code = 'c4' THEN k.attribute ELSE NULL END) AS c4_attribute
				FROM
					alternatif alt
					JOIN bike bk ON alt.bike_id = bk.id
					JOIN subkriteria sk ON alt.subcriteria_id = sk.id
					JOIN kriteria k ON alt.criteria_id = k.id
				GROUP BY
					bk.id,
					bk.name,
					bk.price,
					bk.year_release,
					bk.engine_power,
					bk.fuel
			),
			min_max AS (
				SELECT
					MIN(c1_weight) AS c1_min,
					MIN(c2_weight) AS c2_min,
					MIN(c3_weight) AS c3_min,
					MIN(c4_weight) AS c4_min,
					MAX(c1_weight) AS c1_max,
					MAX(c2_weight) AS c2_max,
					MAX(c3_weight) AS c3_max,
					MAX(c4_weight) AS c4_max
				FROM
					subquery
			),
			normalize_data AS (
				SELECT
					subquery.id,
					subquery.name,
					subquery.price,
					subquery.year_release,
					subquery.engine_power,
					subquery.fuel,
					CASE
						WHEN c1_attribute = 'Benefit' THEN subquery.c1_weight / min_max.c1_max
						WHEN c1_attribute = 'Cost' THEN min_max.c1_min / subquery.c1_weight
					END AS c1,
					CASE
						WHEN c2_attribute = 'Benefit' THEN subquery.c2_weight / min_max.c2_max
						WHEN c2_attribute = 'Cost' THEN min_max.c2_min / subquery.c2_weight
					END AS c2,
					CASE
						WHEN c3_attribute = 'Benefit' THEN subquery.c3_weight / min_max.c3_max
						WHEN c3_attribute = 'Cost' THEN min_max.c3_min / subquery.c3_weight
					END AS c3,
					CASE
						WHEN c4_attribute = 'Benefit' THEN subquery.c4_weight / min_max.c4_max
						WHEN c4_attribute = 'Cost' THEN min_max.c4_min / subquery.c4_weight
					END AS c4,
					c1_c_weight, c2_c_weight, c3_c_weight, c4_c_weight
				FROM
					subquery
					JOIN min_max ON 1 = 1
			)
			SELECT
				id,
				name,
				price,
				year_release,
				engine_power,
				fuel,
				c1 * c1_c_weight AS c1,
				c2 * c2_c_weight AS c2,
				c3 * c3_c_weight AS c3,
				c4 * c4_c_weight AS c4,
				(c1 * c1_c_weight) + (c2 * c2_c_weight) + (c3 * c3_c_weight) + (c4 * c4_c_weight) AS result
			FROM
				normalize_data order by result desc
			";

		return $this->db->query($select);
	}

	public function preferensi($limit = null,$offset = null, $data = null)
	{
		$bikeId = implode(', ', $data['motorcycle']);

		$option = '';
		if ($limit && $offset) {
            $option = "LIMIT $limit OFFSET $offset";
        } 
		
		$criteriaWeight = "";
        for ($i=1; $i<=4; $i++) {
	
            $criteriaWeight .= 'MAX(CASE WHEN k.code = \'C'.$i.'\' THEN '.$data['c'.$i].' ELSE NULL END) AS c'.$i.'_c_weight,';
        
		}
		//dd($criteriaWeight);
		$select = "WITH subquery AS (
				SELECT
					bk.id,
					bk.name,
					bk.price,
					bk.year_release,
					bk.engine_power,
					bk.fuel,
					bk.attachment,
					MAX(CASE WHEN k.code = 'C1' THEN sk.weight ELSE NULL END) AS c1_weight,
					MAX(CASE WHEN k.code = 'C2' THEN sk.weight ELSE NULL END) AS c2_weight,
					MAX(CASE WHEN k.code = 'C3' THEN sk.weight ELSE NULL END) AS c3_weight,
					MAX(CASE WHEN k.code = 'C4' THEN sk.weight ELSE NULL END) AS c4_weight,
					$criteriaWeight
					MAX(CASE WHEN k.code = 'C1' THEN sk.id ELSE NULL END) AS sub_id_1,
					MAX(CASE WHEN k.code = 'C2' THEN sk.id ELSE NULL END) AS sub_id_2,
					MAX(CASE WHEN k.code = 'C3' THEN sk.id ELSE NULL END) AS sub_id_3,
					MAX(CASE WHEN k.code = 'C4' THEN sk.id ELSE NULL END) AS sub_id_4,
					MAX(CASE WHEN k.code = 'c1' THEN k.attribute ELSE NULL END) AS c1_attribute,
					MAX(CASE WHEN k.code = 'c2' THEN k.attribute ELSE NULL END) AS c2_attribute,
					MAX(CASE WHEN k.code = 'c3' THEN k.attribute ELSE NULL END) AS c3_attribute,
					MAX(CASE WHEN k.code = 'c4' THEN k.attribute ELSE NULL END) AS c4_attribute
				FROM
					alternatif alt
					JOIN bike bk ON alt.bike_id = bk.id
					JOIN subkriteria sk ON alt.subcriteria_id = sk.id
					JOIN kriteria k ON alt.criteria_id = k.id
				WHERE
					bk.id IN ($bikeId)	
				GROUP BY
					bk.id,
					bk.name,
					bk.price,
					bk.year_release,
					bk.engine_power,
					bk.fuel,
					bk.attachment
			),
			min_max AS (
				SELECT
					MIN(c1_weight) AS c1_min,
					MIN(c2_weight) AS c2_min,
					MIN(c3_weight) AS c3_min,
					MIN(c4_weight) AS c4_min,
					MAX(c1_weight) AS c1_max,
					MAX(c2_weight) AS c2_max,
					MAX(c3_weight) AS c3_max,
					MAX(c4_weight) AS c4_max
				FROM
					subquery
			),
			normalize_data AS (
				SELECT
					subquery.id,
					subquery.name,
					subquery.price,
					subquery.year_release,
					subquery.engine_power,
					subquery.fuel,
					subquery.attachment,
					CASE
						WHEN c1_attribute = 'Benefit' THEN subquery.c1_weight / min_max.c1_max
						WHEN c1_attribute = 'Cost' THEN min_max.c1_min / subquery.c1_weight
					END AS c1,
					CASE
						WHEN c2_attribute = 'Benefit' THEN subquery.c2_weight / min_max.c2_max
						WHEN c2_attribute = 'Cost' THEN min_max.c2_min / subquery.c2_weight
					END AS c2,
					CASE
						WHEN c3_attribute = 'Benefit' THEN subquery.c3_weight / min_max.c3_max
						WHEN c3_attribute = 'Cost' THEN min_max.c3_min / subquery.c3_weight
					END AS c3,
					CASE
						WHEN c4_attribute = 'Benefit' THEN subquery.c4_weight / min_max.c4_max
						WHEN c4_attribute = 'Cost' THEN min_max.c4_min / subquery.c4_weight
					END AS c4,
					c1_c_weight, c2_c_weight, c3_c_weight, c4_c_weight
				FROM
					subquery
					JOIN min_max ON 1 = 1
			)
			SELECT
				id,
				name,
				price,
				year_release,
				engine_power,
				fuel,
				attachment,
				c1 * c1_c_weight AS c1,
				c2 * c2_c_weight AS c2,
				c3 * c3_c_weight AS c3,
				c4 * c4_c_weight AS c4,
				(c1 * c1_c_weight) + (c2 * c2_c_weight) + (c3 * c3_c_weight) + (c4 * c4_c_weight) AS result
			FROM
				normalize_data order by result desc $option
			";

		return $this->db->query($select);
	}
}

/* End of file ModelName.php */
