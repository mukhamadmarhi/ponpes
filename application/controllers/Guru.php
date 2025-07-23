<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
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
		$this->load->model('MGuru');

		$keyword = $this->input->get('keyword');
		$bidang = $this->input->get('bidang');
		$status = $this->input->get('status');

		$config['base_url'] = base_url('guru');
		$config['total_rows'] = $this->MGuru->count_filtered_guru($keyword, $bidang, $status);
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

		$data['guru'] = $this->MGuru->get_filtered_guru($config['per_page'], $page, $keyword, $bidang, $status);
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = 'Data Guru';

		$this->load->view('layouts/header', $data);
		$this->load->view('guru/index', $data);
		$this->load->view('layouts/footer');
	}

	public function get($nip)
	{
		$data = $this->MGuru->get_guru_by_nip($nip);
		echo json_encode($data);
	}

	public function tambah()
	{
		$data = [
			'nip' => $this->input->post('nip'),
			'nama' => $this->input->post('nama'),
			'bidang_pengajaran' => $this->input->post('bidang'),
			'status' => $this->input->post('status'),
			'alamat' => $this->input->post('alamat'),
			'telepon' => $this->input->post('telepon'),
			'email' => $this->input->post('email')
		];

		if (!empty($_FILES['foto']['name'])) {
			$config['upload_path'] = './uploads/guru/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['file_name'] = time() . '_' . $_FILES['foto']['name'];

			$this->load->library('upload');
			$this->upload->initialize($config);

			if ($this->upload->do_upload('foto')) {
				$uploadData = $this->upload->data();
				$data['foto'] = $uploadData['file_name'];
			} else {
				echo json_encode(['success' => false, 'message' => $this->upload->display_errors('', '')]);
				return;
			}
		}

		$insert = $this->MGuru->add_guru($data);
		echo json_encode(['success' => $insert ? true : false]);
	}

	public function update($nip)
	{
		$data = [
			'nama' => $this->input->post('nama'),
			'bidang_pengajaran' => $this->input->post('bidang'),
			'status' => $this->input->post('status'),
			'alamat' => $this->input->post('alamat'),
			'telepon' => $this->input->post('telepon'),
			'email' => $this->input->post('email')
		];

		if (!empty($_FILES['foto']['name'])) {
			$config['upload_path'] = './uploads/guru/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['file_name'] = time() . '_' . uniqid() . '_' . $_FILES['foto']['name'];

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto')) {
				$uploadData = $this->upload->data();
				$data['foto'] = $uploadData['file_name'];

				$lama = $this->MGuru->get_guru_by_nip($nip);
				if ($lama && !empty($lama->foto) && file_exists('./uploads/guru/' . $lama->foto)) {
					unlink('./uploads/guru/' . $lama->foto);
				}
			} else {
				echo json_encode(['success' => false, 'message' => $this->upload->display_errors()]);
				return;
			}
		}

		$update = $this->MGuru->update_by_nip($nip, $data);
		echo json_encode(['success' => $update ? true : false]);
	}

	public function delete($nip)
	{
		$guru = $this->MGuru->get_guru_by_nip($nip);

		if (!$guru) {
			echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan.']);
			return;
		}

		if (!empty($guru->foto) && file_exists('./uploads/guru/' . $guru->foto)) {
			unlink('./uploads/guru/' . $guru->foto);
		}

		$hapus = $this->MGuru->delete_by_nip($nip);

		if ($hapus) {
			echo json_encode(['success' => true, 'message' => 'Guru berhasil dihapus.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Gagal menghapus data.']);
		}
	}

}