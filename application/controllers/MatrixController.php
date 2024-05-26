
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MatrixController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Subcriteria');
		$this->load->model('Criteria');
		$this->load->model('Alternative');
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
}
