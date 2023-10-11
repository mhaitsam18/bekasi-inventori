<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Petugas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MTransaksi');
        $this->load->model('MUser');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $data = array(
            'petugass' => $this->db->query("SELECT * FROM user WHERE deleted_at IS NULL")->result_array()
        );
        $data['page'] = 'petugas/petugas_list';
        $this->load->view('template', $data);
    }
    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('petugas/create_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
            'nomor' => $this->MUser->nomor_anggota(),
            'username' => set_value('username'),
            'password' => set_value('password'),
            'hak_akses' => set_value('hak_akses'),
            'id_kecamatan' => set_value('id_kecamatan'),
        );
        $data['page'] = 'petugas/petugas_form';
        $data['list_kecamatan'] = $this->db->get('kecamatan')->result();
        $this->load->view('template', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'username' => $this->input->post('username', TRUE),
                'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
                'hak_akses' => $this->input->post('hak_akses', TRUE),
                'nama_operator' => $this->input->post('nama', TRUE),
                'nomor_anggota' => $this->input->post('nomor', TRUE),
                'id_kecamatan' => $this->input->post('id_kecamatan', TRUE),
            );

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', 'Data Petugas berhasil disimpan');
            redirect(site_url('petugas'));
        }
    }

    public function update($id)
    {
        $this->db->where('id', $id);
        $row = $this->db->get('user')->row();

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('petugas/update_action'),
                'id' => set_value('id', $row->id),
                'nama' => set_value('nama', $row->nama_operator),
                'nomor' => set_value('nomor', $row->nomor_anggota),
                'username' => set_value('username', $row->username),
                'password' => set_value('password', $row->password),
                'hak_akses' => set_value('hak_akses', $row->hak_akses),
                'id_kecamatan' => set_value('id_kecamatan', $row->id_kecamatan),
            );
            $data['page'] = 'petugas/petugas_form';
            $data['list_kecamatan'] = $this->db->get('kecamatan')->result();
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Petugas tidak ditemukan');
            redirect(site_url('petugas'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'username' => $this->input->post('username', TRUE),
                'password' => password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT),
                'hak_akses' => $this->input->post('hak_akses', TRUE),
                'nama_operator' => $this->input->post('nama', TRUE),
                'nomor_anggota' => $this->input->post('nomor', TRUE),
                'id_kecamatan' => $this->input->post('id_kecamatan', TRUE),
            );

            $this->db->where('id', $this->input->post('id', TRUE));
            $this->db->update('user', $data);
            $this->session->set_flashdata('message', 'Data Petugas Berhasil diperbarui');
            redirect(site_url('petugas'));
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $row = $this->db->get('user')->row();

        if ($row) {
            // $this->db->delete('user', ['id' => $id]);
            $this->db->where('id', $id);
            $this->db->update('user', ['deleted_at' => date('Y-m-d H:i:s')]);
            $this->db->insert('sampah', [
                'tabel' => 'user',
                'id_subjek' => $id
            ]);
            $this->session->set_flashdata('message', 'Data Petugas berhasil dihapus');
            redirect(site_url('petugas'));
        } else {
            $this->session->set_flashdata('message', 'Data Petugas Tidak ditemukan');
            redirect(site_url('petugas'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('nomor', 'nomor', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('hak_akses', 'hak_akses', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
