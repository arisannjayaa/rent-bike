<?php
// Pastikan file ini tidak diakses langsung
defined('BASEPATH') or exit('No direct script access allowed');

// Memuat file autoload dari vendor untuk menggunakan PhpSpreadsheet
require 'vendor/autoload.php';

// Menggunakan namespace PhpOffice\PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Mendefinisikan kelas BikeController yang merupakan turunan dari CI_Controller
class BikeController extends CI_Controller
{

	// Konstruktor untuk kelas BikeController
	public function __construct()
	{
		// Memanggil konstruktor parent dari CI_Controller
		parent::__construct();

		// Memuat model Bike
		$this->load->model('Bike');

		// Memuat helper custom
		$this->load->helper('custom');

		// Memeriksa apakah user sudah login, jika belum, redirect ke halaman utama
		
	}

	/**
	 * Fungsi untuk memuat tampilan halaman utama
	 * @return string
	 */
	public function index()
	{
		if (!$this->session->userdata('email')) {
			// Jika belum login, redirect ke halaman utama
			redirect(base_url(''));
		}
		// Mengambil data user berdasarkan email dari sesi
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		// Memuat view 'admin/bike/index' dengan data user
		return view('admin/bike/index', $data);
	}

	// Fungsi untuk memuat data tabel bike secara AJAX
	public function table()
	{
		// Memastikan bahwa request ini adalah AJAX request
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		// Mengambil parameter untuk datatable
		$param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
		$start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
		$length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
		$search = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';

		// Mengambil data bike dari model Bike
		$data = $this->Bike->datatable($search, $start, $length);
		$total_count = $this->Bike->datatable($search);

		// Mengirimkan data dalam format JSON
		echo json_encode([
			'draw' => intval($param['draw']),
			'recordsTotal' => count($total_count),
			'recordsFiltered' => count($total_count),
			'data' => $data
		]);
	}

	/**
	 * Fungsi untuk membuat data baru
	 * @return void
	 */
	public function store()
	{
		if (!$this->session->userdata('email')) {
			// Jika belum login, redirect ke halaman utama
			redirect(base_url(''));
		}
		// Memastikan bahwa request ini adalah AJAX request
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		// Menetapkan aturan validasi form
		$this->_rules();

		// Memeriksa apakah file attachment diunggah
		if (empty($_FILES['attachment']['name'])) {
			$this->form_validation->set_rules('attachment', 'Attachment', 'required', array(
				'required' => 'The %s field tidak boleh kosong.',
			));
		}

		// Jika validasi gagal, mengirimkan respon error
		if ($this->form_validation->run() == FALSE) {
			$this->output->set_status_header(400);
			$errors = $this->form_validation->error_array();

			$errorObj = [];
			foreach ($errors as $key => $value) {
				$errorObj[$key] = [[$value]];
			}

			echo json_encode(array('errors' => $errorObj));
			return;
		}

		// Menentukan path untuk menyimpan file attachment
		$path = 'uploads/attachments/';

		// Membuat direktori jika belum ada
		if (!is_dir($path)) {
			mkdir($path, 0777, TRUE);
		}

		// Konfigurasi untuk mengunggah file
		$config['upload_path'] = './' . $path;
		$config['allowed_types'] = 'jpg|png';
		$config['max_filename'] = '255';
		$config['encrypt_name'] = TRUE;
		$config['max_size'] = 1024;
		$this->load->library('upload', $config);

		// Mengunggah file
		if (!$this->upload->do_upload("attachment")) {
			$this->output->set_status_header(400);
			echo json_encode(array('errors' => "Terjadi error saat upload"));
			return;
		}

		// Mengambil data file yang diunggah
		$file_data = $this->upload->data();
		$file_name = $path . $file_data['file_name'];

		// Menyimpan data bike yang baru
		$data = array(
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'year_release' => $this->input->post('year_release'),
			'engine_power' => $this->input->post('engine_power'),
			'fuel' => $this->input->post('fuel'),
			'telp' => $this->input->post('telp'),
			'vendor' => $this->input->post('vendor'),
			'address' => $this->input->post('address'),
			'attachment' => $file_name
		);

		// Mengirimkan respon sukses
		$this->output->set_status_header(200);
		$this->Bike->insert_data($data, 'bike');
		echo json_encode(array('status' => "OK", 'code' => 200, 'message' => "Data bike berhasil ditambahkan"));
	}

