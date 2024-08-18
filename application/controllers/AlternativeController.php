<?php
// Mendefinisikan konstanta 'BASEPATH' yang digunakan untuk memastikan file tidak diakses secara langsung
defined('BASEPATH') or exit('No direct script access allowed');

// Mendefinisikan kelas AlternativeController yang merupakan turunan dari CI_Controller
class AlternativeController extends CI_Controller
{
	// Konstruktor kelas
	public function __construct()
	{
		// Memanggil konstruktor dari CI_Controller
		parent::__construct();

		// Memuat model-model yang dibutuhkan
		$this->load->model('Alternative'); // Memuat model 'Alternative' untuk pengelolaan data alternatif
		$this->load->model('Bike'); // Memuat model 'Bike' untuk pengelolaan data sepeda
		$this->load->model('Subcriteria'); // Memuat model 'Subcriteria' untuk pengelolaan data subkriteria
		$this->load->model('Criteria'); // Memuat model 'Criteria' untuk pengelolaan data kriteria

		// Memuat helper custom untuk keperluan tertentu
		$this->load->helper('custom');

		// Memeriksa apakah sesi pengguna memiliki data 'email', jika tidak, mengarahkan ke halaman utama
		if (!$this->session->userdata('email')) {
			redirect(base_url(''));
		}
	}

	/**
	 * Memuat tampilan utama
	 * @return string
	 */
	public function index()
	{
		// Mendapatkan data subkriteria dari model Subcriteria
		$data['subkriteria'] = $this->Subcriteria->get_data('subkriteria')->result();
		// Mendapatkan data kriteria dari model Criteria
		$data['kriteria'] = $this->Criteria->get_data('kriteria')->result();
		// Mendapatkan data pengguna berdasarkan email dari sesi
		$data['user'] = $this->db->get_where('user', ['email' =>$this->session->userdata('email')])->row_array();

		// Mengembalikan tampilan 'admin/alternative/index' dengan data yang diperoleh
		return view('admin/alternative/index', $data);
	}

	/**
	 * Memuat tabel data
	 * @return void
	 */
	public function table()
	{
		// Memastikan bahwa permintaan adalah permintaan AJAX
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		// Mendapatkan parameter dari permintaan
		$param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
		$start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
		$length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
		$search = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
		
		// Mendapatkan data dari model Alternative berdasarkan parameter pencarian, mulai, dan panjang
		$data = $this->Alternative->datatable($search, $start, $length);
		$total_count = $this->Alternative->datatable($search);

		// Mengembalikan data dalam format JSON
		echo json_encode([
			'draw' => intval($param['draw']),
			'recordsTotal' => count($total_count),
			'recordsFiltered' => count($total_count),
			'data' => $data
		]);
	}

	/**
	 * Membuat data baru
	 * @return void
	 */
	public function store()
	{
		// Memastikan bahwa permintaan adalah permintaan AJAX
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		// Memanggil fungsi validasi
		$this->_rules();
		
		// Memeriksa apakah validasi form gagal
		if ($this->form_validation->run() == FALSE) {
			// Mengatur status header menjadi 400 dan mengembalikan pesan kesalahan dalam format JSON
			$this->output->set_status_header(400);
			$errors = $this->form_validation->error_array();

			$errorObj = [];
			foreach ($errors as $key => $value) {
				$errorObj[$key] = [[$value]];
			}

			echo json_encode(array('errors' => $errorObj));
			return;
		}

		$arrSubcriteria = [];

		// Mendapatkan data kriteria dari model Criteria
		$criteria = $this->Criteria->get_data('kriteria')->result();

		// Mengisi array subkriteria dengan data dari input
		foreach ($criteria as $item) {
			array_push($arrSubcriteria, $this->input->post($item->code));
		}

		// Menyimpan data subkriteria ke dalam database
		foreach ($arrSubcriteria as $item) {
			$query = getSubcriteriaById($item);

			$data = array(
				'criteria_id' => $query->criteria_id,
				'subcriteria_id' => $query->id,
				'bike_id' => $this->input->post('bike_id')
			);
			$this->Alternative->insert_data($data, 'alternatif');
		}

		// Mengatur status header menjadi 200 dan mengembalikan pesan berhasil dalam format JSON
		$this->output->set_status_header(200);
		echo json_encode(array('status' => "OK", 'code' => 200, 'message' => "Data alternatif berhasil ditambahkan"));
	}

