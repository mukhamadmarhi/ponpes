<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MGuru extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Get all guru
	public function get_all_guru()
	{
		return $this->db->get('guru')->result();
	}

	// Get active guru
	public function get_active_guru()
	{
		return $this->db->get_where('guru', array('status' => 'Aktif'))->result();
	}

	// Get guru by id
	public function get_guru_by_id($id_guru)
	{
		return $this->db->get_where('guru', array('id_guru' => $id_guru))->row();
	}

	// Get guru by nip
	public function get_guru_by_nip($nip)
	{
		return $this->db->get_where('guru', ['nip' => $nip])->row();
	}

	// Add new guru
	public function add_guru($data)
	{
		$this->db->insert('guru', $data);
		return $this->db->insert_id();
	}

	// Update guru
	public function update_guru($id_guru, $data)
	{
		$this->db->where('id_guru', $id_guru);
		return $this->db->update('guru', $data);
	}

	public function update_by_nip($nip, $data)
	{
		$this->db->where('nip', $nip);
		return $this->db->update('guru', $data);
	}

	// Delete guru
	public function delete_guru($id_guru)
	{
		return $this->db->delete('guru', ['id_guru' => $id_guru]);
	}

	public function delete_by_nip($nip)
	{
		return $this->db->delete('guru', ['nip' => $nip]);
	}

	// Count all guru
	public function count_all_guru()
	{
		return $this->db->count_all('guru');
	}

	public function count_filtered_guru($keyword = null, $bidang = null, $status = null)
	{
		$this->db->from('guru');
		if ($keyword) {
			$this->db->group_start()
				->like('nip', $keyword)
				->or_like('nama', $keyword)
				->group_end();
		}
		if ($bidang) {
			$this->db->where('bidang_pengajaran', $bidang);
		}
		if ($status) {
			$this->db->where('status', $status);
		}
		return $this->db->count_all_results();
	}

	public function get_filtered_guru($limit, $start, $keyword = null, $bidang = null, $status = null)
	{
		$this->db->from('guru');
		if ($keyword) {
			$this->db->group_start()
				->like('nip', $keyword)
				->or_like('nama', $keyword)
				->group_end();
		}
		if ($bidang) {
			$this->db->where('bidang_pengajaran', $bidang);
		}
		if ($status) {
			$this->db->where('status', $status);
		}
		$this->db->limit($limit, $start);
		return $this->db->get()->result();
	}

	public function count_all()
	{
		return $this->db->count_all('guru');
	}


}
