
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubcriteriaController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Subcriteria');
		$this->load->model('Criteria');
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
		$data['kriteria'] = $this->Criteria->get_data('kriteria')->result();
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		return view('admin/subcriteria/index', $data);
	}

	/**
	 * load table
	 * @return void
	 */
	public function table()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		$param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
		$start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
		$length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
		$search = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
		$data = $this->Subcriteria->datatable($search, $start, $length);
		$total_count = $this->Subcriteria->datatable($search);

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
			'criteria_id' => $this->input->post('criteria_id'),
			'name' => $this->input->post('name'),
			'weight' => $this->input->post('weight'),
		);

		$this->output->set_status_header(200);
		$this->Subcriteria->insert_data($data, 'subkriteria');
		echo json_encode(array('status' => "OK", 'code' => 200, 'message' => "Data subkriteria berhasil ditambahkan"));
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
		echo json_encode(array('success' => true, 'code' => 200, 'data' => $this->Subcriteria->get_data_by_id($id)));
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
			'criteria_id' => strtoupper($this->input->post('criteria_id')),
			'name' => $this->input->post('name'),
			'weight' => $this->input->post('weight'),
		);
		$this->output->set_status_header(200);
		$this->Subcriteria->update_data($data, 'subkriteria');
		echo json_encode(array('status' => "OK", 'code' => 200, 'message' => "Data subkriteria berhasil diupdate"));
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

		$this->Subcriteria->delete($where, 'subkriteria');
		$this->output->set_status_header(200);
		echo json_encode(array('success' => true, 'code' => 200, 'message' => "Data subkriteria berhasil dihapus"));
	}

	/**
	 * create rules validation
	 * @return void
	 */
	public function _rules()
	{
		$this->form_validation->set_rules('criteria_id', 'Kriteria', 'required', array(
			'required' => '%s field tidak boleh kosong'
		));
		$this->form_validation->set_rules('name', 'Nama', 'required', array(
			'required' => '%s field tidak boleh kosong',
		));
		$this->form_validation->set_rules('weight', 'Bobot', 'required|numeric', array(
			'required' => 'The %s field tidak boleh kosong.',
			'numeric' => 'The %s field harus berupa angka',
		));
	}
}
