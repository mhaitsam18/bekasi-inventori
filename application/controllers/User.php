<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function profile()
    {
        $this->form_validation->set_rules('nama_operator', 'Nama Lengkap', 'required');
        // $user = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row();
        // if ($this->input->post('username') != $user->username) {
        //     $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]');
        // }
        if ($this->form_validation->run() ==  false) {
            $data['user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row();
            $data['page'] = 'user/profile';
            $this->load->view('template', $data);
        } else {
            $id = $this->input->post('id');

            $data = [
                'nama_operator' => $this->input->post('nama_operator'),
                'username' => $this->input->post('username')
            ];
            $this->session->set_userdata("username", $this->input->post('username'));
            $this->db->where('id', $id);
            $this->db->update('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Selamat, Profil Anda Telah diperbarui!
                </div>');
            redirect('user/profile');
        }
    }
}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-05-29 15:33:03 */
/* http://harviacode.com */