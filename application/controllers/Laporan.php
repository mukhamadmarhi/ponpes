<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MLaporan');
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

        $data['title'] = 'Data Laporan';
        $this->load->view('layouts/header', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('layouts/footer');
    }

    public function get_santri()
    {
        $kelas = $this->input->get('kelas');
        $data = $this->MLaporan->get_data_santri($kelas);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function get_guru()
    {
        $bidang = $this->input->get('bidang');
        $data = $this->MLaporan->get_data_guru($bidang);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function get_nilai()
    {
        $kelas = $this->input->get('kelas');
        $semester = $this->input->get('semester');
        $tahun_ajaran = $this->input->get('tahun_ajaran');
        $data = $this->MLaporan->get_data_nilai($kelas, $semester, $tahun_ajaran);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function get_absen()
    {
        $kelas = $this->input->get('kelas');
        $tanggal = $this->input->get('tanggal');
        $data = $this->MLaporan->get_data_absen($kelas, $tanggal);
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    /* PREVIEW FUNCTIONS */
    public function preview_santri()
    {
        $kelas = $this->input->get('kelas');
        $data['santri'] = $this->MLaporan->get_data_santri($kelas);
        $data['title'] = 'Laporan Data Santri';
        $data['kelas'] = $kelas ?: 'Semua Kelas';
        $this->load->view('laporan/export_santri', $data);
    }

    public function preview_guru()
    {
        $bidang = $this->input->get('bidang');
        $data['guru'] = $this->MLaporan->get_data_guru($bidang);
        $data['title'] = 'Laporan Data Guru';
        $data['bidang'] = $bidang ?: 'Semua Bidang';
        $this->load->view('laporan/export_guru', $data);
    }

    public function preview_nilai()
    {
        $kelas = $this->input->get('kelas');
        $semester = $this->input->get('semester');
        $tahun_ajaran = $this->input->get('tahun_ajaran');
        $data = [
            'title' => 'Laporan Nilai Santri',
            'nilai' => $this->MLaporan->get_data_nilai($kelas, $semester, $tahun_ajaran),
            'kelas' => $kelas ?: 'Semua Kelas',
            'semester' => $semester ?: 'Semua Semester',
            'tahun_ajaran' => $tahun_ajaran ?: 'Semua Tahun Ajaran',
            'wali_kelas' => $this->get_wali_kelas($kelas),
            'tanggal_cetak' => date('d F Y')
        ];
        $this->load->view('laporan/export_nilai', $data);
    }

    public function preview_absen()
    {
        $kelas = $this->input->get('kelas');
        $tanggal = $this->input->get('tanggal');
        $data['absen'] = $this->MLaporan->get_data_absen($kelas, $tanggal);
        $data['title'] = 'Laporan Absensi Santri';
        $data['kelas'] = $kelas ?: 'Semua Kelas';
        $data['tanggal'] = $tanggal ?: 'Semua Tanggal';
        $this->load->view('laporan/export_absen', $data);
    }

    /* EXPORT TO PDF FUNCTIONS */
    public function export_santri()
    {
        $kelas = $this->input->get('kelas');
        $data['santri'] = $this->MLaporan->get_data_santri($kelas);
        $data['title'] = 'Laporan Data Santri';
        $data['kelas'] = $kelas ?: 'Semua Kelas';

        $html = $this->load->view('laporan/export_santri', $data, true);

        $this->generate_pdf($html, 'laporan_santri.pdf');
    }

    public function export_guru()
    {
        $bidang = $this->input->get('bidang');
        $data['guru'] = $this->MLaporan->get_data_guru($bidang);
        $data['title'] = 'Laporan Data Guru';
        $data['bidang'] = $bidang ?: 'Semua Bidang';

        $html = $this->load->view('laporan/export_guru', $data, true);

        $this->generate_pdf($html, 'laporan_guru.pdf');
    }

    public function export_nilai()
    {
        $kelas = $this->input->get('kelas');
        $semester = $this->input->get('semester');
        $tahun_ajaran = $this->input->get('tahun_ajaran');

        $data = [
            'title' => 'Laporan Nilai Santri',
            'nilai' => $this->MLaporan->get_data_nilai($kelas, $semester, $tahun_ajaran),
            'kelas' => $kelas ?: 'Semua Kelas',
            'semester' => $semester ?: 'Semua Semester',
            'tahun_ajaran' => $tahun_ajaran ?: 'Semua Tahun Ajaran',
            'wali_kelas' => $this->get_wali_kelas($kelas),
            'tanggal_cetak' => date('d F Y')
        ];

        $html = $this->load->view('laporan/export_nilai', $data, true);

        $this->generate_pdf($html, 'laporan_nilai.pdf', true);
    }

    public function export_absen()
    {
        $kelas = $this->input->get('kelas');
        $tanggal = $this->input->get('tanggal');
        $data['absen'] = $this->MLaporan->get_data_absen($kelas, $tanggal);
        $data['title'] = 'Laporan Absensi Santri';
        $data['kelas'] = $kelas ?: 'Semua Kelas';
        $data['tanggal'] = $tanggal ?: 'Semua Tanggal';

        $html = $this->load->view('laporan/export_absen', $data, true);

        $this->generate_pdf($html, 'laporan_absen.pdf');
    }

    /* HELPER FUNCTIONS */
    private function generate_pdf($html, $filename, $landscape = false)
    {
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('defaultFont', 'Times New Roman');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', $landscape ? 'landscape' : 'portrait');
        $dompdf->render();
        $dompdf->stream($filename, ["Attachment" => true]);
    }

    private function get_wali_kelas($kelas)
    {
        if (empty($kelas)) {
            return '-';
        }

        $this->db->select('guru.nama, guru.nip');
        $this->db->from('kelas');
        $this->db->join('guru', 'kelas.id_guru = guru.id_guru');
        $this->db->where('kelas.nama_kelas', $kelas);
        $query = $this->db->get();

        return $query->row() ? $query->row()->nama . ' (NIP: ' . $query->row()->nip . ')' : '-';
    }
}