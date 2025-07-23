<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MUser');
		$this->load->model('MGuru');
		$this->load->model('MSantri');
	}

	public function index()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}

		$role = $this->session->userdata('role');
		$uri = $this->uri->segment(1);

		if ($role != $uri) {
			show_error('Akses tidak diizinkan', 403);
		}

		$this->load->library('pagination');

		$search = $this->input->get('search');
		$role = $this->input->get('role');
		$status = $this->input->get('status');

		$config['base_url'] = base_url('admin/user');
		$config['total_rows'] = $this->MUser->count_filtered_users($search, $role, $status);
		$config['per_page'] = 10;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';

		$config['full_tag_open'] = '<ul class="flex justify-center gap-1 mt-4">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li><span class="bg-green-600 text-white px-3 py-1 rounded">';
		$config['cur_tag_close'] = '</span></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['attributes'] = ['class' => 'px-3 py-1 border rounded hover:bg-gray-100'];

		$this->pagination->initialize($config);

		$page = $this->input->get('page') ?? 0;

		$data['user'] = $this->MUser->get_filtered_users($config['per_page'], $page, $search, $role, $status);
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = 'Data Pengguna';

		$this->load->view('layouts/header', $data);
		$this->load->view('user/index', $data);
		$this->load->view('layouts/footer');
	}

	public function get($id)
	{
		$user = $this->MUser->get_user_by_id($id);
		echo json_encode($user);
	}

	public function tambah()
	{
		$data = json_decode(file_get_contents("php://input"), true);
		$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
		$this->MUser->add_user($data);
		echo json_encode(['status' => 'success']);
	}

	public function update($id)
	{
		$data = json_decode(file_get_contents("php://input"), true);
		unset($data['password']);
		$this->MUser->update_user($id, $data);
		echo json_encode(['status' => 'updated']);
	}

	public function delete($id)
	{
		$this->MUser->delete_user($id);
		echo json_encode(['status' => 'deleted']);
	}

	public function get_guru()
	{
		$data = $this->MGuru->get_all_guru();
		$result = array_map(function ($g) {
			return [
				'id' => $g->id_guru,
				'nama' => $g->nama
			];
		}, $data);
		echo json_encode($result);
	}

	public function get_santri()
	{
		$data = $this->MSantri->get_all_santri();
		$result = array_map(function ($s) {
			return [
				'id' => $s->id_santri,
				'nama' => $s->nama . ' (' . $s->kelas . ')'
			];
		}, $data);
		echo json_encode($result);
	}

}