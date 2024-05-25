
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CriteriaController extends CI_Controller
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
		$this->load->model('Criteria');
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$data['kriteria'] = $this->Criteria->get_data('kriteria')->result();
		$data['title'] = 'Data Kriteria';
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		return view('admin/criteria/index', $data);
	}

	public function create()
	{
		$data['kriteria'] = $this->Criteria->get_data('kriteria')->result();
		$data['title'] = 'Data Kriteria';
		$data['user'] = $this->db->get_where('user', ['email' =>

		$this->session->userdata('email')])->row_array();

		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('admin/criteria/index', $data);
			$this->load->view('template/footer');
		}
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
		$data = $this->Criteria->datatable($search, $start, $length);
		$total_count = $this->Criteria->datatable($search);

		echo json_encode([
			'draw' => intval($param['draw']),
			'recordsTotal' => count($total_count),
			'recordsFiltered' => count($total_count),
			'data' => $data
		]);
	}

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

		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
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

	public function edit($id)
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		$this->output->set_status_header(200);
		echo json_encode(array('success' => true, 'code' => 200, 'data' => $this->Criteria->get_data_by_id($id)));

	}

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
