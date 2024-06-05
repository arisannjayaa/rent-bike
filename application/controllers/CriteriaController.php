
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CriteriaController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Criteria');
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

		return view('admin/criteria/index', $data);
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
		$data = $this->Criteria->datatable($search, $start, $length);
		$total_count = $this->Criteria->datatable($search);

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
			'code' => strtoupper($this->input->post('code')),
			'name' => $this->input->post('name'),
			'attribute' => $this->input->post('attribute'),
			'weight' => $this->input->post('weight'),
		);

		$this->output->set_status_header(200);
		$this->Criteria->insert_data($data, 'kriteria');
		echo json_encode(array('status' => "OK", 'code' => 200, 'message' => "Data kriteria berhasil ditambahkan"));
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
		echo json_encode(array('success' => true, 'code' => 200, 'data' => $this->Criteria->get_data_by_id($id)));
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
			'code' => strtoupper($this->input->post('code')),
			'name' => $this->input->post('name'),
			'attribute' => $this->input->post('attribute'),
			'weight' => $this->input->post('weight'),
		);
		$this->output->set_status_header(200);
		$this->Criteria->update_data($data, 'kriteria');
		echo json_encode(array('status' => "OK", 'code' => 200, 'message' => "Data kriteria berhasil diupdate"));
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

		$this->Criteria->delete($where, 'kriteria');
		$this->output->set_status_header(200);
		echo json_encode(array('success' => true, 'code' => 200, 'message' => "Data kriteria berhasil dihapus"));
	}

	/**
	 * create rules validation
	 * @return void
	 */
	public function _rules()
	{
		$this->form_validation->set_rules('code', 'Kode', 'required|regex_match[/^c/i]', array(
			'required' => '%s field tidak boleh kosong',
			'regex_match' => 'The %s field harus diawali huruf c',
		));
		$this->form_validation->set_rules('attribute', 'Atribut', 'required', array(
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
