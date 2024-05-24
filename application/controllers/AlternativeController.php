
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AlternativeController extends CI_Controller
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
		$this->load->model('Alternative');
		$this->load->model('Bike');
		$this->load->model('Subcriteria');
		$this->load->model('Criteria');
		$this->load->helper('custom');
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$data['alternatif'] = $this->Alternative->get_data('alternatif')->result();
		$data['subkriteria'] = $this->Subcriteria->get_data('subkriteria')->result();
		$data['bike'] = $this->Bike->get_data('bike')->result();
		$data['kriteria'] = $this->Criteria->get_data('kriteria')->result();
		$data['title'] = 'Data Alternatif';
		$data['user'] = $this->db->get_where('user', ['email' =>

		$this->session->userdata('email')])->row_array();




		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('admin/alternative/index', $data);
			$this->load->view('template/footer');
		}
	}
	public function create()
	{
		$data['alternatif'] = $this->Alternative->get_data('alternatif')->result();
		$data['subkriteria'] = $this->Subcriteria->get_data('subkriteria')->result();
		$data['bike'] = $this->Bike->get_data('bike')->result();
		$data['kriteria'] = $this->Criteria->get_data('kriteria')->result();
		$data['title'] = 'Data Alternatif';
		$data['user'] = $this->db->get_where('user', ['email' =>

		$this->session->userdata('email')])->row_array();

		if ($this->form_validation->run() == false) {
//			print_r($this->input->post()); die();
			$this->load->view('template/header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('admin/alternative/index', $data);
			$this->load->view('template/footer');
		}
	}
	public function store()
	{

		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
//			print_r($this->input->post()); die();
			$subcriterian = [$this->input->post('C1'),$this->input->post('C2'),$this->input->post('C3'),$this->input->post('C4')];

			foreach ($subcriterian as $item) {
				$query = getSubcriteriaById($item);

				$data = array(
					'criteria_id' => $query->criteria_id,
					'subcriteria_id' => $query->id,
					'bike_id' => $this->input->post('bike_id')
				);
				$this->Alternative->insert_data($data, 'alternatif');
			}

			$this->session->set_flashdata('message', '<div class="alert 
			alert-success" role="alert">Your data has been added!</div>');
			redirect('alternatif');
		}
	}
	public function update($id)
	{
		//$data['title'] = 'Edit Alternatif';
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$data = array(
				'id' => $id,
				'criteria_id' => $this->input->post('criteria_id'),
				'subcriteria_id' => $this->input->post('subcriteria_id'),
				'bike_id' => $this->input->post('bike_id')
			);
			$this->Alternative->update_data($data, 'alternatif');
			$this->session->set_flashdata('message', '<div class="alert 
			alert-primary" role="alert">Your data has been updated!</div>');
			redirect('alternatif');
		}
	}
	public function delete($id)
	{
		$where = array('id' => $id);

		$this->Alternative->delete($where, 'alternatif');
			$this->session->set_flashdata('message', '<div class="alert 
			alert-warning" role="alert">Your data has been deleted!</div>');
			redirect('alternatif');
	}

	public function _rules()
	{
		$this->form_validation->set_rules('bike_id', 'Bike', 'required', array(
			'required' => '%s field is required'
		));
	}
}
