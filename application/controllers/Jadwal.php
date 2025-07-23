<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MJadwal');
		$this->load->model('MGuru');
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

		$mapel = $this->input->get('mapel');
		$hari = $this->input->get('hari');
		$kelas = $this->input->get('kelas');
		$page = $this->input->get('page') ?? 0;
		$limit = 10;

		$total = $this->MJadwal->count_filtered($mapel, $hari, $kelas);

		$config['base_url'] = base_url('admin/jadwal');
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
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

		$data['pagination'] = $this->pagination->create_links();
		$data['jadwal'] = $this->MJadwal->get_filtered_jadwal($mapel, $hari, $kelas, $limit, $page);
		$data['guru'] = $this->MGuru->get_all_guru();
		$data['title'] = 'Data Jadwal';

		$this->load->view('layouts/header', $data);
		$this->load->view('jadwal/index', $data);
		$this->load->view('layouts/footer');
	}

	public function get($id)
	{
		$data = $this->MJadwal->get_jadwal_by_id($id);
		echo json_encode(['success' => true, 'data' => $data]);
	}

	public function tambah()
	{
		$data = json_decode(file_get_contents('php://input'), true);
		$success = $this->MJadwal->add_jadwal($data);
		echo json_encode(['success' => $success]);
	}

	public function update($id)
	{
		$data = json_decode(file_get_contents('php://input'), true);
		$success = $this->MJadwal->update_jadwal($id, $data);
		echo json_encode(['success' => $success]);
	}

	public function delete($id)
	{
		$del = $this->MJadwal->delete_jadwal($id);
		echo json_encode(['success' => $del]);
	}
}