	/**
	 * Mendapatkan data berdasarkan id
	 * @param $id
	 * @return void
	 */
	public function edit($id)
	{
		// Memastikan bahwa permintaan adalah permintaan AJAX
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		// Mengatur status header menjadi 200 dan mengembalikan data dalam format JSON
		$this->output->set_status_header(200);
		echo json_encode(array('success' => true, 'code' => 200, 'data' => $this->Alternative->get_data_by_id($id)->row()));
	}

	/**
	 * Memperbarui data
	 * @return void
	 */
	public function update()
	{
		// Memastikan bahwa permintaan adalah permintaan AJAX
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		// Memanggil fungsi validasi
		$this->_rules();
		
		// Memeriksa apakah validasi form gagal
		if ($this->form_validation->run() == FALSE) {
			// Mengatur status header menjadi 400 dan mengembalikan pesan kesalahan dalam format JSON
			$this->output->set_status_header(400);
			$errors = $this->form_validation->error_array();

			$errorObj = [];
			foreach ($errors as $key => $value) {
				$errorObj[$key] = [[$value]];
			}

			echo json_encode(array('errors' => $errorObj));
			return 0;
		}

		$arrSubcriteria = [];

		// Mendapatkan data kriteria dari model Criteria
		$criteria = $this->Criteria->get_data('kriteria')->result();

		// Mengisi array subkriteria dengan data dari input
		foreach ($criteria as $item) {
			array_push($arrSubcriteria, $this->input->post($item->code));
		}

		// Memperbarui data subkriteria di dalam database
		foreach ($arrSubcriteria as $item) {
			$query = getSubcriteriaById($item);

			$data = array(
				'bike_id' => $this->input->post('bike_id'),
				'criteria_id' => $query->criteria_id,
				'subcriteria_id' => $query->id,
			);

			$this->Alternative->update_data($data, 'alternatif');
		}

		// Mengatur status header menjadi 200 dan mengembalikan pesan berhasil dalam format JSON
		$this->output->set_status_header(200);
		echo json_encode(array('status' => "OK", 'code' => 200, 'message' => "Data alternatif berhasil diupdate"));
	}

	/**
	 * Menghapus data
	 * @return void
	 */
	public function delete()
	{
		// Memastikan bahwa permintaan adalah permintaan AJAX
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		// Menyiapkan kondisi untuk menghapus data berdasarkan 'bike_id'
		$where = array('bike_id' => $this->input->post('id'));

		// Menghapus data dari database berdasarkan kondisi yang disiapkan
		$this->Alternative->delete($where, 'alternatif');
		$this->output->set_status_header(200);
		// Mengembalikan pesan berhasil dalam format JSON
		echo json_encode(array('success' => true, 'code' => 200, 'message' => "Data subkriteria berhasil dihapus"));
	}

	// Metode untuk menetapkan aturan validasi form
	public function _rules()
	{
		// Mendapatkan data kriteria dari model Criteria
		$criteria = $this->Criteria->get_data('kriteria')->result();

		// Menetapkan aturan validasi untuk field 'bike_id'
		$this->form_validation->set_rules('bike_id', 'Bike', 'required', array(
			'required' => '%s field tidak boleh kosong.'
		));

		// Menetapkan aturan validasi untuk setiap kriteria
		foreach ($criteria as $item) {
			$this->form_validation->set_rules($item->code, $item->name, 'required', array(
				'required' => '%s field tidak boleh kosong.'
			));
		}
	}
}



// Penjelasan untuk setiap bagian kode:

