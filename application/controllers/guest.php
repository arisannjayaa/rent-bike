<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guest extends CI_Controller
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
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();
		$data['title'] = 'Dashboard';

		$this->load->view('template/header_guest', $data);
		$this->load->view('template/navbar_guest', $data);
		$this->load->view('guest/dashboard_guest', $data);
		$this->load->view('template/footer_guest');
	}
	public function change_password_guest()
	{
		$data['title'] = 'Change Password';
		$data['user'] = $this->db->get_where('user', ['email' =>
		$this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('current_password', 'Current Password', 'required');
		$this->form_validation->set_rules('new_password1', 'New Password', 'required|min_length[3]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|min_length[3]|matches[new_password1]');

		if ($this->form_validation->run() == false) {

			$this->load->view('template/header_guest', $data);
			$this->load->view('template/navbar_guest', $data);
			$this->load->view('guest/change_password_guest', $data);
			$this->load->view('template/footer_guest');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');

			if (!password_verify($current_password, $data['user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert 
			alert-danger" role="alert">Wrong current password!</div>');
				redirect('guest/change_password_guest');
			} else {
				if ($current_password == $new_password) {
					$this->session->set_flashdata('message', '<div class="alert 
			alert-danger" role="alert">New password cannot be the same as current password!</div>');
					redirect('guest/change_password_guest');
				} else {
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');
					$this->session->set_flashdata('message', '<div class="alert 
			alert-success" role="alert">Password changed!</div>');
					redirect('guest/change_password_guest');
				}
			}
		}
	}
}
