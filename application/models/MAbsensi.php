<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MAbsensi extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	// Get all absensi
	public function get_all_absensi()
	{
		$this->db->select('absensi.*, santri.nama as nama_santri, guru.nama as nama_guru, santri.foto as foto_santri, santri.kelas');
		$this->db->from('absensi');
		$this->db->join('santri', 'absensi.id_santri = santri.id_santri');
		$this->db->join('guru', 'absensi.id_guru = guru.id_guru');
		return $this->db->get()->result();
	}

	public function get_absensi_by_id($id_absensi)
	{
		return $this->db->get_where('absensi', array('id_absensi' => $id_absensi))->row();
	}

	public function get_absensi_by_santri($id_santri)
	{
		return $this->db->get_where('absensi', array('id_santri' => $id_santri))->result();
	}

	public function get_absensi_by_tanggal($tanggal)
	{
		return $this->db->get_where('absensi', array('tanggal' => $tanggal))->result();
	}

	public function add_absensi($data)
	{
		$this->db->insert('absensi', $data);
		return $this->db->insert_id();
	}

	public function update_absensi($id_absensi, $data)
	{
		$this->db->where('id_absensi', $id_absensi);
		return $this->db->update('absensi', $data);
	}

	public function delete_absensi($id_absensi)
	{
		return $this->db->delete('absensi', array('id_absensi' => $id_absensi));
	}

	public function get_absensi_by_date_range($start_date, $end_date)
	{
		$this->db->where('tanggal >=', $start_date);
		$this->db->where('tanggal <=', $end_date);
		return $this->db->get('absensi')->result();
	}

	public function count_filtered_absensi($search = null, $tanggal = null, $status = null)
	{
		$this->db->from('absensi');
		$this->db->join('santri', 'absensi.id_santri = santri.id_santri');
		$this->db->join('guru', 'absensi.id_guru = guru.id_guru');

		if (!empty($search)) {
			$this->db->like('santri.nama', $search);
		}

		if (!empty($tanggal)) {
			$this->db->where('absensi.tanggal', $tanggal);
		}

		if (!empty($status)) {
			$this->db->where('absensi.status', $status);
		}

		return $this->db->count_all_results();
	}

	public function get_filtered_absensi($limit, $start, $search = null, $tanggal = null, $status = null)
	{
		$this->db->select('absensi.*, santri.nama as nama_santri, guru.nama as nama_guru, santri.foto as foto_santri, santri.kelas');
		$this->db->from('absensi');
		$this->db->join('santri', 'absensi.id_santri = santri.id_santri');
		$this->db->join('guru', 'absensi.id_guru = guru.id_guru');

		if (!empty($search)) {
			$this->db->like('santri.nama', $search);
		}

		if (!empty($tanggal)) {
			$this->db->where('absensi.tanggal', $tanggal);
		}

		if (!empty($status)) {
			$this->db->where('absensi.status', $status);
		}

		$this->db->order_by('absensi.tanggal', 'DESC');
		$this->db->limit($limit, $start);
		return $this->db->get()->result();
	}

	public function get_today_percentage()
	{
		$total_santri = $this->db->count_all('santri');
		$hadir = $this->db
			->where('DATE(absensi.tanggal)', date('Y-m-d'))
			->where('status', 'Hadir')
			->count_all_results('absensi');

		if ($total_santri == 0)
			return 0;
		return round(($hadir / $total_santri) * 100, 2);
	}


	public function get_statistik_bulanan($bulan)
	{
		$this->db->select('status, COUNT(*) as jumlah');
		$this->db->from('absensi');
		$this->db->like('tanggal', $bulan, 'after');
		$this->db->group_by('status');
		$query = $this->db->get();

		$result = ['Hadir' => 0, 'Izin' => 0, 'Sakit' => 0, 'Alpa' => 0];
		foreach ($query->result() as $row) {
			$result[$row->status] = (int) $row->jumlah;
		}

		return $result;
	}

	public function get_statistik_by_bulan_tahun($bulan, $tahun)
	{
		$this->db->select('status, COUNT(*) as jumlah');
		$this->db->from('absensi');
		$this->db->where('MONTH(tanggal)', $bulan);
		$this->db->where('YEAR(tanggal)', $tahun);
		$this->db->group_by('status');
		$query = $this->db->get();

		$result = ['Hadir' => 0, 'Izin' => 0, 'Sakit' => 0, 'Alpa' => 0];
		foreach ($query->result() as $row) {
			$result[$row->status] = (int) $row->jumlah;
		}

		return $result;
	}

	public function get_absensi_hari_ini()
	{
		$this->db->select('absensi.*, santri.nama, santri.kelas');
		$this->db->from('absensi');
		$this->db->join('santri', 'santri.id_santri = absensi.id_santri');
		$this->db->where('DATE(absensi.tanggal)', date('Y-m-d'));
		$this->db->order_by('absensi.tanggal', 'ASC');
		return $this->db->get()->result();
	}

}