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
		$data = $this->input->get();
		
		$countTotal = array_sum($this->input->get());
		for ($i=1; $i<=4; $i++) {
			$data['c'.$i] = $data['c'.$i] / $countTotal;
		}
		$this->load->library('pagination'); // Memuat library pagination untuk paging

		$bikes = $this->Alternative->get_data('alternatif')->num_rows(); // Mendapatkan jumlah baris data sepeda dari model Bike

		$config['base_url'] = base_url('recommendation/preferensi'); // URL dasar untuk pagination
		$config['page_query_string'] = TRUE; // Mengaktifkan query string untuk paging
		$config['total_rows'] = $bikes; // Jumlah total baris data
		$config['per_page'] = 6; // Jumlah data per halaman

		$limit = $config['per_page']; // Jumlah data per halaman
		$offset = html_escape($this->input->get('per_page')); // Mendapatkan offset dari query string

		$this->pagination->initialize($config);
		$result['bikes']= $this->Alternative->preferensi($limit,$offset, $data)->result();
		$result['motorcycles'] = $this->Bike->get_data('bike')->result();

		return view('guest/recommendation', $result);
	}
}

// //Kontroler ini menggunakan framework CodeIgniter untuk mengelola matriks dan preferensi. 
// Konstruktor __construct() memuat model untuk Subcriteria, Criteria, dan Alternative, serta melakukan 
// pengecekan sesi email. Fungsi index() dan preference() memuat data kriteria, data pengguna, dan berbagai 
// hasil matriks dari model Alternative untuk ditampilkan dalam tampilan yang sesuai. Fungsi ini menggunakan 
// view untuk menampilkan informasi tersebut kepada pengguna tergantung dari kebutuhan halaman yang diakses.