	/**
	 * Fungsi untuk mengambil data berdasarkan ID
	 * @param $id
	 * @return void
	 */
	public function edit($id)
	{
		
		// Memastikan bahwa request ini adalah AJAX request
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		// Mengirimkan respon data bike berdasarkan ID dalam format JSON
		$this->output->set_status_header(200);
		echo json_encode(array('success' => true, 'code' => 200, 'data' => $this->Bike->get_data_by_id($id)));
	}

	/**
	 * Fungsi untuk memperbarui data
	 * @return void
	 */
	public function update()
	{
		if (!$this->session->userdata('email')) {
			// Jika belum login, redirect ke halaman utama
			redirect(base_url(''));
		}
		// Memastikan bahwa request ini adalah AJAX request
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		// Mengambil data attachment lama
		$old_attachment = $this->input->post('old_attachment');

		// Menetapkan aturan validasi form
		$this->_rules();

		// Memeriksa apakah attachment lama kosong dan tidak ada attachment baru yang diunggah
		if ($old_attachment === NULL && $_FILES['attachment']['name'] == '') {
			$this->form_validation->set_rules('attachment', 'Attachment', 'required', array(
				'required' => 'The %s field tidak boleh kosong.',
			));
		}

		// Jika validasi gagal, mengirimkan respon error
		if ($this->form_validation->run() == FALSE) {
			$this->output->set_status_header(400);
			$errors = $this->form_validation->error_array();

			$errorObj = [];
			foreach ($errors as $key => $value) {
				$errorObj[$key] = [[$value]];
			}

			echo json_encode(array('errors' => $errorObj));
			return;
		}

		// Jika ada attachment baru yang diunggah
		if ($_FILES['attachment']['name']) {
			// Menentukan path untuk menyimpan file attachment
			$path = 'uploads/attachments/';

			// Membuat direktori jika belum ada
			if (!is_dir($path)) {
				mkdir($path, 0777, TRUE);
			}

			// Konfigurasi untuk mengunggah file
			$config['upload_path'] = './' . $path;
			$config['allowed_types'] = 'jpg|png';
			$config['max_filename'] = '255';
			$config['encrypt_name'] = TRUE;
			$config['max_size'] = 1024;
			$this->load->library('upload', $config);

			// Mengunggah file
			if (!$this->upload->do_upload("attachment")) {
				$this->output->set_status_header(400);
				echo json_encode(array('errors' => "Terjadi error saat upload"));
				return;
			}

			// Mengambil data file yang diunggah
			$file_data = $this->upload->data();
			$file_name = $path . $file_data['file_name'];

			// Jika ada attachment lama, hapus dari server
			if ($old_attachment !== NULL) {
				if (file_exists('./' . $old_attachment)) {
					unlink('./' . $old_attachment);
				}
			}
		} else {
			// Jika tidak ada attachment baru, gunakan attachment lama
			$file_name = $old_attachment;
		}

		// Menyimpan data bike yang diperbarui
		$data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'year_release' => $this->input->post('year_release'),
			'engine_power' => $this->input->post('engine_power'),
			'fuel' => $this->input->post('fuel'),
			'telp' => $this->input->post('telp'),
			'vendor' => $this->input->post('vendor'),
			'address' => $this->input->post('address'),
			'attachment' => $file_name
		);

