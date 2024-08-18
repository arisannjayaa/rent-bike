<?php
// Memastikan file ini tidak diakses langsung
defined('BASEPATH') or exit('No direct script access allowed');

// Mendefinisikan kelas AdminController yang merupakan turunan dari CI_Controller
class AdminController extends CI_Controller
{
	/**
	 * Fungsi konstruktor untuk kelas AdminController.
	 */
	public function __construct()
	{
		// Memanggil konstruktor parent dari CI_Controller
		parent::__construct();

		// Memuat model yang diperlukan
		$this->load->model('Bike'); // Memuat model 'Bike' untuk pengelolaan data sepeda
		$this->load->model('Criteria'); // Memuat model 'Criteria' untuk pengelolaan kriteria
		$this->load->model('Subcriteria'); // Memuat model 'Subcriteria' untuk pengelolaan subkriteria
		$this->load->model('Alternative'); // Memuat model 'Alternative' untuk pengelolaan alternatif

		// Mengecek apakah user sudah login dengan melihat sesi 'email'
		if (!$this->session->userdata('email')) {
			// Jika belum login, redirect ke halaman utama
			redirect(base_url(''));
		}
	}

	/**
	 * Fungsi untuk menampilkan halaman dashboard admin.
	 */
	public function index()
	{
		
		// Mengambil data user berdasarkan email dari sesi
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();

		// Mengambil data dari tabel 'bike', 'kriteria', 'subkriteria', dan 'alternatif'
		$data['bikes'] = $this->Bike->get_data('bike')->result(); // Mendapatkan semua data sepeda
		$data['criteria'] = $this->Criteria->get_data('kriteria')->result(); // Mendapatkan semua data kriteria
		$data['subcriteria'] = $this->Subcriteria->get_data('subkriteria')->result(); // Mendapatkan semua data subkriteria
		$data['alternatives'] = $this->Alternative->get_data('alternatif')->result(); // Mendapatkan semua data alternatif

		// Memuat view 'admin/dashboard' dengan data yang telah diambil
		return view('admin/dashboard', $data);
	}

	/**
	 * Fungsi untuk mengubah password pengguna.
	 */
	public function change_password()
	{
		$data['title'] = 'Change Password';
		// Mengambil data user berdasarkan email dari sesi
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();

		// Menetapkan aturan validasi form untuk password
		$this->form_validation->set_rules('current_password', 'Current Password', 'required');
		$this->form_validation->set_rules('new_password1', 'New Password', 'required|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|min_length[3]|matches[new_password1]');

		// Jika validasi gagal, tampilkan halaman untuk mengganti password
		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('admin/change_password', $data);
			$this->load->view('template/footer');
		} else {
			// Jika validasi berhasil, lanjutkan dengan proses penggantian password
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');

			// Mengecek apakah current_password yang dimasukkan sesuai dengan yang ada di database
			if (!password_verify($current_password, $data['user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert 
			alert-danger" role="alert">Wrong current password!</div>');
				redirect(base_url('admin/change-password'));
			} else {
				// Mengecek apakah current_password sama dengan new_password
				if ($current_password == $new_password) {
					$this->session->set_flashdata('message', '<div class="alert 
			alert-danger" role="alert">New password cannot be the same as current password!</div>');
					redirect(base_url('admin/change-password'));
				} else {
					// Jika password baru valid, lakukan hashing dan update password di database
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');
					$this->session->set_flashdata('message', '<div class="alert 
			alert-success" role="alert">Password changed!</div>');
					redirect(base_url('admin/change-password'));
				}
			}
		}
	}
}


// Kode di atas adalah sebuah kontroler untuk aplikasi web menggunakan framework CodeIgniter. 
// Berikut adalah penjelasan untuk setiap bagian kode:

// 1 Pengecekan direktori akses script 
// PHP: defined('BASEPATH') or exit('No direct script access allowed'); 
// memastikan bahwa skrip tidak dapat diakses langsung melalui URL, yang umumnya
//  dilakukan pada aplikasi CodeIgniter dengan mendefinisikan konstanta BASEPATH atau keluar
//   jika konstanta tersebut tidak terdefinisi.

// 2 Deklarasi kelas AdminController: class AdminController extends CI_Controller { ... } 
// adalah kelas utama yang mengelola logika bisnis dan presentasi untuk halaman admin.

// 3 Konstruktor kelas AdminController: public function __construct() { ... } adalah fungsi yang 
// dieksekusi secara otomatis setiap kali objek dari kelas AdminController dibuat. Ini memuat
//  model-model yang diperlukan, seperti Bike, Criteria, Subcriteria, dan Alternative. Selain itu,
//   konstruktor ini memeriksa apakah pengguna telah login dengan memeriksa sesi 'email'; jika tidak,
//    pengguna akan diarahkan kembali ke halaman utama.

// 4 Fungsi index(): public function index() { ... } mengatur halaman dashboard admin. 
// Ini mengambil data pengguna berdasarkan email dari sesi dan mengambil data dari tabel bike,
//  kriteria, subkriteria, dan alternatif menggunakan model yang dimuat di konstruktor. Data
//   tersebut kemudian dimuat ke dalam tampilan 'admin/dashboard'.

// 5 Fungsi change_password(): public function change_password() { ... } bertanggung 
// jawab untuk mengelola proses perubahan kata sandi pengguna. Pertama, ia mengambil data 
// pengguna berdasarkan email dari sesi. Kemudian, menetapkan aturan validasi untuk form perubahan 
// kata sandi, termasuk persyaratan untuk kata sandi saat ini, kata sandi baru, dan konfirmasi kata 
// sandi baru. Jika validasi gagal, ia memuat kembali halaman dengan pesan kesalahan yang sesuai.
//  Jika validasi berhasil, ia memeriksa kecocokan kata sandi saat ini dengan yang ada di database 
//  menggunakan fungsi password_verify(). Jika kata sandi saat ini tidak cocok, ia memberikan pesan
//   kesalahan. Jika kata sandi baru sama dengan kata sandi saat ini, ia memberikan pesan kesalahan
//    yang lain. Jika kata sandi baru valid, ia melakukan hashing kata sandi baru dan mengupdate 
//    kata sandi di database menggunakan password_hash(). Kemudian, memberikan pesan keberhasilan 
//    dan mengarahkan kembali ke halaman perubahan kata sandi.

// Ini adalah pengaturan yang umum digunakan dalam aplikasi web berbasis CodeIgniter untuk mengelola 
// akses dan tampilan halaman admin serta proses pengaturan akun pengguna.
