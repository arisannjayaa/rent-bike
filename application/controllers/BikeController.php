
<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BikeController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Bike');
		$this->load->helper('custom');
		if (!$this->session->userdata('email')) {
			redirect(base_url(''));
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
		])->row_array();

		return view('admin/bike/index', $data);
	}

	public function table()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		$param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
		$start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
		$length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
		$search = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
		$data = $this->Bike->datatable($search, $start, $length);
		$total_count = $this->Bike->datatable($search);

		echo json_encode([
			'draw' => intval($param['draw']),
			'recordsTotal' => count($total_count),
			'recordsFiltered' => count($total_count),
			'data' => $data
		]);
	}

	/**
	 * create data
	 * @return void
	 */
	public function store()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		$this->_rules();

		if (empty($_FILES['attachment']['name'])) {
			$this->form_validation->set_rules('attachment', 'Attachment', 'required', array(
				'required' => 'The %s field tidak boleh kosong.',
			));
		}

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

		$path 		= 'uploads/attachments/';

		if (!is_dir($path)) {
			mkdir($path, 0777, TRUE);
		}

		$config['upload_path'] 		= './'.$path;
		$config['allowed_types'] 	= 'jpg|png';
		$config['max_filename']	 	= '255';
		$config['encrypt_name'] 	= TRUE;
		$config['max_size'] 		= 1024;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload("attachment")) {
			$this->output->set_status_header(400);

			echo json_encode(array('errors' => "Terjadi error saat upload"));
			return;
		}

		$file_data 	= $this->upload->data();
		$file_name 	= $path.$file_data['file_name'];
		$arr_file 	= explode('.', $file_name);
		$extension 	= end($arr_file);

		$data = array(
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'year_release' => $this->input->post('year_release'),
			'engine_power' => $this->input->post('engine_power'),
			'fuel' => $this->input->post('fuel'),
			'telp' => $this->input->post('telp'),
			'vendor' => $this->input->post('vendor'),
			'attachment' => $file_name
		);

		$this->output->set_status_header(200);
		$this->Bike->insert_data($data, 'bike');
		echo json_encode(array('status' => "OK", 'code' => 200, 'message' => "Data bike berhasil ditambahkan"));
	}

	/**
	 * get data by id
	 * @param $id
	 * @return void
	 */
	public function edit($id)
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		$this->output->set_status_header(200);
		echo json_encode(array('success' => true, 'code' => 200, 'data' => $this->Bike->get_data_by_id($id)));
	}

	/**
	 * update data
	 * @return void
	 */
	public function update()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		$old_attachment = $this->input->post('old_attachment');
		$this->_rules();

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

		if ($_FILES['attachment']['name']) {
			$path = 'uploads/attachments/';

			if (!is_dir($path)) {
				mkdir($path, 0777, TRUE);
			}

			$config['upload_path'] 		= './'.$path;
			$config['allowed_types'] 	= 'jpg|png';
			$config['max_filename']	 	= '255';
			$config['encrypt_name'] 	= TRUE;
			$config['max_size'] 		= 1024;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload("attachment")) {
				$this->output->set_status_header(400);

				echo json_encode(array('errors' => "Terjadi error saat upload"));
				return;
			}

			$file_data 	= $this->upload->data();
			$file_name 	= $path.$file_data['file_name'];
			$arr_file 	= explode('.', $file_name);
			$extension 	= end($arr_file);

			if(file_exists('./' . $old_attachment)) {
				unlink('./'.$old_attachment);
			}
		} else {
			$file_name = $old_attachment;
		}

		$data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'year_release' => $this->input->post('year_release'),
			'engine_power' => $this->input->post('engine_power'),
			'fuel' => $this->input->post('fuel'),
			'telp' => $this->input->post('telp'),
			'vendor' => $this->input->post('vendor'),
			'attachment' => $file_name
		);

		$this->output->set_status_header(200);
		$this->Bike->update_data($data, 'bike');
		echo json_encode(array('status' => "OK", 'code' => 200, 'message' => "Data bike berhasil diupdate"));
	}

	/**
	 * delete data
	 * @return void
	 */
	public function delete()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		$where = array('id' => $this->input->post('id'));

		$this->Bike->delete($where, 'bike');
		$this->output->set_status_header(200);
		echo json_encode(array('success' => true, 'code' => 200, 'message' => "Data bike berhasil dihapus"));
	}

	/**
	 * create rules validation
	 * @return void
	 */
	public function _rules()
	{
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
		$this->form_validation->set_rules('telp', 'telp', 'required', array(
			'required' => 'The %s field tidak boleh kosong.',
		));
	}

	public function get_all()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		$this->output->set_status_header(200);
		echo json_encode(array('success' => true, 'code' => 200, 'data' => $this->Bike->get_data_where_not('bike')->result()));
	}

	public function import()
	{
		$path 		= 'uploads/documents/';

		if (!is_dir($path)) {
			mkdir($path, 0777, TRUE);
		}

		$config['upload_path'] 		= './'.$path;
		$config['allowed_types'] 	= 'csv|CSV|xlsx|XLSX|xls|XLS';
		$config['max_filename']	 	= '255';
		$config['encrypt_name'] 	= TRUE;
		$config['max_size'] 		= 4096;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('import')) {
			$this->output->set_status_header(400);

			echo json_encode(array('errors' => "Terjadi error saat upload"));
			return;
		}

		$file_data 	= $this->upload->data();
		$file_name 	= $path.$file_data['file_name'];
		$arr_file 	= explode('.', $file_name);
		$extension 	= end($arr_file);

		if('csv' == $extension) {
			$reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} else {
			$reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}

		$spreadsheet 	= $reader->load($file_name);
		$sheet_data 	= $spreadsheet->getActiveSheet()->toArray();
		$list 			= [];

		foreach($sheet_data as $key => $val) {
			if($key != 0) {
				$list [] = [
					'name'	=> $val[0],
					'price'	=> $val[1],
					'year_release'	=> $val[2],
					'engine_power'	=> $val[3],
					'fuel'	=> $val[4],
					'vendor'	=> $val[5],
					'telp'	=> $val[6],
				];
			}
		}

		if(file_exists($file_name)) {
			unlink($file_name);
		}

		if(count($list) > 0) {
			$result = $this->Bike->insert_batch("bike", $list);

			if($result) {
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

	public function download_template($file)
	{
		$this->load->helper('download');
		$file_path = FCPATH . 'uploads/documents/' . $file;

		if (file_exists($file_path)) {
			return force_download($file_path, NULL);
		}
	}
}
