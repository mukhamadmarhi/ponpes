<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MJadwal extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Get all jadwal
	public function get_all_jadwal()
	{
		return $this->db->select('jadwal.*, guru.nama as nama_guru')
			->from('jadwal')
			->join('guru', 'guru.id_guru = jadwal.id_guru')
			->get()->result();
	}

	// Get jadwal by id
	public function get_jadwal_by_id($id_jadwal)
	{
		return $this->db->get_where('jadwal', array('id_jadwal' => $id_jadwal))->row();
	}

	// Get jadwal by hari
	public function get_jadwal_by_hari($hari)
	{
		return $this->db->get_where('jadwal', array('hari' => $hari))->result();
	}

	// Get jadwal by guru
	public function get_jadwal_by_guru($id_guru)
	{
		return $this->db->get_where('jadwal', array('id_guru' => $id_guru))->result();
	}

	// Add new jadwal
	public function add_jadwal($data)
	{
		$this->db->insert('jadwal', $data);
		return $this->db->insert_id();
	}

	// Update jadwal
	public function update_jadwal($id_jadwal, $data)
	{
		$this->db->where('id_jadwal', $id_jadwal);
		return $this->db->update('jadwal', $data);
	}

	// Delete jadwal
	public function delete_jadwal($id_jadwal)
	{
		return $this->db->delete('jadwal', array('id_jadwal' => $id_jadwal));
	}

	public function get_filtered_jadwal($mapel, $hari, $kelas, $limit, $start)
	{
		$this->db->select('jadwal.*, guru.nama as nama_guru')
			->from('jadwal')
			->join('guru', 'guru.id_guru = jadwal.id_guru');

		if ($mapel)
			$this->db->like('jadwal.mata_pelajaran', $mapel);
		if ($hari)
			$this->db->where('jadwal.hari', $hari);
		if ($kelas)
			$this->db->where('jadwal.kelas', $kelas);

		$this->db->limit($limit, $start);
		return $this->db->get()->result();
	}

	public function count_filtered($mapel, $hari, $kelas)
	{
		$this->db->from('jadwal')
			->join('guru', 'guru.id_guru = jadwal.id_guru');

		if ($mapel)
			$this->db->like('jadwal.mata_pelajaran', $mapel);
		if ($hari)
			$this->db->where('jadwal.hari', $hari);
		if ($kelas)
			$this->db->where('jadwal.kelas', $kelas);

		return $this->db->count_all_results();
	}
}