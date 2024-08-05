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
	// Mengambil semua data dari tabel yang ditentukan ($table)

	/**
	 * get data where not in
	 * @param $table
	 * @return mixed
	 */
	public function get_data_where_not($table)
	{
		// Query untuk mendapatkan semua ID sepeda motor yang ada dalam tabel alternatif
		$alternative =  $this->db
			->select('bike.id')
			->from('alternatif')
			->join('kriteria', 'kriteria.id = alternatif.criteria_id')
			->join('subkriteria', 'subkriteria.id = alternatif.subcriteria_id')
			->join('bike', 'bike.id = alternatif.bike_id')
			->group_by('bike.id')
			->get()
			->result_array();

		// Menyimpan semua ID sepeda motor dalam array
		$arrAlternative = array_column($alternative, 'id');

		// Jika tidak ada data alternatif, ambil semua data dari tabel $table
		if (count($arrAlternative) == 0) {
			return $this->get_data($table);
		}

		// Ambil data dari tabel $table dimana ID tidak ada dalam $arrAlternative
		return $this->db
			->select('*')
			->from($table)
			->where_not_in('id', $arrAlternative)
			->get();
	}
	// Mengambil data dari tabel $table dimana ID tidak termasuk dalam data alternatif

	/**
	 * get data by id
	 * @param $id
	 * @return mixed
	 */
	public function get_data_by_id($id) {
		return $this->db->get_where('bike', array('id' => $id))->row();
	}
	// Mengambil data dari tabel 'bike' berdasarkan ID tertentu

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
	// Memasukkan data ke dalam tabel database yang ditentukan ($table)

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
	// Memperbarui data dalam tabel database yang ditentukan ($table) berdasarkan ID tertentu

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
	// Menghapus data dari tabel database yang ditentukan ($table) berdasarkan kondisi tertentu

	/**
	 * make datatable
	 * @param $keyword
	 * @param $start
	 * @param $length
	 * @return mixed
	 */
	public function datatable($keyword = null, $start = 0, $length = 0)
	{
		// Membuat query dasar untuk tabel 'bike'
		$builder = $this->db->select("*")->from('bike');

		// Jika ada kata kunci pencarian ($keyword), tambahkan kondisi 'LIKE' untuk beberapa kolom
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

		// Jika ada batasan jumlah data yang diambil ($start != 0 atau $length != 0), tambahkan LIMIT
		if($start != 0 || $length != 0) {
			$builder = $builder->limit($length, $start);
		}

		// Eksekusi query dan kembalikan hasilnya
		return $builder->get()->result();
	}
	// Membuat datatable dengan kemampuan pencarian berdasarkan kata kunci dan pembatasan jumlah data

	public function insert_batch($table, $data)
	{
		// Mengosongkan tabel 'alternatif' dan tabel yang ditentukan sebelum memasukkan data batch baru
		$this->db->empty_table("alternatif");
		$this->db->empty_table($table);
		// Memasukkan data batch ke dalam tabel yang ditentukan
		return $this->db->insert_batch($table, $data);
	}
	// Memasukkan data dalam jumlah besar (batch) ke dalam tabel database yang ditentukan

	public function paginate($limit = null, $offset = null)
    {
        // Membuat query dasar untuk tabel 'bike' dengan pengurutan berdasarkan ID secara descending
        if (!$limit && !$offset) {
            $query = $this->db
                ->select('*')
                ->from('bike')
                ->order_by('id', 'desc');
        } else {
            // Jika ada batasan jumlah data yang diambil ($limit dan $offset), tambahkan LIMIT dan OFFSET
            $query = $this->db
                ->select('*')
                ->from('bike')
                ->limit($limit)
                ->offset($offset)
                ->order_by('id', 'desc');
        }

        // Eksekusi query dan kembalikan hasilnya
        return $query->get();
    }
    // Membuat data paginasi dengan opsi untuk menentukan batasan jumlah data yang diambil dan offsetnya
}

/* End of file Bike.php */
