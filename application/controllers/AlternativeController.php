
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AlternativeController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Alternative');
		$this->load->model('Bike');
		$this->load->model('Subcriteria');
		$this->load->model('Criteria');
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
		$data['subkriteria'] = $this->Subcriteria->get_data('subkriteria')->result();
		$data['kriteria'] = $this->Criteria->get_data('kriteria')->result();
		$data['user'] = $this->db->get_where('user', ['email' =>$this->session->userdata('email')])->row_array();

		return view('admin/alternative/index', $data);
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
		$data = $this->Alternative->datatable($search, $start, $length);
		$total_count = $this->Alternative->datatable($search);

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

		$arrSubcriteria = [];
		$criteria = $this->Criteria->get_data('kriteria')->result();

		foreach ($criteria as $item) {
			array_push($arrSubcriteria, $this->input->post($item->code));
		}

		foreach ($arrSubcriteria as $item) {
			$query = getSubcriteriaById($item);

			$data = array(
				'criteria_id' => $query->criteria_id,
				'subcriteria_id' => $query->id,
				'bike_id' => $this->input->post('bike_id')
			);
			$this->Alternative->insert_data($data, 'alternatif');
		}

		$this->output->set_status_header(200);
		echo json_encode(array('status' => "OK", 'code' => 200, 'message' => "Data alternatif berhasil ditambahkan"));
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
		echo json_encode(array('success' => true, 'code' => 200, 'data' => $this->Alternative->get_data_by_id($id)->row()));
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
			return 0;
		}

		$arrSubcriteria = [];
		$criteria = $this->Criteria->get_data('kriteria')->result();

		foreach ($criteria as $item) {
			array_push($arrSubcriteria, $this->input->post($item->code));
		}

		foreach ($arrSubcriteria as $item) {
			$query = getSubcriteriaById($item);

			$data = array(
				'bike_id' => $this->input->post('bike_id'),
				'criteria_id' => $query->criteria_id,
				'subcriteria_id' => $query->id,
			);

			$this->Alternative->update_data($data, 'alternatif');
		}

		$this->output->set_status_header(200);
		echo json_encode(array('status' => "OK", 'code' => 200, 'message' => "Data alternatif berhasil diupdate"));
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

		$where = array('bike_id' => $this->input->post('id'));

		$this->Alternative->delete($where, 'alternatif');
		$this->output->set_status_header(200);
		echo json_encode(array('success' => true, 'code' => 200, 'message' => "Data subkriteria berhasil dihapus"));
	}

	public function _rules()
	{
		$criteria = $this->Criteria->get_data('kriteria')->result();
		$this->form_validation->set_rules('bike_id', 'Bike', 'required', array(
			'required' => '%s field tidak boleh kosong.'
		));

		foreach ($criteria as $item) {
			$this->form_validation->set_rules($item->code, $item->name, 'required', array(
				'required' => '%s field tidak boleh kosong.'
			));
		}
	}
}
