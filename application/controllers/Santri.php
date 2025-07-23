<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Santri extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MSantri');
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

		$keyword = $this->input->get('keyword');
		$kelas = $this->input->get('kelas');
		$status = $this->input->get('status');

		$user_role = $this->session->userdata('role');

		$config['base_url'] = base_url($user_role . '/santri');
		$config['total_rows'] = $this->MSantri->count_filtered_santri($keyword, $kelas, $status);
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

		$data['user_role'] = $this->session->userdata('role');
		$data['santri'] = $this->MSantri->get_filtered_santri($config['per_page'], $page, $keyword, $kelas, $status);
		$data['pagination'] = $this->pagination->create_links();
		$data['title'] = 'Data Santri';

		$this->load->view('layouts/header', $data);
		$this->load->view('santri/index', $data);
		$this->load->view('layouts/footer');
	}

	public function get($nis)
	{
		$data = $this->MSantri->get_santri_by_nis($nis);

		if ($data) {
			echo json_encode($data);
		} else {
			show_404();
		}
	}

	public function tambah()
	{
		$data = [
			'nis' => $this->input->post('nis'),
			'nama' => $this->input->post('nama'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'kelas' => $this->input->post('kelas'),
			'status' => $this->input->post('status'),
			'alamat' => $this->input->post('alamat'),
			'nama_wali' => $this->input->post('nama_wali'),
			'telepon' => $this->input->post('telepon'),
			'email' => $this->input->post('email'),
			'tanggal_masuk' => $this->input->post('tanggal_masuk'),
		];

		if (!empty($_FILES['foto']['name'])) {
			$config['upload_path'] = './uploads/santri/';
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

		$success = $this->MSantri->add_santri($data);

		if ($success) {
			$this->MLogAktivitas->insert_log([
				'user_id' => $this->session->userdata('user_id'),
				'aktivitas' => 'menambahkan santri baru',
				'ikon' => 'plus-circle'

			]);
			echo json_encode(['success' => true, 'message' => 'Santri berhasil ditambahkan.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Gagal menambahkan santri.']);
		}
	}

	public function update($id)
	{
		$data = [
			'nis' => $this->input->post('nis'),
			'nama' => $this->input->post('nama'),
			'tempat_lahir' => $this->input->post('tempat_lahir'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'kelas' => $this->input->post('kelas'),
			'status' => $this->input->post('status'),
			'alamat' => $this->input->post('alamat'),
			'nama_wali' => $this->input->post('nama_wali'),
			'telepon' => $this->input->post('telepon'),
			'email' => $this->input->post('email'),
			'tanggal_masuk' => $this->input->post('tanggal_masuk'),
		];

		if (!empty($_FILES['foto']['name'])) {
			$config['upload_path'] = './uploads/santri/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['file_name'] = time() . '_' . uniqid() . '_' . $_FILES['foto']['name'];
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('foto')) {
				$uploadData = $this->upload->data();
				$data['foto'] = $uploadData['file_name'];

				$lama = $this->db->get_where('santri', ['id_santri' => $id])->row();
				if ($lama && !empty($lama->foto) && file_exists('./uploads/santri/' . $lama->foto)) {
					unlink('./uploads/santri/' . $lama->foto);
				}
			} else {
				echo json_encode(['success' => false, 'message' => $this->upload->display_errors()]);
				return;
			}
		}

		$updated = $this->MSantri->update_santri($id, $data);

		if ($updated) {
			$this->MLogAktivitas->insert_log([
				'user_id' => $this->session->userdata('user_id'),
				'aktivitas' => 'mengupdate data santri',
				'ikon' => 'edit'

			]);
			echo json_encode(['success' => true, 'message' => 'Data santri berhasil diperbarui.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Gagal memperbarui data.']);
		}
	}

	public function delete($id)
	{
		$santri = $this->MSantri->get_santri_by_id($id);

		if (!$santri) {
			echo json_encode(['success' => false, 'message' => 'Data tidak ditemukan.']);
			return;
		}

		if (!empty($santri->foto) && file_exists('./uploads/santri/' . $santri->foto)) {
			unlink('./uploads/santri/' . $santri->foto);
		}

		$hapus = $this->MSantri->delete_santri($id);

		if ($hapus) {
			$this->MLogAktivitas->insert_log([
				'user_id' => $this->session->userdata('user_id'),
				'aktivitas' => 'menghapus data santri' . ' ' . $santri->nama,
				'ikon' => 'trash'

			]);
			echo json_encode(['success' => true, 'message' => 'Data santri berhasil dihapus.']);
		} else {
			echo json_encode(['success' => false, 'message' => 'Gagal menghapus data.']);
		}
	}


}