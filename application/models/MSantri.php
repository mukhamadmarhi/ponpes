<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MSantri extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Get all santri
	public function get_all_santri()
	{
		return $this->db->get('santri')->result();
	}

	// Get active santri
	public function get_active_santri()
	{
		return $this->db->get_where('santri', array('status' => 'Aktif'))->result();
	}

	// Get santri by id
	public function get_santri_by_id($id_santri)
	{
		return $this->db->get_where('santri', array('id_santri' => $id_santri))->row();
	}

	// Get santri by nis
	public function get_santri_by_nis($nis)
	{
		return $this->db->get_where('santri', ['nis' => $nis])->row();
	}

	// Add new santri
	public function add_santri($data)
	{
		$this->db->insert('santri', $data);
		return $this->db->insert_id();
	}

	// Update santri
	public function update_santri($id_santri, $data)
	{
		$this->db->where('id_santri', $id_santri);
		return $this->db->update('santri', $data);
	}

	// Delete santri
	public function delete_santri($id_santri)
	{
		return $this->db->delete('santri', ['id_santri' => $id_santri]);
	}

	// Count all santri
	public function count_all_santri()
	{
		return $this->db->count_all('santri');
	}

	public function count_santri_by_status($status)
	{
		return $this->db->where('status', $status)->count_all_results('santri');
	}

	public function count_filtered_santri($keyword = null, $kelas = null, $status = null)
	{
		if (!empty($keyword)) {
			$this->db->like('nama', $keyword);
			$this->db->or_like('nis', $keyword);
		}
		if (!empty($kelas) && $kelas !== 'Semua') {
			$this->db->where('kelas', $kelas);
		}
		if (!empty($status) && $status !== 'Semua') {
			$this->db->where('status', $status);
		}
		return $this->db->count_all_results('santri');
	}

	public function get_filtered_santri($limit, $offset, $keyword = null, $kelas = null, $status = null)
	{
		$this->db->limit($limit, $offset);

		if (!empty($keyword)) {
			$this->db->like('nama', $keyword);
			$this->db->or_like('nis', $keyword);
		}
		if (!empty($kelas) && $kelas !== 'Semua') {
			$this->db->where('kelas', $kelas);
		}
		if (!empty($status) && $status !== 'Semua') {
			$this->db->where('status', $status);
		}

		return $this->db->get('santri')->result();
	}

	public function count_all()
	{
		return $this->db->count_all('santri');
	}


}