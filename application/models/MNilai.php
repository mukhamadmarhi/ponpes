<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MNilai extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Get all nilai
	public function get_all_nilai()
	{
		$this->db->select('nilai.*, santri.nama as nama_santri, guru.nama as nama_guru, santri.foto, santri.kelas');
		$this->db->from('nilai');
		$this->db->join('santri', 'nilai.id_santri = santri.id_santri');
		$this->db->join('guru', 'nilai.id_guru = guru.id_guru');
		return $this->db->get()->result();
	}

	// Get nilai by id
	public function get_nilai_by_id($id_nilai)
	{
		return $this->db->get_where('nilai', array('id_nilai' => $id_nilai))->row();
	}

	// Get nilai by santri
	public function get_nilai_by_santri($id_santri)
	{
		return $this->db->get_where('nilai', array('id_santri' => $id_santri))->result();
	}

	// Get nilai by mata pelajaran
	public function get_nilai_by_mapel($mata_pelajaran)
	{
		return $this->db->get_where('nilai', array('mata_pelajaran' => $mata_pelajaran))->result();
	}

	// Get nilai by semester dan tahun ajaran
	public function get_nilai_by_semester($semester, $tahun_ajaran)
	{
		return $this->db->get_where('nilai', array(
			'semester' => $semester,
			'tahun_ajaran' => $tahun_ajaran
		))->result();
	}

	// Add new nilai
	public function add_nilai($data)
	{
		$this->db->insert('nilai', $data);
		return $this->db->insert_id();
	}

	// Update nilai
	public function update_nilai($id_nilai, $data)
	{
		$this->db->where('id_nilai', $id_nilai);
		return $this->db->update('nilai', $data);
	}

	// Delete nilai
	public function delete_nilai($id_nilai)
	{
		return $this->db->delete('nilai', ['id_nilai' => $id_nilai]);
	}

	// Calculate nilai akhir
	public function calculate_nilai_akhir($id_nilai)
	{
		$nilai = $this->get_nilai_by_id($id_nilai);
		$nilai_akhir = ($nilai->nilai_harian * 0.4) + ($nilai->nilai_uts * 0.3) + ($nilai->nilai_uas * 0.3);

		$this->db->where('id_nilai', $id_nilai);
		$this->db->update('nilai', array('nilai_akhir' => $nilai_akhir));

		return $nilai_akhir;
	}

	public function get_filtered_nilai($search = null, $mapel = null, $semester = null, $tahun = null, $limit = null, $offset = null)
	{
		$this->db->select('nilai.*, santri.nama as nama_santri, guru.nama as nama_guru, santri.foto, santri.kelas');
		$this->db->from('nilai');
		$this->db->join('santri', 'nilai.id_santri = santri.id_santri');
		$this->db->join('guru', 'nilai.id_guru = guru.id_guru');

		if (!empty($search)) {
			$this->db->like('santri.nama', $search);
		}
		if (!empty($mapel)) {
			$this->db->where('nilai.mata_pelajaran', $mapel);
		}
		if (!empty($semester)) {
			$this->db->where('nilai.semester', $semester);
		}
		if (!empty($tahun)) {
			$this->db->where('nilai.tahun_ajaran', $tahun);
		}

		if ($limit !== null) {
			$this->db->limit($limit, $offset);
		}

		return $this->db->get()->result();
	}

	public function count_filtered_nilai($search = null, $mapel = null, $semester = null, $tahun = null)
	{
		$this->db->from('nilai');
		$this->db->join('santri', 'nilai.id_santri = santri.id_santri');
		$this->db->join('guru', 'nilai.id_guru = guru.id_guru');

		if (!empty($search)) {
			$this->db->like('santri.nama', $search);
		}
		if (!empty($mapel)) {
			$this->db->where('nilai.mata_pelajaran', $mapel);
		}
		if (!empty($semester)) {
			$this->db->where('nilai.semester', $semester);
		}
		if (!empty($tahun)) {
			$this->db->where('nilai.tahun_ajaran', $tahun);
		}

		return $this->db->count_all_results();
	}

	public function count_belum_input()
	{
		$this->db->select('santri.id_santri');
		$this->db->from('santri');
		$this->db->join('nilai', 'santri.id_santri = nilai.id_santri', 'left');
		$this->db->group_start();
		$this->db->where('nilai.nilai_akhir IS NULL');
		$this->db->or_where('nilai.nilai_akhir', '');
		$this->db->group_end();
		return $this->db->count_all_results();
	}
}