<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi extends CI_Controller
{
    function __construct()
    {
        Parent::__construct();
    }
    public function index()
    {
        $this->db->select('lokasi.*, nama_kecamatan');
        $this->db->join('kecamatan', 'kecamatan.id = lokasi.id_kecamatan');
        $data['data_lokasi'] = $this->db->get_where("lokasi", [
            'lokasi.deleted_at' => null
        ])->result();
        $data['page'] = 'lokasi/index';
        $this->load->view('template', $data);
    }
    public function create()
    {
        $data['data_kecamatan'] = $this->db->get("kecamatan")->result();
        $data['page'] = 'lokasi/create';
        $this->load->view('template', $data);
    }
    public function store()
    {
        $data = [
            'nama_lokasi' => $this->input->post('nama_lokasi'),
            'alamat' => $this->input->post('alamat'),
            'id_kecamatan' => $this->input->post('id_kecamatan'),
        ];
        $this->db->insert('lokasi', $data);
        redirect('lokasi/index');
    }
    public function edit($id_lokasi = null)
    {
        $data['lokasi'] = $this->db->get_where("lokasi", ['id' => $id_lokasi])->row();
        $data['data_kecamatan'] = $this->db->get("kecamatan")->result();
        $data['page'] = 'lokasi/edit';
        $this->load->view('template', $data);
    }
    public function update()
    {
        $data = [
            'nama_lokasi' => $this->input->post('nama_lokasi'),
            'alamat' => $this->input->post('alamat'),
            'id_kecamatan' => $this->input->post('id_kecamatan'),
        ];
        $this->db->where('id', $this->input->post('id_lokasi'));
        $this->db->update('lokasi', $data);
        redirect('lokasi/index');
    }

    public function delete($id_lokasi = null)
    {
        $this->db->where('id', $id_lokasi);
        $this->db->update('lokasi', [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
        redirect('lokasi/index');
    }
}
