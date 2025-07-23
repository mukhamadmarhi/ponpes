<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('MAuth');
		$this->load->library('form_validation');
		$this->load->helper('security');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			redirect($this->get_redirect_url());
		}

		$this->load->view('auth/login');
	}

	public function process_login()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('auth');
		}

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user = $this->MAuth->login($username, $password);

		if ($user) {
			$session_data = [
				'user_id' => $user['id_user'],
				'username' => $user['username'],
				'role' => $user['role'],
				'nama' => isset($user['nama']) ? $user['nama'] : 'User',
				'id_related' => $user['id_related'],
				'logged_in' => TRUE
			];

			$this->session->set_userdata($session_data);
			redirect($this->get_redirect_url());
		} else {
			$this->session->set_flashdata('error', 'Username atau password salah');
			redirect('auth');
		}
	}

	public function registrasi()
	{
		$this->load->view('auth/registrasi');
	}

	public function register()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('role', 'Role', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('auth/registrasi');
		}

		$data = [
			'username' => $this->input->post('username'),
			'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
			'role' => strtolower($this->input->post('role')),
			'id_related' => $this->input->post('id_related') ?? null,
			'status' => 'aktif',
			'last_login' => null
		];

		$this->MAuth->register($data);
		$this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login');
		redirect('auth');
	}

	public function logout()
	{
		$this->session->unset_userdata(['user_id', 'username', 'role', 'nama', 'id_related', 'logged_in']);
		$this->session->sess_destroy();
		redirect('auth');
	}

	public function change_password()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('auth');
		}

		$this->load->view('auth/change_password');
	}

	public function process_change_password()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('auth');
		}

		$this->form_validation->set_rules('current_password', 'Password Saat Ini', 'trim|required|xss_clean');
		$this->form_validation->set_rules('new_password', 'Password Baru', 'trim|required|min_length[6]|xss_clean');
		$this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'trim|required|matches[new_password]|xss_clean');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('auth/change_password');
		}

		$user_id = $this->session->userdata('user_id');
		$current_password = $this->input->post('current_password');
		$new_password = $this->input->post('new_password');

		$user = $this->MAuth->get_user_by_id($user_id);

		if (!$user || !password_verify($current_password, $user->password)) {
			$this->session->set_flashdata('error', 'Password saat ini salah');
			redirect('auth/change_password');
		}

		if ($this->MAuth->change_password($user_id, $new_password)) {
			$this->session->set_flashdata('success', 'Password berhasil diubah');
			redirect('dashboard');
		} else {
			$this->session->set_flashdata('error', 'Gagal mengubah password');
			redirect('auth/change_password');
		}
	}

	private function get_redirect_url()
	{
		$role = $this->session->userdata('role');

		switch ($role) {
			case 'admin':
				return 'admin/dashboard';
			case 'pimpinan':
				return 'pimpinan/dashboard';
			case 'guru':
				return 'guru/dashboard';
			case 'santri':
				return 'santri/dashboard';
			default:
				return '/';
		}
	}

	public function forgot_password()
	{
		$this->load->view('auth/forgot_password');
	}

	public function process_forgot_password()
	{
		// Implementasi reset password
	}

	public function akses_ditolak()
	{
		$this->load->view('auth/akses_ditolak');
	}
}