<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MatrixController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Subcriteria'); // Memuat model 'Subcriteria' untuk pengelolaan subkriteria
		$this->load->model('Criteria'); // Memuat model 'Criteria' untuk pengelolaan kriteria
		$this->load->model('Alternative'); // Memuat model 'Alternative' untuk pengelolaan alternatif
		$this->load->model('Bike'); // Memuat model 'Alternative' untuk pengelolaan alternatif
		$this->load->helper('custom');
	}

	/**
	 * load view
	 * @return string
	 */
	public function index()
	{
		if (!$this->session->userdata('email')) {
			// Jika belum login, redirect ke halaman utama
			redirect(base_url(''));
		}
		$data['kriteria'] = $this->Criteria->get_data('kriteria')->result(); // Mendapatkan data kriteria dari model Criteria
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array(); // Mendapatkan data pengguna berdasarkan email dari sesi

		$data['matrix_alternative'] = $this->Alternative->matrix_alternative()->result(); // Mendapatkan hasil matriks alternatif dari model Alternative
		$data['matrix_normalization'] = $this->Alternative->matrix_normalization()->result(); // Mendapatkan hasil normalisasi matriks dari model Alternative
		$data['matrix_preferences'] = $this->Alternative->matrix_preferences()->result(); // Mendapatkan preferensi matriks dari model Alternative

		return view('admin/matrix/index', $data); // Memuat tampilan 'admin/matrix/index' dengan data yang diperoleh
	}

	public function preference()
	{
		if (!$this->session->userdata('email')) {
			// Jika belum login, redirect ke halaman utama
			redirect(base_url(''));
		}
		$data['kriteria'] = $this->Criteria->get_data('kriteria')->result(); // Mendapatkan data kriteria dari model Criteria
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array(); // Mendapatkan data pengguna berdasarkan email dari sesi

		$data['matrix_result'] = $this->Alternative->matrix_result()->result(); // Mendapatkan hasil preferensi matriks dari model Alternative

		return view('admin/preference/index', $data); // Memuat tampilan 'admin/preference/index' dengan data yang diperoleh
	}

	public function recommendation()
	{
		// Mengambil data dari GET request
		$data = $this->input->get();

		// Memeriksa apakah data kosong
		if (count($data) == 0) {
			// Mengatur pesan error jika tidak ada data yang dipilih
			$this->session->set_flashdata('error_message', 'Pilih data motor terlebih dahulu!');
			// Mengarahkan kembali ke halaman rekomendasi
			redirect(base_url('recommendation'));
		}

		// Memeriksa apakah hanya satu motor yang dipilih
		if (count(@$data['motorcycle']) == 1) {
			// Mengatur pesan error jika hanya satu motor yang dipilih
			$this->session->set_flashdata('error_message', 'Pilih data motor lebih dari 1!');
		} else {
			// Menghapus pesan error jika lebih dari satu motor dipilih
			$this->session->unset_userdata('error_message');
		}

		// Memproses data dan mendapatkan hasil preferensi motor
		$result['bikes'] = $this->Alternative->preferensi($data)->result();
		// Mengambil semua data motor yang tersedia
		$result['motorcycles'] = $this->Bike->get_data('bike')->result();

		// Mengembalikan tampilan view dengan hasil rekomendasi
		return view('guest/recommendation', $result);
	}
}

// //Kontroler ini menggunakan framework CodeIgniter untuk mengelola matriks dan preferensi. 
// Konstruktor __construct() memuat model untuk Subcriteria, Criteria, dan Alternative, serta melakukan 
// pengecekan sesi email. Fungsi index() dan preference() memuat data kriteria, data pengguna, dan berbagai 
// hasil matriks dari model Alternative untuk ditampilkan dalam tampilan yang sesuai. Fungsi ini menggunakan 
// view untuk menampilkan informasi tersebut kepada pengguna tergantung dari kebutuhan halaman yang diakses.
