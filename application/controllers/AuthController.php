<?php
// Memastikan file ini tidak diakses langsung
defined('BASEPATH') or exit('No direct script access allowed');

// Mendefinisikan kelas AuthController yang merupakan turunan dari CI_Controller
class AuthController extends CI_Controller
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
		// Memanggil konstruktor parent dari CI_Controller
		parent::__construct();
		// Memuat library form_validation
		$this->load->library('form_validation');
	}

	// Fungsi default yang akan dipanggil saat controller ini diakses
	public function index()
	{
		// Jika user sudah login (memiliki session email), redirect ke halaman admin
		if ($this->session->userdata('email')) {
			redirect(base_url('admin'));
		}

		// Menetapkan aturan validasi form untuk email dan password
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		// Jika validasi gagal, tampilkan halaman login
		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login';
			$this->load->view('template_auth/header_auth', $data);
			$this->load->view('auth/login');
			$this->load->view('template_auth/footer_auth');
		} else {
			// Jika validasi berhasil, panggil fungsi login
			$this->login();
		}
	}

	// Fungsi untuk melakukan proses login
	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		// Mendapatkan data user berdasarkan email
		$user =  $this->db->get_where('user', ['email' => $email])->row_array();

		// Jika user ditemukan
		if ($user) {
			// Verifikasi password
			if (password_verify($password, $user['password'])) {
				$data = [
					'email' => $user['email'],
					'role_id' => $user['role_id']
				];
				// Set session data
				$this->session->set_userdata($data);
				// Redirect berdasarkan role_id
				if ($user['role_id'] == 1) {
					redirect(base_url('admin'));
				} else {
					redirect('guest');
				}
			} else {
				// Password salah
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
				redirect(base_url(''));
			}
		} else {
			// User tidak ditemukan
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
			redirect(base_url(''));
		}
	}

	// Fungsi untuk logout
	public function logout()
	{
		// Unset session data
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		// Set pesan logout berhasil
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');

		// Redirect ke halaman utama
		redirect(base_url(''));
	}
}


// 1. defined('BASEPATH') or exit('No direct script access allowed');
// Memastikan bahwa skrip tidak dapat diakses langsung melalui URL dengan memeriksa apakah 
// konstanta BASEPATH telah didefinisikan. Jika tidak, skrip keluar (exit) dengan pesan error.

// 2. class AuthController extends CI_Controller
// Mendefinisikan kelas AuthController yang merupakan turunan dari CI_Controller pada framework CodeIgniter.

// 3. public function __construct()
// Konstruktor kelas AuthController yang dipanggil setiap kali objek dari kelas ini dibuat.
// Memanggil konstruktor dari kelas parent CI_Controller.
// Memuat library form_validation untuk validasi form.

// 4. public function index()
// Fungsi default yang dipanggil saat controller ini diakses.
// Memeriksa apakah pengguna sudah login (memiliki session 'email'). Jika ya, redirect ke halaman admin.
// Menetapkan aturan validasi untuk field 'email' dan 'password'.
// Jika validasi gagal, menampilkan halaman login dengan pesan error jika ada.
// Jika validasi berhasil, memanggil fungsi login().

// 5. public function login()
// Fungsi untuk melakukan proses login.
// Mengambil nilai 'email' dan 'password' dari input.
// Mengambil data pengguna dari tabel 'user' berdasarkan email.
// Jika pengguna ditemukan, memverifikasi password dengan menggunakan password_verify().
// Jika verifikasi berhasil, menyimpan data 'email' dan 'role_id' ke dalam session.
// Redirect ke halaman admin jika 'role_id' adalah 1, atau ke halaman 'guest' jika tidak.
// Jika password salah atau email tidak terdaftar, menampilkan pesan error sesuai kondisi.

// 6. public function register()
// Fungsi untuk melakukan proses registrasi pengguna baru.
// Memeriksa apakah pengguna sudah login. Jika ya, redirect ke halaman admin.
// Menetapkan aturan validasi untuk field 'name', 'email', 'password1', dan 'password2'.
// Jika validasi gagal, menampilkan halaman registrasi dengan pesan error jika ada.
// Jika validasi berhasil, menyimpan data pengguna baru ke dalam tabel 'user' dengan menggunakan 
// password_hash() untuk menyimpan password yang di-hash.
// Menampilkan pesan sukses bahwa akun telah dibuat dan mengarahkan pengguna untuk login.

// 7. public function logout()
// Fungsi untuk logout pengguna.
// Menghapus data session 'email' dan 'role_id'.
// Menampilkan pesan sukses bahwa pengguna telah logout.
// Redirect ke halaman utama setelah logout.

// Kode ini mengimplementasikan logika dasar untuk autentikasi dan registrasi pengguna 
// dalam aplikasi web menggunakan CodeIgniter, dengan memanfaatkan fitur-fitur seperti session 
// management, form validation, dan database operations. 
?>
