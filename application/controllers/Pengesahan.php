<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengesahan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MBarang');
        $this->load->model('MRuangan');
        $this->load->model('MTransaksi');
        
    }
    public function index()
    {
        $data['kecamatan'] = $this->db->get_where('kecamatan', ['id' => $this->session->userdata('id_kecamatan')])->row();
        $this->db->select('*, kartu_inventaris_barang.id AS id_kartu_inventaris_barang');
        $this->db->join('lokasi', 'lokasi.id = kartu_inventaris_barang.id_lokasi');
        $this->db->order_by('created_at', 'DESC');
        $data['barang'] = $this->db->get_where('kartu_inventaris_barang', [
            'status_pengesahan' => 0,
            'is_valid' => 1,
            'id_kecamatan' => $this->session->userdata('id_kecamatan'),
        ])->result();

        $this->db->select('*, kartu_inventaris_ruangan.id AS id_kartu_inventaris_ruangan');
        $this->db->join('lokasi', 'lokasi.id = kartu_inventaris_ruangan.id_lokasi');
        $this->db->order_by('created_at', 'DESC');
        $data['ruangan'] = $this->db->get_where('kartu_inventaris_ruangan', [
            'status_pengesahan' => 0,
            'is_valid' => 1,
            'id_kecamatan' => $this->session->userdata('id_kecamatan'),
        ])->result();

        $data['page'] = 'pengesahan/index';
        $this->load->view('template', $data);
    }

    public function histori($value='')
    {
        $data['kecamatan'] = $this->db->get_where('kecamatan', ['id' => $this->session->userdata('id_kecamatan')])->row();
        $this->db->select('*, kartu_inventaris_barang.id AS id_kartu_inventaris_barang');
        $this->db->join('lokasi', 'lokasi.id = kartu_inventaris_barang.id_lokasi');
        $this->db->order_by('created_at', 'DESC');
        $data['barang'] = $this->db->get_where('kartu_inventaris_barang', [
            'status_pengesahan' => 1,
            'id_kecamatan' => $this->session->userdata('id_kecamatan'),
        ])->result();

        $this->db->select('*, kartu_inventaris_ruangan.id AS id_kartu_inventaris_ruangan');
        $this->db->join('lokasi', 'lokasi.id = kartu_inventaris_ruangan.id_lokasi');
        $this->db->order_by('created_at', 'DESC');
        $data['ruangan'] = $this->db->get_where('kartu_inventaris_ruangan', [
            'status_pengesahan' => 1,
            'id_kecamatan' => $this->session->userdata('id_kecamatan'),
        ])->result();

        $data['page'] = 'pengesahan/histori';
        $this->load->view('template', $data);
    }

    public function pengesahanBarang($id_kartu_inventaris_barang)
    {
        $kode_pengesahan = acak(15);
        $this->db->where('id', $id_kartu_inventaris_barang);
        $this->db->update('kartu_inventaris_barang', [
            'status_pengesahan' => 1,
            'kode_pengesahan' => $kode_pengesahan,
            'id_camat' => $this->session->userdata('id'),
            'updated_at' => date('Y-m-d'),
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function pengesahanRuangan($id_kartu_inventaris_ruangan)
    {
        $kode_pengesahan = acak(15);
        $this->db->where('id', $id_kartu_inventaris_ruangan);
        $this->db->update('kartu_inventaris_ruangan', [
            'status_pengesahan' => 1,
            'kode_pengesahan' => $kode_pengesahan,
            'id_camat' => $this->session->userdata('id'),
            'updated_at' => date('Y-m-d'),
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }
    


}
