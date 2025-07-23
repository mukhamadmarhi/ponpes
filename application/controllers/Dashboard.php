<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['MSantri', 'MGuru', 'MAbsensi', 'MNilai', 'MLogAktivitas']);
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

		$data['title'] = 'Dashboard';
		$data['total_santri'] = $this->MSantri->count_all();
		$data['total_guru'] = $this->MGuru->count_all();
		$data['absensi_hari_ini'] = $this->MAbsensi->get_today_percentage();
		$data['nilai_belum_input'] = $this->MNilai->count_belum_input();
		$data['log_terbaru'] = $this->MLogAktivitas->get_recent_logs();
		$data['absensi_list_today'] = $this->MAbsensi->get_absensi_hari_ini();

		$this->load->view('layouts/header', $data);
		$this->load->view('dashboard/index', $data);
		$this->load->view('layouts/footer');
	}

	public function statistik()
	{
		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');

		if (!$bulan || !$tahun) {
			echo json_encode(['error' => 'Parameter bulan dan tahun wajib diisi']);
			return;
		}

		$data = $this->MAbsensi->get_statistik_by_bulan_tahun($bulan, $tahun);
		echo json_encode($data);
	}

	public function landing()
	{
		$this->load->view('dashboard/landing');
	}

}