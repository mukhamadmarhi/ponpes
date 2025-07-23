<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MLaporan extends CI_Model
{
	public function get_data_santri($kelas = null)
	{
		$this->db->select('*');
		$this->db->from('santri');

		if (!empty($kelas)) {
			$this->db->where('kelas', $kelas);
		}

		$this->db->order_by('nama', 'ASC');
		return $this->db->get()->result();
	}

	public function get_data_guru($bidang = null)
	{
		$this->db->select('*');
		$this->db->from('guru');

		if (!empty($bidang)) {
			$this->db->where('bidang_pengajaran', $bidang);
		}

		$this->db->order_by('nama', 'ASC');
		return $this->db->get()->result();
	}

	public function get_data_nilai($kelas = null, $semester = null, $tahun_ajaran = null)
	{
		$this->db->select('
        nilai.id_nilai,
        nilai.id_santri,
        nilai.id_guru,
        nilai.mata_pelajaran,
        nilai.semester,
        nilai.tahun_ajaran,
        nilai.nilai_harian,
        nilai.nilai_uts,
        nilai.nilai_uas,
        (nilai.nilai_harian * 0.3 + nilai.nilai_uts * 0.3 + nilai.nilai_uas * 0.4) as nilai_akhir,
        santri.nis,
        santri.nama as nama_santri,
        santri.kelas,
        guru.nama as guru_pengampu
    ');
		$this->db->from('nilai');
		$this->db->join('santri', 'nilai.id_santri = santri.id_santri');
		$this->db->join('guru', 'nilai.id_guru = guru.id_guru');

		if (!empty($kelas)) {
			$this->db->where('santri.kelas', $kelas);
		}

		if (!empty($semester)) {
			$this->db->where('nilai.semester', $semester);
		}

		if (!empty($tahun_ajaran) && $tahun_ajaran !== 'Semua Tahun') {
			$this->db->where('nilai.tahun_ajaran', $tahun_ajaran);
		}

		$this->db->order_by('santri.nama', 'ASC');

		return $this->db->get()->result();
	}

	public function get_data_absen($kelas = null, $tanggal = null)
	{
		$this->db->select('absensi.*, santri.nis, santri.nama as nama_santri, santri.kelas');
		$this->db->from('absensi');
		$this->db->join('santri', 'absensi.id_santri = santri.id_santri');

		if (!empty($kelas)) {
			$this->db->where('santri.kelas', $kelas);
		}

		if (!empty($tanggal)) {
			$this->db->where('DATE(absensi.tanggal)', $tanggal);
		}

		$this->db->order_by('absensi.tanggal', 'DESC');
		$this->db->order_by('santri.nama', 'ASC');
		return $this->db->get()->result();
	}

	public function get_kelas_list()
	{
		$this->db->select('kelas');
		$this->db->from('santri');
		$this->db->group_by('kelas');
		$this->db->order_by('kelas', 'ASC');
		return $this->db->get()->result();
	}

	public function get_bidang_list()
	{
		$this->db->select('bidang_pengajaran');
		$this->db->from('guru');
		$this->db->group_by('bidang_pengajaran');
		$this->db->order_by('bidang_pengajaran', 'ASC');
		return $this->db->get()->result();
	}

	public function get_summary_data()
	{
		$data = array();

		$this->db->from('santri');
		$data['total_santri'] = $this->db->count_all_results();

		$this->db->from('guru');
		$data['total_guru'] = $this->db->count_all_results();

		$this->db->select('kelas, COUNT(*) as total');
		$this->db->from('santri');
		$this->db->group_by('kelas');
		$data['santri_per_kelas'] = $this->db->get()->result();

		$this->db->select('bidang_pengajaran, COUNT(*) as total');
		$this->db->from('guru');
		$this->db->group_by('bidang_pengajaran');
		$data['guru_per_bidang'] = $this->db->get()->result();

		return $data;
	}
}