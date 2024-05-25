
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BikeController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Bike');
		if (!$this->session->userdata('email')) {
			redirect('auth');
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

		$data = array(
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'year_release' => $this->input->post('year_release'),
			'engine_power' => $this->input->post('engine_power'),
			'fuel' => $this->input->post('fuel'),
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

		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->output->set_status_header(400);
			$errors = $this->form_validation->error_array();

			$errorObj = [];
			foreach ($errors as $key => $value) {
				$errorObj[$key] = [[$value]];
			}

			echo json_encode(array('errors' => $errorObj));
		}

		$data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'year_release' => $this->input->post('year_release'),
			'engine_power' => $this->input->post('engine_power'),
			'fuel' => $this->input->post('fuel'),
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
	}

	public function get_all()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		$this->output->set_status_header(200);
		echo json_encode(array('success' => true, 'code' => 200, 'data' => $this->Bike->get_data_where_not('bike')->result()));
	}
}
