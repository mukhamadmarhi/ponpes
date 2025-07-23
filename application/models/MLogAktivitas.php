<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MLogAktivitas extends CI_Model
{
	protected $table = 'aktivitas_log';

	public function __construct()
	{
		parent::__construct();
	}

	public function insert_log($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function get_recent_logs($limit = 5)
	{
		$this->db->select('a.*, u.username as nama_user');
		$this->db->from("{$this->table} a");
		$this->db->join('users u', 'a.user_id = u.id_user');
		$this->db->order_by('a.created_at', 'DESC');
		$this->db->limit($limit);
		return $this->db->get()->result();
	}

	public function get_all_logs()
	{
		$this->db->select('a.*, u.username as nama_user');
		$this->db->from("{$this->table} a");
		$this->db->join('users u', 'a.user_id = u.id_user');
		$this->db->order_by('a.created_at', 'DESC');
		return $this->db->get()->result();
	}
}
