<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang extends CI_Controller
{
    function __construct()
    {
        Parent::__construct();
        $this->load->model(array('MBarang', 'MKategori'));
        $this->load->library('form_validation');
    }

    public function index($kondisi = null, $kategori_id = null)
    {

        $data['kategori_id'] = $kategori_id;
        $data['list_kategori'] = $this->db->get('kategori')->result();
        $this->db->select("*, kategori.nama AS nama_kategori, barang.nama AS nama_barang, barang.id AS id_barang");
        if ($kondisi) {
            $this->db->where("kondisi", $kondisi);
            $data['kondisi'] = $kondisi;
        } else {
            $data['kondisi'] = null;
        }


        $this->db->join("kategori", "kategori.id = barang.kategori_id");
        $this->db->join("lokasi", "lokasi.id = barang.id_lokasi");
        $this->db->where('is_active', 1);
        $this->db->where('barang.deleted_at', null);
        $data['barangs'] = $this->db->get("barang")->result_array();

        // $this->db->select("*, kategori.nama AS nama_kategori, barang.nama AS nama_barang, barang.id AS id_barang");
        // $this->db->join("kategori", "kategori.id = barang.kategori_id");
        // $this->db->join("lokasi", "lokasi.id = barang.id_lokasi");
        // $this->db->where('is_active', 1);
        // $this->db->where('barang.deleted_at', null);
        // $this->db->where("kategori_id", 1);
        // $data['kiba'] = $this->db->get("barang")->result_array();
        // $this->db->select("*, kategori.nama AS nama_kategori, barang.nama AS nama_barang, barang.id AS id_barang");
        // $this->db->join("kategori", "kategori.id = barang.kategori_id");
        // $this->db->join("lokasi", "lokasi.id = barang.id_lokasi");
        // $this->db->where('is_active', 1);
        // $this->db->where('barang.deleted_at', null);
        // $this->db->where("kategori_id", 2);
        // $data['kibb'] = $this->db->get("barang")->result_array();
        // $this->db->select("*, kategori.nama AS nama_kategori, barang.nama AS nama_barang, barang.id AS id_barang");
        // $this->db->join("kategori", "kategori.id = barang.kategori_id");
        // $this->db->join("lokasi", "lokasi.id = barang.id_lokasi");
        // $this->db->where('is_active', 1);
        // $this->db->where('barang.deleted_at', null);
        // $this->db->where("kategori_id", 3);
        // $data['kibc'] = $this->db->get("barang")->result_array();
        // $this->db->select("*, kategori.nama AS nama_kategori, barang.nama AS nama_barang, barang.id AS id_barang");
        // $this->db->join("kategori", "kategori.id = barang.kategori_id");
        // $this->db->join("lokasi", "lokasi.id = barang.id_lokasi");
        // $this->db->where('is_active', 1);
        // $this->db->where('barang.deleted_at', null);
        // $this->db->where("kategori_id", 4);
        // $data['kibd'] = $this->db->get("barang")->result_array();
        // $this->db->select("*, kategori.nama AS nama_kategori, barang.nama AS nama_barang, barang.id AS id_barang");
        // $this->db->join("kategori", "kategori.id = barang.kategori_id");
        // $this->db->join("lokasi", "lokasi.id = barang.id_lokasi");
        // $this->db->where('is_active', 1);
        // $this->db->where('barang.deleted_at', null);
        // $this->db->where("kategori_id", 5);
        // $data['kibe'] = $this->db->get("barang")->result_array();
        // $this->db->select("*, kategori.nama AS nama_kategori, barang.nama AS nama_barang, barang.id AS id_barang");
        // $this->db->join("kategori", "kategori.id = barang.kategori_id");
        // $this->db->join("lokasi", "lokasi.id = barang.id_lokasi");
        // $this->db->where('is_active', 1);
        // $this->db->where('barang.deleted_at', null);
        // $this->db->where("kategori_id", 6);
        // $data['kibf'] = $this->db->get("barang")->result_array();
        // $this->db->select("*, kategori.nama AS nama_kategori, barang.nama AS nama_barang, barang.id AS id_barang");
        // $this->db->join("kategori", "kategori.id = barang.kategori_id");
        // $this->db->join("lokasi", "lokasi.id = barang.id_lokasi");
        // $this->db->where('barang.deleted_at', null);
        // $this->db->where('is_active', 1);
        // $this->db->where("kategori_id", 7);
        // $data['kibg'] = $this->db->get("barang")->result_array();
        // if ($data) {
        // }

        $data['page'] = 'barang/barang_list';
        $this->load->view('template', $data);
        //$this->load->view('barang/barang_list', $data);
    }

    public function barang_list()
    {
        $kondisi = $this->input->post('kondisi');
        $kategori_id = $this->input->post('kategori_id');

        $this->db->select("*, kategori.nama AS nama_kategori, barang.nama AS nama_barang, barang.id AS id_barang");
        if ($kondisi) {
            $this->db->where('kondisi', $kondisi);
        }
        if ($kategori_id) {
            $this->db->where('kategori_id', $kategori_id);
        }
        $this->db->join("kategori", "kategori.id = barang.kategori_id");
        $this->db->join("lokasi", "lokasi.id = barang.id_lokasi");
        $this->db->where('is_active', 1);
        $this->db->where('barang.deleted_at', null);
        $data['barangs'] = $this->db->get("barang")->result_array();

        $data['kondisi'] = $kondisi;
        $data['kategori'] = $this->db->get_where('kategori', ['id' => $kategori_id])->row();
        $data['kategori_id'] = $kategori_id;
        $this->load->view('barang/list', $data);
    }

    public function cetak()
    {
        $this->db->select("*, kategori.nama AS nama_kategori, barang.nama AS nama_barang, barang.id AS id_barang");
        $this->db->join("kategori", "kategori.id = barang.kategori_id");
        $this->db->join("lokasi", "lokasi.id = barang.id_lokasi");
        $this->db->where('is_active', 1);
        $this->db->where('barang.deleted_at', null);
        $data['barangs'] = $this->db->get("barang")->result_array();

        $data['page'] = 'barang/barang_print';
        $this->load->view('print_template', $data);
    }

    public function read($id)
    {
        $row = $this->MBarang->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'nama' => $row->nama,
                'jenis' => $row->jenis,
                'kode' => $row->kode,
                'kategori_id' => $row->kategori_id,
            );
            $data['page'] = 'barang/barang_read';
            $this->load->view('template', $data);
            //$this->load->view('barang/barang_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Barang tidak ditemukan');
            redirect(site_url('barang'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('barang/create_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
            'jenis' => set_value('jenis'),
            'kondisi' => set_value('kondisi'),
            'keterangan' => set_value('keterangan'),
            'kode' => set_value('kode'),
            'kategori_id' => set_value('kategori_id'),
            'tanggal_pengadaan' => set_value('tanggal_pengadaan'),
            'id_lokasi' => set_value('id_lokasi'),
        );
        //mengambil data kategori buku
        $data['list_kategori'] = $this->MKategori->get_all();
        $this->db->where('lokasi.deleted_at', null);
        $data['list_lokasi'] = $this->db->get('lokasi')->result();
        $data['page'] = 'barang/barang_form';
        $this->load->view('template', $data);
        //$this->load->view('barang/barang_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $upload_gambar = $_FILES['gambar']['name'];
            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
                $config['upload_path'] = './assets/img/barang';
                $config['max_size']     = '2048';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar')) {
                    $new_gambar = $this->upload->data('file_name');
                    $data = array(
                        'nama' => $this->input->post('nama', TRUE),
                        // 'jenis' => $this->input->post('jenis', TRUE),
                        'kode' => $this->input->post('kode', TRUE),
                        'kategori_id' => $this->input->post('kategori_id', TRUE),
                        'kondisi' => $this->input->post('kondisi', TRUE),
                        'keterangan' => $this->input->post('keterangan', TRUE),
                        'tanggal_pengadaan' => $this->input->post('tanggal_pengadaan', TRUE),
                        'id_lokasi' => $this->input->post('id_lokasi', TRUE),
                        'gambar' => $new_gambar
                    );

                    $this->MBarang->insert($data);
                    $this->session->set_flashdata('message', 'Data Barang berhasil dibuat');
                } else {
                    $this->session->set_flashdata('flash_error', 'Gambar Tidak Sesuai ketentuan');
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . 'Gambar Tidak Sesuai ketentuan' . '</div>');
                }
            } else {
                $this->session->set_flashdata('flash_gagal', 'Gambar Barang Wajib diupload!');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
					Gambar Produk Wajib diupload!
					</div>');
            }
            redirect(site_url('barang'));
        }
    }

    public function update($id)
    {
        $row = $this->MBarang->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('barang/update_action'),
                'id' => set_value('id', $row->id),
                'nama' => set_value('nama', $row->nama),
                'jenis' => set_value('jenis', $row->jenis),
                'kondisi' => set_value('kondisi', $row->kondisi),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'kode' => set_value('kode', $row->kode),
                'kategori_id' => set_value('kategori_id', $row->kategori_id),
                'tanggal_pengadaan' => set_value('tanggal_pengadaan', $row->tanggal_pengadaan),
                'id_lokasi' => set_value('id_lokasi', $row->id_lokasi),
                'list_kategori' => $this->db->query("SELECT * FROM kategori")->result()

            );

            $this->db->where('lokasi.deleted_at', null);
            $data['list_lokasi'] = $this->db->get('lokasi')->result();
            $data['page'] = 'barang/barang_form';
            $this->load->view('template', $data);
            //$this->load->view('barang/barang_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Data Barang Tidak ditemukan');
            redirect(site_url('barang'));
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
                // 'jenis' => $this->input->post('jenis', TRUE),
                'kode' => $this->input->post('kode', TRUE),
                'kategori_id' => $this->input->post('kategori_id', TRUE),
                'kondisi' => $this->input->post('kondisi', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
                'id_lokasi' => $this->input->post('id_lokasi', TRUE),
                'tanggal_pengadaan' => $this->input->post('tanggal_pengadaan', TRUE),
            );
            $upload_gambar = $_FILES['gambar']['name'];
            if ($upload_gambar) {
                $config['allowed_types'] = 'gif|jpg|png|svg|jpeg';
                $config['upload_path'] = './assets/img/barang';
                $config['max_size']     = '2048';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar')) {
                    $old_gambar = $data['user']['gambar'];
                    if ($old_gambar != 'barang.jpg') {
                        unlink(FCPATH . 'assets/img/barang/' . $old_gambar);
                    }
                    $new_gambar = $this->upload->data('file_name');
                    $this->db->set('gambar', $new_gambar);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . 'Gambar Tidak Sesuai ketentuan' . '</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }

            $this->MBarang->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Data Barang telah disimpan');
            redirect(site_url('barang'));
        }
    }

    public function delete($id)
    {
        $row = $this->MBarang->get_by_id($id);

        if ($row) {
            $this->MBarang->delete($id);
            $this->session->set_flashdata('message', 'Data Barang berhasil dihapus');
            redirect(site_url('barang'));
        } else {
            $this->session->set_flashdata('message', 'Data Barang Tidak ditemukan');
            redirect(site_url('barang'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        // $this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
        $this->form_validation->set_rules('kode', 'kode', 'trim|required');
        $this->form_validation->set_rules('kategori_id', 'kategori id', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "barang.xls";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis");
        xlsWriteLabel($tablehead, $kolomhead++, "Kode");
        xlsWriteLabel($tablehead, $kolomhead++, "Kategori Id");

        foreach ($this->MBarang->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis);
            xlsWriteLabel($tablebody, $kolombody++, $data->kode);
            xlsWriteNumber($tablebody, $kolombody++, $data->kategori_id);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }



    function barcode()
    {
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        echo $generator->getBarcode('aa11', $generator::TYPE_CODE_128);
    }
}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-05-29 15:33:03 */
/* http://harviacode.com */