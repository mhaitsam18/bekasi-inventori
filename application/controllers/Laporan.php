<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        Parent::__construct();
        $this->load->model('MBarang');
        $this->load->model('MRuangan');
        $this->load->model('MTransaksi');
    }
    public function index()
    {
        // if($this->session->hak_akses == 'admin'){
        // $data['transaksi_data'] = $this->db->query("SELECT *,transaksi.id as id,barang.id as id_barang FROM transaksi INNER JOIN barang ON transaksi.kode_barang = barang.kode WHERE status = 'datang'")->result();
        // }else{
        // $data['transaksi_data'] = $this->db->query("SELECT *,transaksi.id as id,barang.id as id_barang FROM transaksi INNER JOIN barang ON transaksi.kode_barang = barang.kode WHERE nomor_anggota = '".$this->session->nomor_anggota."'")->result();
        // }
        // $data['page'] = 'transaksi/transaksi_list';
        // $this->load->view('template', $data);
    }

    public function barang()
    {
        $this->load->view('template', [
            'page' => 'laporan/lokasi-barang',
            'data_lokasi' =>
            $this->db
                ->select('*, kartu_inventaris_barang.id AS id_kartu_inventaris_barang, lokasi.id AS lokasi_id')
                ->join('kecamatan', 'kecamatan.id=lokasi.id_kecamatan')
                ->join('kartu_inventaris_barang', 'kartu_inventaris_barang.id_lokasi=lokasi.id', 'left')
                ->get_where('lokasi', ['kartu_inventaris_barang.is_valid' => 1])->result(),
        ]);
    }

    public function pilih_periode($id_lokasi = null, $id_kategori = null)
    {
        $this->load->view('template', [
            'page' => 'laporan/pilih-periode',
            'lokasi' =>  $this->MBarang->get_barang_by_lokasi($id_lokasi),
            'id_lokasi' =>  $id_lokasi,
            'data_barang' => $this->MBarang->get_non_inventaris_barang($id_lokasi, $id_kategori),
            'data_inventaris' => $this->MBarang->get_inventaris_barang($id_lokasi, $id_kategori),
        ]);
    }
    public function pilih_triwulan($id_lokasi = null, $id_kategori = null)
    {
        $this->load->view('template', [
            'page' => 'laporan/pilih-triwulan',
            'lokasi' =>  $this->MBarang->get_barang_by_lokasi($id_lokasi),
            'id_lokasi' =>  $id_lokasi,
            'data_barang' => $this->MBarang->get_non_inventaris_barang($id_lokasi, $id_kategori),
            'data_inventaris' => $this->MBarang->get_inventaris_barang($id_lokasi, $id_kategori),
        ]);
    }
    public function pilih_semester($id_lokasi = null, $id_kategori = null)
    {
        $this->load->view('template', [
            'page' => 'laporan/pilih-semester',
            'lokasi' =>  $this->MBarang->get_barang_by_lokasi($id_lokasi),
            'id_lokasi' =>  $id_lokasi,
            'data_barang' => $this->MBarang->get_non_inventaris_barang($id_lokasi, $id_kategori),
            'data_inventaris' => $this->MBarang->get_inventaris_barang($id_lokasi, $id_kategori),
        ]);
    }
    public function pilih_tahun($id_lokasi = null, $id_kategori = null)
    {
        $this->load->view('template', [
            'page' => 'laporan/pilih-tahun',
            'lokasi' =>  $this->MBarang->get_barang_by_lokasi($id_lokasi),
            'id_lokasi' =>  $id_lokasi,
            'data_tahun' => $this->MBarang->get_data_tahun($id_lokasi, $id_kategori),
            'data_barang' => $this->MBarang->get_non_inventaris_barang($id_lokasi, $id_kategori),
            'data_inventaris' => $this->MBarang->get_inventaris_barang($id_lokasi, $id_kategori),
        ]);
    }
    public function kelola_barang($id_lokasi = null, $id_kategori = null)
    {
        if (!empty($this->input->get('periode'))) {
            $periode = $this->input->get('periode');
        } else {
            $periode = "all";
        }
        if (!empty($this->input->get('index'))) {
            $index = $this->input->get('index');
        } else {
            $index = "all";
        }
        $this->load->view('template', [
            'page' => 'laporan/kelola-inventaris-barang',
            'periode' => $periode,
            'id_kategori' => $id_kategori,
            'id_lokasi' => $id_lokasi,
            'index' => $index,
            'lokasi' =>  $this->MBarang->get_barang_by_lokasi($id_lokasi),
            'data_tahun' => $this->MBarang->get_data_tahun($id_lokasi, $id_kategori),
            'data_barang' => $this->MBarang->get_non_inventaris_barang($id_lokasi, $id_kategori, $periode, $index),
            'data_inventaris' => $this->MBarang->get_inventaris_barang($id_lokasi, $id_kategori, $periode, $index),
        ]);
    }

    public function list_index()
    {
        $periode = $this->input->post("periode");
        $id_lokasi = $this->input->post("id_lokasi");
        if ($this->input->post("id_kategori")) {
            $id_kategori = $this->input->post("id_kategori");
        } else {
            $id_kategori = null;
        }
        if ($this->input->post("id_kartu_inventaris_barang")) {
            $id_kartu_inventaris_barang = $this->input->post("id_kartu_inventaris_barang");
        } else {
            $id_kartu_inventaris_barang = null;
        }

        $this->load->view('laporan/opsi-index', [
            'periode' => $periode,
            'id_lokasi' => $id_lokasi,
            'id_kategori' => $id_kategori,
            'id_kartu_inventaris_barang' => $id_kartu_inventaris_barang,
            'data_tahun' => $this->MBarang->get_data_tahun($id_lokasi, $id_kategori),
        ]);
    }
    public function list_barang()
    {
        $periode = $this->input->post("periode");
        $index = $this->input->post("index");
        $id_lokasi = $this->input->post("id_lokasi");
        if ($this->input->post("id_kategori")) {
            $id_kategori = $this->input->post("id_kategori");
        } else {
            $id_kategori = null;
        }
        $this->load->view('laporan/opsi-barang', [
            'periode' => $periode,
            'lokasi' =>  $this->MBarang->get_barang_by_lokasi($id_lokasi),
            'id_lokasi' => $id_lokasi,
            'id_kategori' => $id_kategori,
            'data_barang' => $this->MBarang->get_non_inventaris_barang($id_lokasi, $id_kategori, $periode, $index),
        ]);
    }

    public function tabel_barang()
    {
        $periode = $this->input->post("periode");
        $index = $this->input->post("index");
        $id_lokasi = $this->input->post("id_lokasi");
        if ($this->input->post("id_kategori")) {
            $id_kategori = $this->input->post("id_kategori");
        } else {
            $id_kategori = null;
        }
        $this->load->view('laporan/tabel-barang', [
            'periode' => $periode,
            'index' => $index,
            'id_lokasi' => $id_lokasi,
            'id_kategori' => $id_kategori,
            'lokasi' =>  $this->MBarang->get_barang_by_lokasi($id_lokasi),
            'data_tahun' => $this->MBarang->get_data_tahun($id_lokasi, $id_kategori),
            'data_barang' => $this->MBarang->get_non_inventaris_barang($id_lokasi, $id_kategori),
            'data_inventaris' => $this->MBarang->get_inventaris_barang($id_lokasi, $id_kategori, $periode, $index),
        ]);
    }

    public function checkBarang()
    {
        $barang = $this->MBarang->getBarang($this->input->get('id_barang'))->row_array();
        echo json_encode($barang);
    }

    public function tambah_inventaris_barang()
    {
        $this->db->where('id', $this->input->post('id_barang'));
        $this->db->update('barang', ['is_inventaris' => 1]);

        $this->db->where('id_lokasi', $this->input->post('id_lokasi'));
        $this->db->update('kartu_inventaris_barang', ['is_valid' => 0]);
        $this->db->insert('kartu_inventaris_barang', [
            'id_lokasi' => $this->input->post('id_lokasi'),
            'id_staff' => $this->session->userdata('id')
        ]);
        $this->MBarang->insertPengesahanBarang($this->input->post('id_barang'), $this->input->post('id_lokasi'));

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Inventaris berhasil ditambahkan
            </div>');
        $id_lokasi = $this->input->post('id_lokasi');
        $periode = $this->input->post('periode');
        $index = $this->input->post('index');
        $bulan = date("m", strtotime($this->input->post('tanggal_pengadaan')));
        $tahun = date("Y", strtotime($this->input->post('tanggal_pengadaan')));
        if ($periode == "triwulan") {
            if ($bulan <= 3) {
                $index = 1;
            } elseif ($bulan <= 6) {
                $index = 2;
            } elseif ($bulan <= 9) {
                $index = 3;
            } elseif ($bulan <= 12) {
                $index = 4;
            }
        } elseif ($periode == "semester") {
            if ($bulan <= 6) {
                $index = 1;
            } elseif ($bulan <= 12) {
                $index = 2;
            }
        } elseif ($periode == "tahunan") {
            $index = $tahun;
        }
        redirect("laporan/kelola_barang/$id_lokasi?periode=$periode&index=$index");
    }

    public function hapus_inventaris_barang($id_barang = null)
    {
        $this->db->where('id', $id_barang);
        $this->db->update('barang', ['is_inventaris' => 0]);
        $barang = $this->db->get_where('barang', ['id' => $id_barang])->row();

        $this->db->where('id_lokasi', $barang->id_lokasi);
        $this->db->update('kartu_inventaris_barang', ['is_valid' => 0]);
        $this->db->insert('kartu_inventaris_barang', [
            'id_lokasi' => $barang->id_lokasi,
            'id_staff' => $this->session->userdata('id')
        ]);
        $this->MBarang->insertPengesahanBarang($id_barang, $barang->id_lokasi);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data Inventaris berhasil dihapus
            </div>');
        $id_lokasi = $barang->id_lokasi;
        $periode = $this->input->get('periode');
        $index = $this->input->get('index');
        redirect("laporan/kelola_barang/$id_lokasi?periode=$periode&index=$index");
    }

    public function kartuInventarisBarang($id_kartu_inventaris_barang = null, $id_kategori = null)
    {
        $inventaris = $this->db->get_where('kartu_inventaris_barang', ['id' => $id_kartu_inventaris_barang])->row();
        if ($this->input->get('periode')) {
            $periode = $this->input->get('periode');
        } else {
            $periode = null;
        }
        if ($this->input->get('index')) {
            $index = $this->input->get('index');
        } else {
            $index = null;
        }
        $this->load->view('template', [
            'page' => 'laporan/kartu-inventaris-barang',
            'lokasi' =>  $this->MBarang->get_kartu_inventaris_barang($id_kartu_inventaris_barang),
            'data_barang' => $this->MBarang->get_inventaris_barang($inventaris->id_lokasi, $id_kategori, $periode, $index),
        ]);
    }

    public function menuKartuInventarisBarang($id_kartu_inventaris_barang = null)
    {
        $this->load->view('template', [
            'page' => 'laporan/menu-barang',
            'id_kartu_inventaris_barang' =>  $id_kartu_inventaris_barang,
            'kategori' => $this->db->get('kategori')->result(),
        ]);
    }

    public function ruangan()
    {
        $this->load->view('template', [
            'page' => 'laporan/lokasi-ruangan',
            'data_lokasi' =>
            $this->db
                ->select('*, kartu_inventaris_ruangan.id AS id_kartu_inventaris_ruangan')
                ->join('lokasi', 'lokasi.id=kartu_inventaris_ruangan.id_lokasi')
                ->join('kecamatan', 'kecamatan.id=lokasi.id_kecamatan')
                ->get_where('kartu_inventaris_ruangan', [
                    'is_valid' => 1
                ])->result(),
        ]);
    }

    public function kartuInventarisRuangan($id_kartu_inventaris_ruangan = null)
    {
        $this->load->view('template', [
            'page' => 'laporan/kartu-inventaris-ruangan',
            'lokasi' =>  $this->MRuangan->get_kartu_inventaris_ruangan($id_kartu_inventaris_ruangan),
            'data_ruangan' => $this->MRuangan->get_join_by_id_lokasi($id_kartu_inventaris_ruangan),
        ]);
    }

    public function TutupKartuInventarisBarang($id_kartu_inventaris_barang = null)
    {
        $this->db->where('id', $id_kartu_inventaris_barang);
        $this->db->update('kartu_inventaris_barang', [
            'closed_at' => date("Y-m-d H:i:s")
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }
    public function TutupKartuInventarisRuangan($id_kartu_inventaris_ruangan = null)
    {
        $this->db->where('id', $id_kartu_inventaris_ruangan);
        $this->db->update('kartu_inventaris_ruangan', [
            'closed_at' => date("Y-m-d H:i:s")
        ]);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function kategoriKartuInventarisBarang($id_kartu_inventaris_barang = null, $id_lokasi = null, $id_kategori = null)
    {
        if (!empty($this->input->get('periode'))) {
            $periode = $this->input->get('periode');
        } else {
            $periode = "semua";
        }
        if (!empty($this->input->get('index'))) {
            $index = $this->input->get('index');
        } else {
            $index = null;
        }
        if ($this->input->get('id_lokasi')) {
            $id_lokasi = $this->input->get('id_lokasi');
        }
        if ($this->input->get('id_kategori')) {
            $id_kategori = $this->input->get('id_kategori');
        }
        $kode_pengesahan = $this->db->get_where('kartu_inventaris_barang', ['id' => $id_kartu_inventaris_barang])->row()->kode_pengesahan;
        $this->load->view('template', [
            'page' => 'laporan/kategori-kib',
            'periode' => $periode,
            'id_kartu_inventaris_barang' => $id_kartu_inventaris_barang,
            'kode_pengesahan' => $kode_pengesahan,
            'id_lokasi' => $id_lokasi,
            'id_kategori' => $id_kategori,
            'index' => $index,
            'data_kategori' => $this->db->get('kategori')->result(),
            'data_inventaris' => $this->MBarang->get_kib($id_lokasi, $id_kategori, $periode, $index),
        ]);
    }
    public function tabel_kib()
    {
        if (!empty($this->input->post('periode')) && $this->input->post('periode') != "NaN") {
            $periode = $this->input->post('periode');
        } else {
            $periode = "semua";
        }
        if (!empty($this->input->post('index')) && $this->input->post('index') != "NaN") {
            $index = $this->input->post('index');
        } else {
            $index = null;
        }
        if (!empty($this->input->post('id_lokasi')) && $this->input->post('id_lokasi') != "NaN") {
            $id_lokasi = $this->input->post('id_lokasi');
        } else {
            $id_lokasi = null;
        }
        if (!empty($this->input->post('id_kategori')) && $this->input->post('id_kategori') != "NaN") {
            $id_kategori = $this->input->post('id_kategori');
        } else {
            $id_kategori = null;
        }
        if (!empty($this->input->post('id_kartu_inventaris_barang')) && $this->input->post('id_kartu_inventaris_barang') != "NaN") {
            $id_kartu_inventaris_barang = $this->input->post('id_kartu_inventaris_barang');
        } else {
            $id_kartu_inventaris_barang = null;
        }
        $this->load->view('laporan/tabel-kib', [
            'periode' => $periode,
            'id_lokasi' => $id_lokasi,
            'id_kategori' => $id_kategori,
            'id_kartu_inventaris_barang' => $id_kartu_inventaris_barang,
            'index' => $index,
            'data_kategori' => $this->db->get('kategori')->result(),
            'data_inventaris' => $this->MBarang->get_kib($id_lokasi, $id_kategori, $periode, $index),
        ]);
    }
}