// 1 Definisi Konstanta BASEPATH: defined('BASEPATH') or exit('No direct script access allowed'); 
// memastikan bahwa file tidak dapat diakses secara langsung melalui URL. Jika konstanta BASEPATH 
// belum didefinisikan, maka skrip akan keluar (exit) dengan pesan error.

// 2 Deklarasi Kelas AlternativeController: class AlternativeController extends CI_Controller { ... } 
// adalah deklarasi kelas utama yang mengelola logika dan presentasi untuk halaman alternatif dalam 
// aplikasi berbasis CodeIgniter.

// 3 Konstruktor Kelas AlternativeController: public function __construct() { ... } 
// merupakan metode konstruktor yang dipanggil setiap kali objek dari kelas AlternativeController dibuat. 
// Metode ini memuat model-model yang diperlukan seperti Alternative, Bike, Subcriteria, dan Criteria. 
// Selain itu, metode ini memuat helper kustom dan memeriksa apakah sesi pengguna memiliki data 'email'. 
// Jika tidak ada, pengguna akan diarahkan kembali ke halaman utama.

// 4 Metode index(): public function index() { ... } memuat tampilan utama untuk halaman alternatif. 
// Ini mengambil data subkriteria, kriteria, dan data pengguna berdasarkan email dari sesi, kemudian 
// memuat tampilan 'admin/alternative/index' dengan data yang diperoleh.

// 5 Metode table(): public function table() { ... } bertanggung jawab untuk mengambil data dari 
// model Alternative untuk ditampilkan dalam tabel. Metode ini memastikan bahwa permintaan datang 
// dari AJAX, kemudian mendapatkan parameter pencarian, mulai, dan panjang dari permintaan. Data 
// kemudian diambil menggunakan metode datatable() dari model Alternative, dan hasilnya dikembalikan 
// dalam format JSON untuk digunakan dalam tabel datatables.

// 6 Metode store(): public function store() { ... } digunakan untuk menyimpan data baru dari form. 
// Metode ini juga memastikan bahwa permintaan datang dari AJAX dan memanggil metode _rules() untuk 
// validasi form. Jika validasi gagal, metode ini mengembalikan pesan kesalahan. Jika validasi berhasil, 
// data subkriteria yang diisi dari form disimpan ke dalam database menggunakan model Alternative.

// 7 Metode edit($id): public function edit($id) { ... } digunakan untuk mengambil data spesifik 
// berdasarkan ID untuk tujuan pengeditan. Metode ini juga memastikan bahwa permintaan datang dari 
// AJAX dan mengembalikan data dalam format JSON.

// 8 Metode update(): public function update() { ... } digunakan untuk memperbarui data yang sudah 
// ada berdasarkan perubahan yang diterima dari form. Metode ini memastikan bahwa permintaan datang 
// dari AJAX dan melakukan validasi form menggunakan _rules(). Jika validasi gagal, metode ini 
// mengembalikan pesan kesalahan. Jika validasi berhasil, data subkriteria yang diperbarui disimpan 
// kembali ke dalam database menggunakan model Alternative.

// 9 Metode delete(): public function delete() { ... } digunakan untuk menghapus data 
// berdasarkan kondisi yang diterima dari permintaan. Metode ini memastikan bahwa permintaan 
// datang dari AJAX dan menghapus data menggunakan model Alternative, kemudian mengembalikan pesan 
// keberhasilan dalam format JSON.

// 10 	Metode _rules(): public function _rules() { ... } adalah metode untuk menetapkan aturan 
// validasi untuk form. Metode ini mendapatkan data kriteria dari model Criteria dan menetapkan 
// aturan validasi untuk setiap field yang diperlukan, termasuk bike_id dan setiap kriteria yang ada.

// Kode ini memanfaatkan struktur MVC (Model-View-Controller) dari CodeIgniter untuk memisahkan 
// logika bisnis dari presentasi, memungkinkan pengelolaan data yang lebih terstruktur dan modular.
?>

