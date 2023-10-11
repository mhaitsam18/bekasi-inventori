<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dashboard extends CI_Controller
{


    public function index()
    {
        $data['page'] = 'dashboard_view';
        if ($this->session->userdata('hak_akses') == 'kecamatan') {
            $data['kecamatan'] = $this->db->get_where('kecamatan', ['id' => $this->session->userdata('id_kecamatan')])->row();
            $this->db->select('*, kartu_inventaris_barang.id AS id_kartu_inventaris_barang');
            $this->db->join('lokasi', 'lokasi.id = kartu_inventaris_barang.id_lokasi');
            $this->db->order_by('created_at', 'DESC');
            $data['barang'] = $this->db->get_where('kartu_inventaris_barang', [
                'status_pengesahan' => 0,
                'is_valid' => 1,
                'id_kecamatan' => $this->session->userdata('id_kecamatan'),
            ]);

            $this->db->select('*, kartu_inventaris_ruangan.id AS id_kartu_inventaris_ruangan');
            $this->db->join('lokasi', 'lokasi.id = kartu_inventaris_ruangan.id_lokasi');
            $this->db->order_by('created_at', 'DESC');
            $data['ruangan'] = $this->db->get_where('kartu_inventaris_ruangan', [
                'status_pengesahan' => 0,
                'is_valid' => 1,
                'id_kecamatan' => $this->session->userdata('id_kecamatan'),
            ]);
            $data['jumlah_laporan'] = $data['barang']->num_rows() + $data['ruangan']->num_rows();


            $this->db->join('lokasi', 'lokasi.id = kartu_inventaris_barang.id_lokasi');
            $num_riwayat_barang = $this->db->get_where('kartu_inventaris_barang', [
                'id_kecamatan' => $this->session->userdata('id_kecamatan'),
            ])->num_rows();
            $this->db->join('lokasi', 'lokasi.id = kartu_inventaris_ruangan.id_lokasi');
            $num_riwayat_ruangan = $this->db->get_where('kartu_inventaris_ruangan', [
                'id_kecamatan' => $this->session->userdata('id_kecamatan'),
            ])->num_rows();
            $data['jumlah_riwayat'] = $num_riwayat_barang + $num_riwayat_ruangan;

            $this->db->join('lokasi', 'lokasi.id = kartu_inventaris_barang.id_lokasi');
            $data['num_kartu_barang'] = $this->db->get_where('kartu_inventaris_barang', [
                'status_pengesahan' => 1,
                'is_valid' => 1,
                'id_kecamatan' => $this->session->userdata('id_kecamatan'),
            ])->num_rows();
            $this->db->join('lokasi', 'lokasi.id = kartu_inventaris_ruangan.id_lokasi');
            $data['num_kartu_ruangan'] = $this->db->get_where('kartu_inventaris_ruangan', [
                'status_pengesahan' => 1,
                'is_valid' => 1,
                'id_kecamatan' => $this->session->userdata('id_kecamatan'),
            ])->num_rows();
        } elseif ($this->session->userdata('hak_akses') == 'admin') {
            $data['num_user'] = $this->db->get('user')->num_rows();
            $data['num_barang'] = $this->db->get('barang')->num_rows();
            $data['num_barang_baik'] = $this->db->get_where('barang', ['kondisi' => 'baik'])->num_rows();
            $data['num_barang_buruk'] = $this->db->get_where('barang', ['kondisi' => 'buruk'])->num_rows();
            $data['num_barang_rusak'] = $this->db->get_where('barang', ['kondisi' => 'rusak'])->num_rows();

            $this->db->select('MAX(tanggal_pengadaan) AS terakhir_masuk');
            $data['terakhir_masuk'] = $this->db->get('barang')->row();

            $data['num_barang_masuk'] = $this->db->query("SELECT * FROM barang WHERE MONTH(tanggal_pengadaan) = MONTH(NOW())")->num_rows();

            $data['num_transaksi_pending'] = $this->db->query("SELECT * FROM transaksi WHERE approval = 0 AND MONTH(tanggal_datang) = MONTH(NOW()) AND YEAR(tanggal_datang) = YEAR(NOW())")->num_rows();
            $data['num_transaksi_diterima'] = $this->db->query("SELECT * FROM transaksi WHERE approval = 1 AND MONTH(tanggal_datang) = MONTH(NOW()) AND YEAR(tanggal_datang) = YEAR(NOW())")->num_rows();
            $data['num_transaksi_ditolak'] = $this->db->query("SELECT * FROM transaksi WHERE approval = 2 AND MONTH(tanggal_datang) = MONTH(NOW()) AND YEAR(tanggal_datang) = YEAR(NOW())")->num_rows();
            $data['transaksi_pending'] = $this->db->get_where('transaksi', ['approval' => 0])->result();
        } elseif ($this->session->userdata('hak_akses') == 'pengelola') {
            $data['kecamatan'] = $this->db->get_where('kecamatan', ['id' => $this->session->userdata('id_kecamatan')])->row();
            $this->db->select('*, kartu_inventaris_barang.id AS id_kartu_inventaris_barang');
            $this->db->join('lokasi', 'lokasi.id = kartu_inventaris_barang.id_lokasi');
            $this->db->order_by('created_at', 'DESC');
            $data['barang'] = $this->db->get_where('kartu_inventaris_barang', [
                'status_pengesahan' => 1,
                'is_valid' => 1,
                'closed_at' => null,
                'id_kecamatan' => $this->session->userdata('id_kecamatan'),
            ]);

            $this->db->select('*, kartu_inventaris_ruangan.id AS id_kartu_inventaris_ruangan');
            $this->db->join('lokasi', 'lokasi.id = kartu_inventaris_ruangan.id_lokasi');
            $this->db->order_by('created_at', 'DESC');
            $data['ruangan'] = $this->db->get_where('kartu_inventaris_ruangan', [
                'status_pengesahan' => 1,
                'is_valid' => 1,
                'closed_at' => null,
                'id_kecamatan' => $this->session->userdata('id_kecamatan'),
            ]);
        }
        $this->load->view('template', $data);
        //$this->load->view('dashboard_view',);
    }
    public function logout()
    {
        session_destroy();
        redirect(site_url('/'));
    }
}
