<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation'); // Memuat library form_validation untuk validasi formulir
		$this->load->library('pagination'); // Memuat library pagination untuk paging
		$this->load->model('Alternative'); // Memuat model Alternative untuk pengelolaan data alternatif
		$this->load->model('Bike'); // Memuat model Bike untuk pengelolaan data sepeda
		$this->load->helper('currency_helper'); // Memuat helper currency_helper untuk format mata uang
	}

	public function home()
	{
		$this->load->library('pagination'); // Memuat library pagination untuk paging

		$bikes = $this->Bike->get_data('bike')->num_rows(); // Mendapatkan jumlah baris data sepeda dari model Bike

		$config['base_url'] = base_url('home'); // URL dasar untuk pagination
		$config['page_query_string'] = TRUE; // Mengaktifkan query string untuk paging
		$config['total_rows'] = $bikes; // Jumlah total baris data
		$config['per_page'] = 6; // Jumlah data per halaman

		$limit = $config['per_page']; // Jumlah data per halaman
		$offset = html_escape($this->input->get('per_page')); // Mendapatkan offset dari query string

		$this->pagination->initialize($config); // Menginisialisasi konfigurasi pagination

		$data['bikes'] = $this->Bike->paginate($limit, $offset)->result(); // Mendapatkan data sepeda dengan pagination

		return view('guest/home', $data); // Memuat tampilan 'guest/home' dengan data sepeda
	}

	public function recommendation()
	{
		$this->load->library('pagination'); // Memuat library pagination untuk paging

		$bikes = $this->Bike->get_data('bike')->num_rows(); // Mendapatkan jumlah baris data sepeda dari model Bike

		$config['base_url'] = base_url('home'); // URL dasar untuk pagination
		$config['page_query_string'] = TRUE; // Mengaktifkan query string untuk paging
		$config['total_rows'] = $bikes; // Jumlah total baris data
		$config['per_page'] = 6; // Jumlah data per halaman

		$limit = $config['per_page']; // Jumlah data per halaman
		$offset = html_escape($this->input->get('per_page')); // Mendapatkan offset dari query string

		$this->pagination->initialize($config); // Menginisialisasi konfigurasi pagination

		$data['bikes'] = $this->Bike->paginate($limit, $offset)->result(); // Mendapatkan data sepeda dengan pagination
		$data['motorcycles'] = $this->Bike->get_data('bike')->result();
		return view('guest/recommendation', $data); // Memuat tampilan 'guest/recommendation' dengan data sepeda
	}

	public function contact()
	{
		return view('guest/contact'); // Memuat tampilan 'guest/contact'
	}
}

// Kontroler ini menggunakan framework CodeIgniter untuk mengelola halaman beranda, 
// rekomendasi, dan kontak. Fungsi home() dan recommendation() melakukan pagination untuk 
// menampilkan data sepeda dengan menggunakan library pagination untuk mengatur halaman dan 
// menampilkan data dalam format yang sesuai untuk tampilan pengguna. Fungsi contact() hanya 
// memuat tampilan halaman kontak tanpa pengaturan pagination.
