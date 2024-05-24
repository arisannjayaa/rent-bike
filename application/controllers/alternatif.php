
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif extends CI_Controller
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
		$this->load->model('alternatif_model');
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$data['alternatif'] = $this->alternatif_model->get_data('alternatif')->result();
		$data['title'] = 'Data Alternatif';
		$data['user'] = $this->db->get_where('user', ['email' =>

		$this->session->userdata('email')])->row_array();




		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('admin/alternatif', $data);
			$this->load->view('template/footer');
		}
	}
	public function tambah()
	{
		$data['alternatif'] = $this->alternatif_model->get_data('alternatif')->result();
		$data['title'] = 'Data Alternatif';
		$data['user'] = $this->db->get_where('user', ['email' =>

		$this->session->userdata('email')])->row_array();




		if ($this->form_validation->run() == false) {
			$this->load->view('template/header', $data);
			$this->load->view('template/navbar', $data);
			$this->load->view('admin/alternatif', $data);
			$this->load->view('template/footer');
		}
	}
	public function tambah_aksi()
	{

		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->tambah();
		} else {
			$data = array(
				'merk' => $this->input->post('merk'),
				'tipe' => $this->input->post('tipe'),
				'warna' => $this->input->post('warna'),
				'nopol' => $this->input->post('nopol'),
				'rental' => $this->input->post('rental'),
				'telp' => $this->input->post('telp')
			);

			$this->alternatif_model->insert_data($data, 'alternatif');
			$this->session->set_flashdata('message', '<div class="alert 
			alert-success" role="alert">Your data has been added!</div>');
			redirect('alternatif');
		}
	}
	public function edit($id)
	{
		//$data['title'] = 'Edit Alternatif';
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$data = array(
				'id' => $id,
				'merk' => $this->input->post('merk'),
				'tipe' => $this->input->post('tipe'),
				'warna' => $this->input->post('warna'),
				'nopol' => $this->input->post('nopol'),
				'rental' => $this->input->post('rental'),
				'telp' => $this->input->post('telp')
			);
			$this->alternatif_model->update_data($data, 'alternatif');
			$this->session->set_flashdata('message', '<div class="alert 
			alert-primary" role="alert">Your data has been updated!</div>');
			redirect('alternatif');
		}
	}
	public function delete($id)
	{
		$where = array('id' => $id);

		$this->alternatif_model->delete($where, 'alternatif');
			$this->session->set_flashdata('message', '<div class="alert 
			alert-warning" role="alert">Your data has been deleted!</div>');
			redirect('alternatif');
	}

	public function _rules()
	{

		$this->form_validation->set_rules('merk', 'Merk', 'required', array(
			'required' => '%s field is required'
		));
		$this->form_validation->set_rules('tipe', 'Tipe', 'required', array(
			'required' => '%s field is required'
		));
		$this->form_validation->set_rules('warna', 'Warna', 'required', array(
			'required' => '%s field is required'
		));
		$this->form_validation->set_rules('nopol', 'Nopol', 'required', array(
			'required' => '%s field is required'
		));
		$this->form_validation->set_rules('rental', 'Rental', 'required', array(
			'required' => '%s field is required'
		));
		$this->form_validation->set_rules('telp', 'Telp', 'required', array(
			'required' => '%s field is required'
		));
	}
}
