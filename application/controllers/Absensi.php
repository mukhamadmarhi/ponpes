<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MAbsensi');
		$this->load->model('MSantri');
		$this->load->model('MGuru');
		$this->load->model('MLogAktivitas');
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
		$tanggal = $this->input->get('tanggal');
		$status = $this->input->get('status');

		$config['base_url'] = base_url('admin/absensi');
		$config['total_rows'] = $this->MAbsensi->count_filtered_absensi($search, $tanggal, $status);
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

		$data['absensi'] = $this->MAbsensi->get_filtered_absensi($config['per_page'], $page, $search, $tanggal, $status);
		$data['pagination'] = $this->pagination->create_links();
		$data['santri'] = $this->MSantri->get_all_santri();
		$data['guru'] = $this->MGuru->get_all_guru();
		$data['title'] = 'Data Absensi';

		$this->load->view('layouts/header', $data);
		$this->load->view('absensi/index', $data);
		$this->load->view('layouts/footer');
	}

	public function get($id)
	{

		$absensi = $this->MAbsensi->get_absensi_by_id($id);

		if ($absensi) {
			echo json_encode(['success' => true, 'data' => $absensi]);
		} else {
			echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan.']);
		}
	}

	public function tambah()
	{
		$data = json_decode($this->input->raw_input_stream, true);

		$insert = [
			'id_santri' => $data['santri_id'],
			'tanggal' => $data['tanggal'],
			'status' => $data['status'],
			'keterangan' => $data['keterangan'],
			'id_guru' => $data['guru_id'],
		];

		$santri = $this->MSantri->get_santri_by_id($insert['id_santri']);
		$success = $this->MAbsensi->add_absensi($insert);

		if ($success) {
			$this->MLogAktivitas->insert_log([
				'user_id' => $this->session->userdata('user_id'),
				'aktivitas' => 'menginput absensi santri ' . ' ' . $santri->nama,
				'ikon' => 'user-check'

			]);
			echo json_encode(['success' => true, 'message' => 'Absensi berhasil ditambahkan.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Gagal menambahkan absensi.']);
		}
	}

	public function edit($id)
	{
		$data = json_decode($this->input->raw_input_stream, true);

		$update = [
			'id_santri' => $data['santri_id'],
			'tanggal' => $data['tanggal'],
			'status' => $data['status'],
			'keterangan' => $data['keterangan'],
			'id_guru' => $data['guru_id'],
		];


		$santri = $this->MSantri->get_santri_by_id($update['id_santri']);
		$success = $this->MAbsensi->update_absensi($id, $update);

		if ($success) {
			$this->MLogAktivitas->insert_log([
				'user_id' => $this->session->userdata('user_id'),
				'aktivitas' => 'mengupdate data absensi santri ' . ' ' . $santri->nama,
				'ikon' => 'user-check'

			]);
			echo json_encode(['success' => true, 'message' => 'Absensi berhasil diperbarui.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Gagal memperbarui absensi.']);
		}
	}

	public function hapus($id)
	{
		$absensi = $this->MAbsensi->get_absensi_by_id($id);
		if (!$absensi) {
			return $this->output
				->set_content_type('application/json')
				->set_output(json_encode(['success' => false, 'message' => 'Data tidak ditemukan.']));
		}

		$santri = $this->MSantri->get_santri_by_id($absensi->id_santri);
		$deleted = $this->MAbsensi->delete_absensi($id);

		if ($deleted) {
			$this->MLogAktivitas->insert_log([
				'user_id' => $this->session->userdata('user_id'),
				'aktivitas' => 'menghapus data absensi santri ' . $santri->nama,
				'ikon' => 'trash'
			]);
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(['success' => true, 'message' => 'Data absensi berhasil dihapus.']));
		} else {
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(['success' => false, 'message' => 'Gagal menghapus data.']));
		}
	}

}