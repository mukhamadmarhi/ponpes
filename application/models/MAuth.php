<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MAuth extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function login($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('status', 'aktif');
		$user = $this->db->get('users')->row_array();

		if ($user && password_verify($password, $user['password'])) {
			$this->db->where('id_user', $user['id_user']);
			$this->db->update('users', ['last_login' => date('Y-m-d H:i:s')]);
			return $user;
		}

		return false;
	}

	private function get_user_data($role, $id_related)
	{
		switch ($role) {
			case 'guru':
				$this->load->model('MGuru');
				return (array) $this->MGuru->get_guru_by_id($id_related);
			case 'admin':
				return ['nama' => 'Administrator'];
			case 'santri':
				$this->load->model('MSantri');
				return (array) $this->MSantri->get_santri_by_id($id_related);
			default:
				return [];
		}
	}
	public function update_last_login($user_id)
	{
		$this->db->where('id_user', $user_id);
		$this->db->update('users', ['last_login' => date('Y-m-d H:i:s')]);
	}

	public function change_password($user_id, $new_password)
	{
		$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
		$this->db->where('id_user', $user_id);
		return $this->db->update('users', ['password' => $hashed_password]);
	}

	public function username_exists($username)
	{
		$this->db->where('username', $username);
		return $this->db->get('users')->num_rows() > 0;
	}

	public function register($user_data)
	{
		$this->db->insert('users', $user_data);
		return $this->db->insert_id();
	}

	public function get_user_by_id($user_id)
	{
		$this->db->where('id_user', $user_id);
		return $this->db->get('users')->row();
	}
}