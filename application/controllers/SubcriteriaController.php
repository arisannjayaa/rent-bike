<?php
// Memastikan file ini tidak diakses langsung
defined('BASEPATH') or exit('No direct script access allowed');

// Mendefinisikan kelas SubcriteriaController yang merupakan turunan dari CI_Controller
class SubcriteriaController extends CI_Controller
{
	/**
	 * Konstruktor untuk kelas SubcriteriaController
	 */
	public function __construct()
	{
		// Memanggil konstruktor parent dari CI_Controller
		parent::__construct();

		// Memuat model 'Subcriteria' dan 'Criteria'
		$this->load->model('Subcriteria');
		$this->load->model('Criteria');

		// Memeriksa apakah user sudah login berdasarkan sesi email, jika tidak, redirect ke halaman utama
		if (!$this->session->userdata('email')) {
			redirect(base_url(''));
		}
	}

	/**
	 * Halaman utama subkriteria
	 */
	public function index()
	{
		// Mengambil data kriteria dari tabel 'kriteria' dan menyimpannya dalam array $data['kriteria']
		$data['kriteria'] = $this->Criteria->get_data('kriteria')->result();

		// Mengambil data user berdasarkan email dari tabel 'user' dan menyimpannya dalam array $data['user']
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		// Memuat view 'admin/subcriteria/index' dengan data yang diperoleh
		return view('admin/subcriteria/index', $data);
	}

	/**
	 * Memuat data tabel subkriteria untuk tampilan AJAX
	 */
	public function table()
	{
		// Memeriksa apakah permintaan merupakan permintaan AJAX
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		// Mendapatkan parameter 'draw', 'start', 'length', dan 'search' dari permintaan
		$param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
		$start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
		$length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
		$search = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

		// Memanggil metode 'datatable' dari model 'Subcriteria' untuk mengambil data subkriteria
		$data = $this->Subcriteria->datatable($search, $start, $length);
		$total_count = $this->Subcriteria->datatable($search);

		// Mengembalikan respons JSON berisi data tabel subkriteria dan informasi terkait
		echo json_encode([
			'draw' => intval($param['draw']),
			'recordsTotal' => count($total_count),
			'recordsFiltered' => count($total_count),
			'data' => $data
		]);
	}

	/**
	 * Menyimpan data subkriteria baru
	 */
	public function store()
	{
		// Memeriksa apakah permintaan merupakan permintaan AJAX
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		// Memanggil fungsi validasi aturan input
		$this->_rules();

		// Jika validasi form gagal
		if ($this->form_validation->run() == FALSE) {
			$this->output->set_status_header(400); // Set header status 400 (Bad Request)
			$errors = $this->form_validation->error_array(); // Mendapatkan daftar error validasi

			$errorObj = [];
			foreach ($errors as $key => $value) {
				$errorObj[$key] = [[$value]]; // Menyusun pesan error validasi dalam bentuk objek JSON
			}

			echo json_encode(array('errors' => $errorObj)); // Mengembalikan respons JSON dengan pesan error validasi
			return;
		}

		// Menyiapkan data untuk disimpan ke dalam tabel 'subkriteria'
		$data = array(
			'criteria_id' => $this->input->post('criteria_id'), // Mendapatkan ID kriteria
			'name' => $this->input->post('name'), // Mendapatkan nama subkriteria
			'weight' => $this->input->post('weight'), // Mendapatkan bobot subkriteria
		);

		$this->output->set_status_header(200); // Set header status 200 (OK)
		$this->Subcriteria->insert_data($data, 'subkriteria'); // Memanggil metode model untuk menyimpan data baru ke dalam tabel 'subkriteria'
		echo json_encode(array('status' => "OK", 'code' => 200, 'message' => "Data subkriteria berhasil ditambahkan")); // Mengembalikan respons JSON dengan pesan sukses
	}

	/**
	 * Mengambil data subkriteria berdasarkan ID untuk proses edit
	 * @param $id
	 * @return void
	 */
	public function edit($id)
	{
		// Memeriksa apakah permintaan merupakan permintaan AJAX
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		$this->output->set_status_header(200); // Set header status 200 (OK)
		echo json_encode(array('success' => true, 'code' => 200, 'data' => $this->Subcriteria->get_data_by_id($id))); // Mengembalikan data subkriteria berdasarkan ID dalam respons JSON
	}

	/**
	 * Memperbarui data subkriteria
	 */
	public function update()
	{
		// Memeriksa apakah permintaan merupakan permintaan AJAX
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		// Memanggil fungsi validasi aturan input
		$this->_rules();

		// Jika validasi form gagal
		if ($this->form_validation->run() == FALSE) {
			$this->output->set_status_header(400); // Set header status 400 (Bad Request)
			$errors = $this->form_validation->error_array(); // Mendapatkan daftar error validasi

			$errorObj = [];
			foreach ($errors as $key => $value) {
				$errorObj[$key] = [[$value]]; // Menyusun pesan error validasi dalam bentuk objek JSON
			}

			echo json_encode(array('errors' => $errorObj)); // Mengembalikan respons JSON dengan pesan error validasi
			return;
		}

		// Menyiapkan data untuk proses pembaruan data subkriteria
		$data = array(
			'id' => $this->input->post('id'), // Mendapatkan ID data subkriteria yang akan diperbarui
			'criteria_id' => strtoupper($this->input->post('criteria_id')), // Mendapatkan dan mengonversi ID kriteria ke huruf besar
			'name' => $this->input->post('name'), // Mendapatkan nama subkriteria
			'weight' => $this->input->post('weight'), // Mendapatkan bobot subkriteria
		);

		$this->output->set_status_header(200); // Set header status 200 (OK)
		$this->Subcriteria->update_data($data, 'subkriteria'); // Memanggil metode model untuk memperbarui data subkriteria dalam tabel 'subkriteria'
		echo json_encode(array('status' => "OK", 'code' => 200, 'message' => "Data subkriteria berhasil diupdate")); // Mengembalikan respons JSON dengan pesan sukses
	}

	/**
	 * Menghapus data subkriteria berdasarkan ID
	 */
	public function delete()
	{
		// Memeriksa apakah permintaan merupakan permintaan AJAX
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		$where = array('id' => $this->input->post('id')); // Mendapatkan ID data subkriteria yang akan dihapus

		$this->Subcriteria->delete($where, 'subkriteria'); // Memanggil metode model untuk menghapus data subkriteria berdasarkan ID dalam tabel 'subkriteria'
		$this->output->set_status_header(200); // Set header status 200 (OK)
		echo json_encode(array('success' => true, 'code' => 200, 'message' => "Data subkriteria berhasil dihapus")); // Mengembalikan respons JSON dengan pesan sukses
	}

	/**
	 * Menetapkan aturan validasi untuk input data subkriteria
	 */
	public function _rules()
	{
		$this->form_validation->set_rules('criteria_id', 'Kriteria', 'required', array(
			'required' => '%s field tidak boleh kosong' // Pesan error untuk bidang 'criteria_id' yang diperlukan
		));
		$this->form_validation->set_rules('name', 'Nama', 'required', array(
			'required' => '%s field tidak boleh kosong', // Pesan error untuk bidang 'name' yang diperlukan
		));
		$this->form_validation->set_rules('weight', 'Bobot', 'required|numeric', array(
			'required' => 'The %s field tidak boleh kosong.', // Pesan error untuk bidang 'weight' yang diperlukan
			'numeric' => 'The %s field harus berupa angka', // Pesan error untuk bidang 'weight' yang harus berupa angka
		));
	}
}
