<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
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
		$this->load->library('form_validation');
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			redirect('profile');
		}
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login';
			$this->load->view('template_auth/header_auth', $data);
			$this->load->view('template_auth/header_auth');
			$this->load->view('auth/login');
			$this->load->view('template_auth/footer_auth');
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user =  $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {
			if (password_verify($password, $user['password'])) {
				$data = [
					'email' => $user['email'],
					'role_id' => $user['role_id']
				];
				$this->session->set_userdata($data);
				if ($user['role_id'] == 1) {
					redirect('admin');
				} else {
					redirect('guest');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert 
			alert-danger" role="alert">Wrong password!</div>');

				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert 
			alert-danger" role="alert">Email is not registered!</div>');

			redirect('auth');
		}
	}
	public function register()
	{
		if ($this->session->userdata('email')) {
			redirect('profile');
		}
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password1', 'Password', 'required|min_length[3]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Password', 'required|matches[password1]');

		if ($this->form_validation->run() == false) {

			$data['title'] = 'Registration';
			$this->load->view('template_auth/header_auth', $data);
			$this->load->view('auth/register');
			$this->load->view('template_auth/footer_auth');
		} else {
			$data = [
				'name' 		=> $this->input->post('name'),
				'email' 	=> $this->input->post('email'),
				'image' 	=> 'default.jpg',
				'password'	=> password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' 	=> 2
			];
			$this->db->insert('user', $data);
			$this->session->set_flashdata('message', '<div class="alert 
			alert-success" role="alert">Congratulation! your account has been 
			created. Please Login</div>');

			redirect('auth');
		}
	}
	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message', '<div class="alert 
			alert-success" role="alert">You have been logged out!</div>');

		redirect('auth');
	}
}
