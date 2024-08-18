<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CriteriaController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Criteria'); // Memuat model Criteria
		if (!$this->session->userdata('email')) { // Memeriksa apakah sesi email pengguna ada
			redirect(base_url('')); // Mengarahkan kembali ke halaman utama jika tidak ada sesi email
		}
	}

	/**
	 * load view
	 * @return string
	 */
	public function index()
	{
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array(); // Mengambil data pengguna berdasarkan email dari tabel 'user'

		return view('admin/criteria/index', $data); // Memuat tampilan 'admin/criteria/index' dengan data yang diperoleh
	}

	/**
	 * load table
	 * @return void
	 */
	public function table()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed'); // Menghentikan akses langsung jika bukan permintaan AJAX
		}

		$param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
		$start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
		$length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
		$search = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
		$data = $this->Criteria->datatable($search, $start, $length); // Memanggil metode model untuk mengambil data tabel dengan parameter pencarian, mulai, dan panjang
		$total_count = $this->Criteria->datatable($search); // Menghitung total data berdasarkan parameter pencarian

		echo json_encode([
			'draw' => intval($param['draw']),
			'recordsTotal' => count($total_count),
			'recordsFiltered' => count($total_count),
			'data' => $data
		]); // Mengembalikan respons JSON berisi data tabel dan informasi terkait
	}

	/**
	 * create data
	 * @return void
	 */
	public function store()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed'); // Menghentikan akses langsung jika bukan permintaan AJAX
		}

		$this->_rules(); // Memanggil fungsi validasi aturan input
		if ($this->form_validation->run() == FALSE) { // Jika validasi gagal
			$this->output->set_status_header(400); // Set header status 400 (Bad Request)
			$errors = $this->form_validation->error_array(); // Mendapatkan daftar error validasi

			$errorObj = [];
			foreach ($errors as $key => $value) {
				$errorObj[$key] = [[$value]]; // Menyusun pesan error validasi dalam bentuk objek JSON
			}

			echo json_encode(array('errors' => $errorObj)); // Mengembalikan respons JSON dengan pesan error validasi
			return;
		}

		$data = array(
			'code' => strtoupper($this->input->post('code')), // Mendapatkan dan mengonversi kode ke huruf besar
			'name' => $this->input->post('name'), // Mendapatkan nama
			'attribute' => $this->input->post('attribute'), // Mendapatkan atribut
			'weight' => $this->input->post('weight'), // Mendapatkan bobot
		);

		$this->output->set_status_header(200); // Set header status 200 (OK)
		$this->Criteria->insert_data($data, 'kriteria'); // Memanggil metode model untuk menyimpan data baru ke dalam tabel 'kriteria'
		echo json_encode(array('status' => "OK", 'code' => 200, 'message' => "Data kriteria berhasil ditambahkan")); // Mengembalikan respons JSON dengan pesan sukses
	}

	/**
	 * get data by id
	 * @param $id
	 * @return void
	 */
	public function edit($id)
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed'); // Menghentikan akses langsung jika bukan permintaan AJAX
		}

		$this->output->set_status_header(200); // Set header status 200 (OK)
		echo json_encode(array('success' => true, 'code' => 200, 'data' => $this->Criteria->get_data_by_id($id))); // Mengembalikan data kriteria berdasarkan ID dalam respons JSON
	}

	/**
	 * update data
	 * @return void
	 */
	public function update()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed'); // Menghentikan akses langsung jika bukan permintaan AJAX
		}

		$this->_rules(); // Memanggil fungsi validasi aturan input

		if ($this->form_validation->run() == FALSE) { // Jika validasi gagal
			$this->output->set_status_header(400); // Set header status 400 (Bad Request)
			$errors = $this->form_validation->error_array(); // Mendapatkan daftar error validasi

			$errorObj = [];
			foreach ($errors as $key => $value) {
				$errorObj[$key] = [[$value]]; // Menyusun pesan error validasi dalam bentuk objek JSON
			}

			echo json_encode(array('errors' => $errorObj)); // Mengembalikan respons JSON dengan pesan error validasi
			return;
		}

		$data = array(
			'id' => $this->input->post('id'), // Mendapatkan ID data yang akan diperbarui
			'code' => strtoupper($this->input->post('code')), // Mendapatkan dan mengonversi kode ke huruf besar
			'name' => $this->input->post('name'), // Mendapatkan nama
			'attribute' => $this->input->post('attribute'), // Mendapatkan atribut
			'weight' => $this->input->post('weight'), // Mendapatkan bobot
		);

		$this->output->set_status_header(200); // Set header status 200 (OK)
		$this->Criteria->update_data($data, 'kriteria'); // Memanggil metode model untuk memperbarui data kriteria dalam tabel 'kriteria'
		echo json_encode(array('status' => "OK", 'code' => 200, 'message' => "Data kriteria berhasil diupdate")); // Mengembalikan respons JSON dengan pesan sukses
	}

	/**
	 * delete data
	 * @return void
	 */
	public function delete()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed'); // Menghentikan akses langsung jika bukan permintaan AJAX
		}

		$where = array('id' => $this->input->post('id')); // Mendapatkan ID data yang akan dihapus

		$this->Criteria->delete($where, 'kriteria'); // Memanggil metode model untuk menghapus data kriteria berdasarkan ID dalam tabel 'kriteria'
		$this->output->set_status_header(200); // Set header status 200 (OK)
		echo json_encode(array('success' => true, 'code' => 200, 'message' => "Data kriteria berhasil dihapus")); // Mengembalikan respons JSON dengan pesan sukses
	}

	/**
	 * create rules validation
	 * @return void
	 */
	public function _rules()
	{
		$this->form_validation->set_rules('code', 'Kode', 'required|regex_match[/^c/i]', array(
			'required' => '%s field tidak boleh kosong', // Pesan error untuk bidang kode yang diperlukan
			'regex_match' => 'The %s field harus diawali huruf c', // Pesan error untuk pola regex pada bidang kode
		));
		$this->form_validation->set_rules('attribute', 'Atribut', 'required', array(
			'required' => '%s field tidak boleh kosong' // Pesan error untuk bidang atribut yang diperlukan
		));
		$this->form_validation->set_rules('name', 'Nama', 'required', array(
			'required' => '%s field tidak boleh kosong', // Pesan error untuk bidang nama yang diperlukan
		));
		$this->form_validation->set_rules('weight', 'Bobot', 'required|numeric', array(
			'required' => 'The %s field tidak boleh kosong.', // Pesan error untuk bidang bobot yang diperlukan
			'numeric' => 'The %s field harus berupa angka', // Pesan error jika bidang bobot bukan numerik
		));
	}
}


