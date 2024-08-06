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
			->select($table . '.*, kriteria.name as kriteria_name, kriteria.code as code')
			->from('subkriteria')
			->join('kriteria', 'kriteria.id = subkriteria.criteria_id')
			->get();
	}
	// Mengambil data dari tabel 'subkriteria' dengan melakukan join ke tabel 'kriteria' dan mengembalikan hasilnya

	/**
	 * get data by id
	 * @param $id
	 * @return mixed
	 */
	public function get_data_by_id($id)
	{
		return $this->db->get_where('subkriteria', array('id' => $id))->row();
	}
	// Mengambil data dari tabel 'subkriteria' berdasarkan id tertentu

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
	// Memasukkan data ke dalam tabel database yang ditentukan

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
	// Memperbarui data dalam tabel database yang ditentukan berdasarkan id yang diberikan dalam $data

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
	// Menghapus data dari tabel database yang ditentukan berdasarkan kondisi tertentu dalam $where

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
		// Memilih kolom yang diperlukan dari tabel 'subkriteria' dengan informasi tambahan dari tabel 'kriteria'

		if ($keyword) {
			$arrKeyword = explode(" ", $keyword);
			// Memecah kata kunci menjadi array jika ada spasi

			for ($i = 0; $i < count($arrKeyword); $i++) {
				$builder = $builder->or_like('subkriteria.name', $arrKeyword[$i]);
				$builder = $builder->or_like('subkriteria.weight', $arrKeyword[$i]);
				// Menambahkan kondisi pencarian (LIKE) untuk setiap kata kunci pada kolom 'name' dan 'weight' dari 'subkriteria'
			}
		}

		if ($start != 0 || $length != 0) {
			$builder = $builder->limit($length, $start);
			// Menambahkan batasan jumlah data yang diambil berdasarkan $start (offset) dan $length (jumlah data)
		}

		return $builder->get()->result();
		// Mengembalikan hasil dari kueri yang dibuat
	}
	// Membuat data tabel dengan kemampuan pencarian berdasarkan kata kunci dan pembatasan jumlah data
}

/* End of file ModelName.php */
