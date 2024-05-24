
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
		$data['user'] = $this->db->get_where('user', ['email' =>

		$this->session->userdata('email')])->row_array();

		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('admin/criteria/index', $data);
			$this->load->view('template/footer');
		}
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

	public function store()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', '<div class="alert 
			alert-danger" role="alert">Form input error</div>');
			$this->create();
		} else {
			$data = array(
				'code' => strtoupper($this->input->post('code')),
				'name' => $this->input->post('name'),
				'attribute' => $this->input->post('attribute'),
				'weight' => $this->input->post('weight'),
			);

			$this->Criteria->insert_data($data, 'kriteria');
			$this->session->set_flashdata('message', '<div class="alert 
			alert-success" role="alert">Your data has been added!</div>');
			redirect(base_url('kriteria'));
		}
	}

	public function update($id)
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', '<div class="alert 
			alert-danger" role="alert">Form input error</div>');
			$this->index();
		} else {
			$data = array(
				'id' => $id,
				'code' => strtoupper($this->input->post('code')),
				'name' => $this->input->post('name'),
				'attribute' => $this->input->post('attribute'),
				'weight' => $this->input->post('weight'),
			);
			$this->Criteria->update_data($data, 'kriteria');
			$this->session->set_flashdata('message', '<div class="alert 
			alert-primary" role="alert">Your data has been updated!</div>');
			redirect(base_url('kriteria'));
		}
	}

	public function delete($id)
	{
		$where = array('id' => $id);

		$this->Criteria->delete($where, 'kriteria');
		$this->session->set_flashdata('message', '<div class="alert 
			alert-warning" role="alert">Your data has been deleted!</div>');
		redirect(base_url('kriteria'));
	}

	public function _rules()
	{

		$this->form_validation->set_rules('code', 'Kode', 'required|regex_match[/^c/i]', array(
			'required' => '%s field is required',
			'regex_match' => 'The %s field must start with the letter "c".',
		));
		$this->form_validation->set_rules('attribute', 'Atribut', 'required', array(
			'required' => '%s field is required'
		));
		$this->form_validation->set_rules('name', 'Nama', 'required', array(
			'required' => '%s field is required',
		));
		$this->form_validation->set_rules('weight', 'Bobot', 'required|numeric', array(
			'required' => 'The %s field is required.',
			'numeric' => 'The %s field must be numeric.',
		));
	}
}
