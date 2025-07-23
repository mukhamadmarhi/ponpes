<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MNilai');
		$this->load->model('MSantri');
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

		$search = $this->input->get('search');
		$mapel = $this->input->get('mapel');
		$semester = $this->input->get('semester');
		$tahun = $this->input->get('tahun');
		$page = $this->input->get('page') ?? 0;
		$per_page = 10;

		$total_rows = $this->MNilai->count_filtered_nilai($search, $mapel, $semester, $tahun);

		$config['base_url'] = base_url('nilai');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
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

		$data['nilai'] = $this->MNilai->get_filtered_nilai($search, $mapel, $semester, $tahun, $per_page, $page);
		$data['santri'] = $this->MSantri->get_all_santri();
		$data['guru'] = $this->MGuru->get_all_guru();
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = 'Data Nilai';

		$this->load->view('layouts/header', $data);
		$this->load->view('nilai/index', $data);
		$this->load->view('layouts/footer');
	}

	public function tambah()
	{
		$data = json_decode(file_get_contents('php://input'), true);

		$data['nilai_akhir'] = ($data['nilai_harian'] * 0.3) + ($data['nilai_uts'] * 0.3) + ($data['nilai_uas'] * 0.4);

		$this->MNilai->add_nilai($data);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(['success' => true, 'message' => 'Data nilai berhasil ditambahkan.']));
	}

	public function edit($id)
	{
		$data = json_decode(file_get_contents('php://input'), true);
		$data['nilai_akhir'] = ($data['nilai_harian'] * 0.3) + ($data['nilai_uts'] * 0.3) + ($data['nilai_uas'] * 0.4);

		$this->MNilai->update_nilai($id, $data);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(['success' => true, 'message' => 'Data nilai berhasil diperbarui.']));
	}

	public function get($id)
	{
		$nilai = $this->MNilai->get_nilai_by_id($id);

		if ($nilai) {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(['success' => true, 'data' => $nilai]));
		} else {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(['success' => false, 'message' => 'Data tidak ditemukan.']));
		}
	}

	public function hapus($id)
	{
		$this->MNilai->delete_nilai($id);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(['success' => true, 'message' => 'Data nilai berhasil dihapus.']));
	}
}
