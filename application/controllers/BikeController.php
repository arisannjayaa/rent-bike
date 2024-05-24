
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BikeController extends CI_Controller
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
		$this->load->model('Bike');
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$data['bike'] = $this->Bike->get_data('bike')->result();
		$data['title'] = 'Data Bike';
		$data['user'] = $this->db->get_where('user', ['email' =>

		$this->session->userdata('email')])->row_array();

		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('admin/bike/index', $data);
			$this->load->view('template/footer');
		}
	}

	public function create()
	{
		$data['bike'] = $this->Bike->get_data('bike')->result();
		$data['kriteria'] = $this->Criteria->get_data('kriteria')->result();
		$data['title'] = 'Data Subkriteria';
		$data['user'] = $this->db->get_where('user', ['email' =>

		$this->session->userdata('email')])->row_array();

		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('admin/bike/index', $data);
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
				'name' => $this->input->post('name'),
				'price' => $this->input->post('price'),
				'year_release' => $this->input->post('year_release'),
				'engine_power' => $this->input->post('engine_power'),
				'fuel' => $this->input->post('fuel'),
			);

			$this->Bike->insert_data($data, 'bike');
			$this->session->set_flashdata('message', '<div class="alert 
			alert-success" role="alert">Your data has been added!</div>');
			redirect(base_url('bike'));
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
				'name' => $this->input->post('name'),
				'price' => $this->input->post('price'),
				'year_release' => $this->input->post('year_release'),
				'engine_power' => $this->input->post('engine_power'),
				'fuel' => $this->input->post('fuel'),
			);
			$this->Bike->update_data($data, 'bike');
			$this->session->set_flashdata('message', '<div class="alert 
			alert-primary" role="alert">Your data has been updated!</div>');
			redirect(base_url('bike'));
		}
	}

	public function delete($id)
	{
		$where = array('id' => $id);

		$this->Bike->delete($where, 'bike');
		$this->session->set_flashdata('message', '<div class="alert 
			alert-warning" role="alert">Your data has been deleted!</div>');
		redirect(base_url('bike'));
	}

	public function _rules()
	{
		$this->form_validation->set_rules('name', 'Nama', 'required', array(
			'required' => '%s field is required'
		));
		$this->form_validation->set_rules('price', 'Harga', 'required|numeric', array(
			'required' => '%s field is required',
			'numeric' => 'The %s field must be numeric.',
		));
		$this->form_validation->set_rules('year_release', 'Tahun', 'required', array(
			'required' => 'The %s field is required.',
		));
		$this->form_validation->set_rules('engine_power', 'Kekuatan Mesin', 'required', array(
			'required' => 'The %s field is required.',
		));
		$this->form_validation->set_rules('fuel', 'Bahan Bakar', 'required', array(
			'required' => 'The %s field is required.',
		));
	}
}
