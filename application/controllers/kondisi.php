<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kondisi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('MBarang', 'MKategori'));
    }

    public function baik()
    {
        $data['barangs'] = $this->db->query("SELECT * FROM barang WHERE kondisi = 'baik'")->result_array();
        $data['page'] = 'kondisi/baik';
        $data['kondisi'] = 'baik';
        $this->load->view('template', $data);
    }
    public function buruk()
    {
        $data['barangs'] = $this->db->query("SELECT * FROM barang WHERE kondisi = 'buruk'")->result_array();
        $data['page'] = 'kondisi/buruk';
        $data['kondisi'] = 'buruk';
        $this->load->view('template', $data);
    }
    public function rusak()
    {
        $data['barangs'] = $this->db->query("SELECT * FROM barang WHERE kondisi = 'rusak'")->result_array();
        $data['page'] = 'kondisi/rusak';
        $data['kondisi'] = 'rusak';
        $this->load->view('template', $data);
    }

    public function Excel($kondisi)
    {
        $this->load->helper('exportexcel');
        $namaFile = "kondisi-barang.xls";
        $judul = "barang";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Barang");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis");
        xlsWriteLabel($tablehead, $kolomhead++, "Kondisi");


        $kondisi_barang = $this->db->query("SELECT * FROM barang WHERE kondisi = '$kondisi'")->result();


        foreach ($kondisi_barang as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis);
            xlsWriteLabel($tablebody, $kolombody++, $data->kondisi);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}