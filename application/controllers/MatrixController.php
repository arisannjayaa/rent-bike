
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
		$data['matrix_alternative'] = $this->Alternative->matrix_alternative()->result();
		$data['matrix_normalization'] = $this->Alternative->matrix_normalization()->result();
		$data['matrix_preferences'] = $this->Alternative->matrix_preferences()->result();
//		print_r($data['matrix_preferences']); die();
		return view('admin/matrix/index', $data);
	}

	public function preference()
	{
		$data['kriteria'] = $this->Criteria->get_data('kriteria')->result();
		$data['user'] = $this->db->get_where('user', [
			'email' => $this->session->userdata('email')
		])->row_array();

		$data['matrix_result'] = $this->Alternative->matrix_result()->result();

		return view('admin/preference/index', $data);
	}
}