		// Mengirimkan respon sukses
		$this->output->set_status_header(200);
		$this->Bike->update_data($data, 'bike');
		echo json_encode(array('status' => "OK", 'code' => 200, 'message' => "Data bike berhasil diupdate"));
	}

	/**
	 * Fungsi untuk menghapus data
	 * @return void
	 */
	public function delete()
	{
		if (!$this->session->userdata('email')) {
			// Jika belum login, redirect ke halaman utama
			redirect(base_url(''));
		}
		// Memastikan bahwa request ini adalah AJAX request
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		// Menentukan kondisi untuk menghapus data berdasarkan ID
		$where = array('id' => $this->input->post('id'));

		// Menghapus data dari database
		$this->Bike->delete($where, 'bike');

		// Mengirimkan respon sukses
		$this->output->set_status_header(200);
		echo json_encode(array('success' => true, 'code' => 200, 'message' => "Data bike berhasil dihapus"));
	}

	/**
	 * Fungsi untuk membuat aturan validasi
	 * @return void
	 */
	public function _rules()
	{
		// Menetapkan aturan validasi untuk setiap field
		$this->form_validation->set_rules('name', 'Nama', 'required', array(
			'required' => '%s field tidak boleh kosong'
		));
		$this->form_validation->set_rules('price', 'Harga', 'required|numeric', array(
			'required' => '%s field tidak boleh kosong',
			'numeric' => 'The %s field harus berupa angka.',
		));
		$this->form_validation->set_rules('year_release', 'Tahun', 'required', array(
			'required' => 'The %s field tidak boleh kosong.',
		));
		$this->form_validation->set_rules('engine_power', 'Kekuatan Mesin', 'required', array(
			'required' => 'The %s field tidak boleh kosong.',
		));
		$this->form_validation->set_rules('fuel', 'Bahan Bakar', 'required', array(
			'required' => 'The %s field tidak boleh kosong.',
		));
		$this->form_validation->set_rules('vendor', 'Vendor', 'required', array(
			'required' => 'The %s field tidak boleh kosong.',
		));
		$this->form_validation->set_rules('address', 'address', 'required', array(
			'required' => 'The %s field tidak boleh kosong.',
		));
		$this->form_validation->set_rules('telp', 'telp', 'required', array(
			'required' => 'The %s field tidak boleh kosong.',
		));
	}

	// Fungsi untuk mengambil semua data bike
	public function get_all()
	{
		// Memastikan bahwa request ini adalah AJAX request
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		// Mengirimkan respon data bike dalam format JSON
		$this->output->set_status_header(200);
		echo json_encode(array('success' => true, 'code' => 200, 'data' => $this->Bike->get_data_where_not('bike')->result()));
	}

	// Fungsi untuk mengimpor data dari file
	public function import()
	{
		// Menentukan path untuk menyimpan file yang diunggah
		$path = 'uploads/documents/';

		// Membuat direktori jika belum ada
		if (!is_dir($path)) {
			mkdir($path, 0777, TRUE);
		}

		// Konfigurasi untuk mengunggah file
		$config['upload_path'] = './' . $path;
		$config['allowed_types'] = 'csv|CSV|xlsx|XLSX|xls|XLS';
		$config['max_filename'] = '255';
		$config['encrypt_name'] = TRUE;
		$config['max_size'] = 4096;
		$this->load->library('upload', $config);

		// Mengunggah file
		if (!$this->upload->do_upload('import')) {
			$this->output->set_status_header(400);
			echo json_encode(array('errors' => "Terjadi error saat upload"));
			return;
		}

		// Mengambil data file yang diunggah
		$file_data = $this->upload->data();
		$file_name = $path . $file_data['file_name'];

		// Memilih reader berdasarkan ekstensi file
		$arr_file = explode('.', $file_name);
		$extension = end($arr_file);

		if ('csv' == $extension) {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} else {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}

		// Membaca data dari file yang diunggah
		$spreadsheet = $reader->load($file_name);
		$sheet_data = $spreadsheet->getActiveSheet()->toArray();
		$list = [];

		// Memproses data menjadi array
		foreach ($sheet_data as $key => $val) {
			if ($key != 0) {
				$list[] = [
					'name' => $val[0],
					'price' => $val[1],
					'year_release' => $val[2],
					'engine_power' => $val[3],
					'fuel' => $val[4],
					'vendor' => $val[5],
					'telp' => $val[6],
				];
			}
		}

		// Menghapus file yang diunggah setelah diproses
		if (file_exists($file_name)) {
			unlink($file_name);
		}

		// Jika ada data yang diproses, simpan ke database
		if (count($list) > 0) {
			$result = $this->Bike->insert_batch("bike", $list);

			// Mengirimkan respon sukses atau error
			if ($result) {
				$this->output->set_status_header(200);
				echo json_encode(array('success' => true, 'code' => 200, 'message' => "Data bike berhasil dihapus"));
				return;
			} else {
				$this->output->set_status_header(400);
				echo json_encode(array('success' => true, 'code' => 400, 'message' => "Terjadi kesalahan saat upload"));
				return;
			}
		} else {
			$this->output->set_status_header(400);
			echo json_encode(array('success' => true, 'code' => 400, 'message' => "Terjadi kesalahan saat upload"));
			return;
		}
	}

	// Fungsi untuk mengunduh template file
	public function download_template($file)
	{
		// Memuat helper download
		$this->load->helper('download');

		// Menentukan path file
		$file_path = FCPATH . 'uploads/documents/' . $file;

		// Mengunduh file jika ada
		if (file_exists($file_path)) {
			return force_download($file_path, NULL);
		}
	}
}

