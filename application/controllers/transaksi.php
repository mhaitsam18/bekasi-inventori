<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MTransaksi');
        $this->load->library('form_validation');
        $this->load->library('pdf');
    }

    public function index($approval = null)
    {

        if ($this->session->hak_akses == 'admin') {
            if ($approval != null) {
                $data['transaksi_data'] = $this->db->query("SELECT *,transaksi.id as id,barang.id as id_barang FROM transaksi INNER JOIN barang ON transaksi.kode_barang = barang.kode WHERE status = 'datang' AND approval = $approval AND transaksi.deleted_at IS NULL")->result();
            } else {
                $data['transaksi_data'] = $this->db->query("SELECT *,transaksi.id as id,barang.id as id_barang FROM transaksi INNER JOIN barang ON transaksi.kode_barang = barang.kode WHERE status = 'datang' AND transaksi.deleted_at IS NULL")->result();
            }
        } else {
            $data['transaksi_data'] = $this->db->query("SELECT *,transaksi.id as id,barang.id as id_barang FROM transaksi INNER JOIN barang ON transaksi.kode_barang = barang.kode WHERE nomor_anggota = '" . $this->session->nomor_anggota . "' AND transaksi.deleted_at IS NULL")->result();
        }
        $data['page'] = 'transaksi/transaksi_list';
        $this->load->view('template', $data);
    }

    public function read($id)
    {
        $row = $this->MTransaksi->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'kode_barang' => $row->kode_barang,
                'nomor_anggota' => $row->nomor_anggota,
                'jumlah_barang' => $row->jumlah_barang,
                'tanggal_datang' => $row->tanggal_datang,
                'tanggal_distribusi' => $row->tanggal_distribusi,
                'status' => $row->status,
                'bap' => $row->bap,
                'approval' => $row->approval,
            );

            $data['page'] = 'transaksi/transaksi_read';
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Transaksi tidak ditemukan');
            redirect(site_url('transaksi'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('transaksi/create_action'),
            'id' => set_value('id'),
            'kode_barang' => set_value('kode_barang'),
            'nomor_anggota' => set_value('nomor_anggota'),
            'jumlah_barang' => set_value('jumlah_barang'),
            'tanggal_datang' => set_value('tanggal_datang'),
            'tanggal_distribusi' => set_value('tanggal_distribusi'),
            'waktu' => set_value('waktu'),
            'status' => set_value('status'),
        );
        $data['barang'] = $this->db->get("barang")->result();
        $data['page'] = 'transaksi/transaksi_form';
        $this->load->view('template', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $upload_image = $_FILES['bap']['name'];
            $bap = "Contoh-BAP-SiVaCam.docx";
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|svg|jpeg|pdf';
                $config['upload_path'] = './assets/bap';
                $config['max_size']     = '2048';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('bap')) {
                    $bap = $this->upload->data('file_name');
                } else {
                    $bap = "contoh.pdf";
                }
            }
            $data = array(
                'kode_barang' => $this->input->post('kode_barang', TRUE),
                'nomor_anggota' => $this->input->post('nomor_anggota', TRUE),
                'jumlah_barang' => $this->input->post('jumlah_barang', TRUE),
                'tanggal_datang' => $this->input->post('tanggal_datang', TRUE),
                'tanggal_distribusi' => $this->input->post('tanggal_distribusi', TRUE),
                'waktu' => $this->input->post('waktu', TRUE),
                'status' => $this->input->post('status', TRUE),
                'bap' => $bap
            );

            $this->MTransaksi->insert($data);
            $this->session->set_flashdata('message', 'Data Transaksi berhasil disimpan');
            redirect(site_url('transaksi'));
        }
    }

    public function update($id)
    {
        $row = $this->MTransaksi->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('transaksi/update_action'),
                'id' => set_value('id', $row->id),
                'kode_barang' => set_value('kode_barang', $row->kode_barang),
                'nomor_anggota' => set_value('nomor_anggota', $row->nomor_anggota),
                'jumlah_barang' => set_value('jumlah_barang', $row->jumlah_barang),
                'tanggal_datang' => set_value('tanggal_datang', $row->tanggal_datang),
                'tanggal_distribusi' => set_value('tanggal_distribusi', $row->tanggal_distribusi),
                'waktu' => set_value('waktu', $row->waktu),
                'status' => set_value('status', $row->status),
            );

            $data['page'] = 'transaksi/transaksi_form';
            $data['barang'] = $this->db->get('barang')->result();
            $this->load->view('template', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Transaksi tidak ditemukan');
            redirect(site_url('transaksi'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'kode_barang' => $this->input->post('kode_barang', TRUE),
                'nomor_anggota' => $this->input->post('nomor_anggota', TRUE),
                'jumlah_barang' => $this->input->post('jumlah_barang', TRUE),
                'tanggal_datang' => $this->input->post('tanggal_datang', TRUE),
                'tanggal_distribusi' => $this->input->post('tanggal_distribusi', TRUE),
                'waktu' => $this->input->post('waktu', TRUE),
                'status' => $this->input->post('status', TRUE),
            );

            $this->MTransaksi->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Data Transaksi berhasil disimpan');
            redirect(site_url('transaksi'));
        }
    }

    public function delete($id)
    {
        $row = $this->MTransaksi->get_by_id($id);

        if ($row) {
            $this->MTransaksi->delete($id);
            $this->session->set_flashdata('message', 'Data Tranasksi berhasil dihapus');
            redirect(site_url('transaksi'));
        } else {
            $this->session->set_flashdata('message', 'Data Transaksi tidak ditemukan');
            redirect(site_url('transaksi'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
        $this->form_validation->set_rules('nomor_anggota', 'nomor anggota', 'trim|required');
        $this->form_validation->set_rules('jumlah_barang', 'Jumlah Barang', 'trim|required');
        $this->form_validation->set_rules('tanggal_datang', 'tanggal datang', 'trim|required');
        $this->form_validation->set_rules('tanggal_distribusi', 'tanggal distribusi', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "transaksi.xls";
        $judul = "transaksi";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Kode Barang");
        xlsWriteLabel($tablehead, $kolomhead++, "Nomor Anggota");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Datang");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Distribusi");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");

        foreach ($this->MTransaksi->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->kode_barang);
            xlsWriteLabel($tablebody, $kolombody++, $data->nomor_anggota);
            xlsWriteLabel($tablebody, $kolombody++, $data->jumlah_barang);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_datang);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_distribusi);
            xlsWriteLabel($tablebody, $kolombody++, $data->status);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function laporan()
    {
        $pdf = new FPDF();

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(180, 10, 'Laporan Data Barang', 1, 1, 'C');
        $pdf->Output();
    }

    public function approval($id = null, $approval = 0)
    {
        $this->db->where('id', $id);
        $this->db->update('transaksi', [
            'approval' => $approval
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }
}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-05-29 15:33:49 */
/* http://harviacode.com */