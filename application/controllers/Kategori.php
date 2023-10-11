<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MKategori');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['kategoris'] = $this->db->query("SELECT * FROM kategori WHERE deleted_at IS NULL")->result_array();
        $data['page'] = 'kategori/kategori_list';
        $this->load->view('template', $data);
    }

    public function barang($kategori_id = null)
    {
        $this->db->select("*, kategori.nama AS nama_kategori, barang.nama AS nama_barang, barang.id AS id_barang");
        $this->db->join("kategori", "kategori.id = barang.kategori_id");
        $this->db->join("lokasi", "lokasi.id = barang.id_lokasi");
        $this->db->where('barang.kategori_id', $kategori_id);
        $this->db->where('is_active', 1);
        $this->db->where('barang.deleted_at', null);
        $data['barangs'] = $this->db->get("barang")->result_array();

        $data['page'] = 'kategori/barang_list';
        $this->load->view('template', $data);
        //$this->load->view('barang/barang_list', $data);
    }

    public function read($id)
    {
        $row = $this->MKategori->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'nama' => $row->nama,
            );
            $data['page'] = 'kategori/kategori_read';
            $this->load->view('template', $data);
            // $this->load->view('kategori/kategori_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Kategori Tidak ditemukan');
            redirect(site_url('kategori'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kategori/create_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
        );
        $data['page'] = 'kategori/kategori_form';
        $this->load->view('template', $data);
        //$this->load->view('kategori/kategori_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
            );

            $this->MKategori->insert($data);
            $this->session->set_flashdata('message', 'Data Kategori berhasil disimpan');
            redirect(site_url('kategori'));
        }
    }

    public function update($id)
    {
        $row = $this->MKategori->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kategori/update_action'),
                'id' => set_value('id', $row->id),
                'nama' => set_value('nama', $row->nama),
            );
            $data['page'] = 'kategori/kategori_form';
            $this->load->view('template', $data);
            //$this->load->view('kategori/kategori_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Kategori Tidak ditemukan');
            redirect(site_url('kategori'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
            );

            $this->MKategori->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Data Kategori berhasil diperbarui');
            redirect(site_url('kategori'));
        }
    }

    public function delete($id)
    {
        $row = $this->MKategori->get_by_id($id);

        if ($row) {
            $this->MKategori->delete($id);
            $this->session->set_flashdata('message', 'Data Kategori berhasil dihapus');
            redirect(site_url('kategori'));
        } else {
            $this->session->set_flashdata('message', 'Data Kategori Tidak ditemukan');
            redirect(site_url('kategori'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "kategori.xls";
        $judul = "kategori";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");

        foreach ($this->MKategori->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Kategori.php */
/* Location: ./application/controllers/Kategori.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-05-29 15:33:16 */
/* http://harviacode.com */