// 1. Autoload dan Namespace:

// Kode require 'vendor/autoload.php'; memuat autoloader dari PhpSpreadsheet 
// untuk mengatur penggunaan kelas PhpSpreadsheet.
// Penggunaan namespace PhpOffice\PhpSpreadsheet memungkinkan penggunaan kelas-kelas 
// dari PhpSpreadsheet tanpa menyebutkan namespace lengkap setiap kali.

// 2. Kelas BikeController:

// BikeController merupakan kontroler dalam CodeIgniter yang mengelola logika 
// bisnis terkait entitas Bike.
// Konstruktor kelas ini memuat model Bike, memuat helper custom, dan memeriksa apakah 
// pengguna sudah login sebelum memproses permintaan apa pun. Jika tidak, pengguna akan 
// diarahkan kembali ke halaman utama.

// 3. Metode index():

// Metode ini digunakan untuk memuat tampilan halaman utama. Data pengguna diambil dari 
// database berdasarkan email yang disimpan dalam sesi.

// 4.  Metode table():

// Metode ini digunakan untuk memuat data tabel bike secara dinamis menggunakan 
// AJAX. Data yang diambil dari model Bike dengan memanggil metode datatable() berdasarkan
//  parameter pencarian, mulai, dan panjang.

// 5,Metode store():

// Metode ini digunakan untuk menangani proses penyimpanan data baru dari form. 
// Validasi form dilakukan menggunakan aturan yang ditetapkan dalam metode _rules(). 
// Jika validasi gagal, pesan kesalahan dikirim kembali sebagai respons.

// 6.Metode edit($id):

// Metode ini digunakan untuk memuat data bike berdasarkan ID untuk tujuan pengeditan. 
// Data dikirim sebagai respons JSON.

// 7.Metode update():

// Metode ini digunakan untuk menangani proses pembaruan data bike berdasarkan ID. 
// Validasi form juga dilakukan menggunakan aturan dari _rules(). Jika ada attachment 
// baru yang diunggah, file lama akan dihapus dan file baru diunggah sesuai konfigurasi.

// 8.Metode delete($id):

// Metode ini digunakan untuk menghapus data bike berdasarkan ID. File attachment 
// yang terkait akan dihapus dari sistem penyimpanan.

// 9.Metode _rules():

// Metode ini adalah metode privat yang digunakan untuk menetapkan aturan validasi untuk form. Aturan validasi ini kemudian diterapkan dalam metode store() dan update() untuk memvalidasi input dari pengguna sebelum data disimpan atau diperbarui.

// Kode ini sangat konsisten dengan pola pengembangan MVC (Model-View-Controller) 
// yang umum digunakan dalam framework seperti CodeIgniter. Ia memisahkan logika bisnis 
// (model), presentasi (view), dan pengelolaan permintaan serta respons (controller).
