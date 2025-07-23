<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MUser extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Get all users
	public function get_all_users()
	{
		return $this->db->get('users')->result();
	}

	// Get user by id
	public function get_user_by_id($id_user)
	{
		return $this->db->get_where('users', array('id_user' => $id_user))->row();
	}

	// Get user by username
	public function get_user_by_username($username)
	{
		return $this->db->get_where('users', array('username' => $username))->row();
	}

	// Get users by role
	public function get_users_by_role($role)
	{
		return $this->db->get_where('users', array('role' => $role))->result();
	}

	// Add new user
	public function add_user($data)
	{
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	// Update user
	public function update_user($id_user, $data)
	{
		$this->db->where('id_user', $id_user);
		return $this->db->update('users', $data);
	}

	// Delete user
	public function delete_user($id_user)
	{
		return $this->db->delete('users', array('id_user' => $id_user));
	}

	// Verify login
	public function verify_login($username, $password)
	{
		$user = $this->get_user_by_username($username);

		if ($user && password_verify($password, $user->password)) {
			return $user;
		}

		return false;
	}

	// Update last login
	public function update_last_login($id_user)
	{
		$this->db->where('id_user', $id_user);
		$this->db->update('users', array('last_login' => date('Y-m-d H:i:s')));
	}

	public function get_filtered_users($limit, $start, $username = null, $role = null, $status = null)
	{
		$this->db->select('users.*, 
		CASE 
			WHEN users.role = "guru" THEN guru.nama
			WHEN users.role = "santri" THEN santri.nama
			ELSE "-"
		END AS nama_terkait', false);
		$this->db->from('users');
		$this->db->join('guru', 'guru.id_guru = users.id_related AND users.role = "guru"', 'left');
		$this->db->join('santri', 'santri.id_santri = users.id_related AND users.role = "santri"', 'left');

		if (!empty($username)) {
			$this->db->like('users.username', $username);
		}
		if (!empty($role)) {
			$this->db->where('users.role', $role);
		}
		if (!empty($status)) {
			$this->db->where('users.status', $status);
		}

		$this->db->limit($limit, $start);
		return $this->db->get()->result();
	}

	public function count_filtered_users($search = '', $role = '', $status = '')
	{
		$this->db->from('users');

		if ($search) {
			$this->db->like('username', $search);
		}
		if ($role) {
			$this->db->where('role', $role);
		}
		if ($status) {
			$this->db->where('status', $status);
		}

		return $this->db->count_all_results();
	}

}