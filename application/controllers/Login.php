<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MUser');
    }


    public function index()
    {
        $this->load->view('login_view');
    }

    function validasi()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if ($this->MUser->CheckUser($username, $password) == true) {
            $row = $this->MUser->get_by_username($username);
            $data_user = array(
                'id' => $row->id,
                'username' => $username,
                'nama_operator' => $row->nama_operator,
                'nomor_anggota' => $row->nomor_anggota,
                'hak_akses' => $row->hak_akses,
                'id_kecamatan' => $row->id_kecamatan,
                'is_login' => true,
            );
            $this->session->set_userdata($data_user);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">
					Login Berhasil!
					</div>');
            redirect('dashboard');
            // exit;
            //exit;
            //echo "Echo Username dan password benar";
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
					Email atau Password Salah
					</div>');
            redirect($_SERVER['HTTP_REFERER']);
            //echo "Echo Username dan password Salah";
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Login');
    }

    public function qrcode($kode = 'Bekasi.id', $s = 6)
    {
        qrcode::png(
            $kode,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = $s,
            $margin = 1,
        );
    }
}
