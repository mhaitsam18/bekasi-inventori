<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MBarang extends CI_Model
{

    public $table = 'barang';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get_where($this->table, ['is_active' => 1])->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->where('is_active', 1);
        return $this->db->get($this->table)->row();
    }

    function get_join_by_id_lokasi($id_kartu_inventaris_barang, $id_kategori = null)
    {

        $this->db->select('*, barang.id AS id_barang, kategori.id AS id_kategori, kategori.nama AS nama_kategori, barang.nama AS nama_barang, kartu_inventaris_barang.id AS id_kartu_inventaris_barang');
        $this->db->join('pengesahan_barang', 'pengesahan_barang.id_barang = barang.id');
        $this->db->join('kartu_inventaris_barang', 'pengesahan_barang.id_kartu_inventaris_barang = kartu_inventaris_barang.id');

        $this->db->join('kategori', 'kategori.id = barang.kategori_id');
        $this->db->join('lokasi', 'lokasi.id = barang.id_lokasi');
        $this->db->join('kecamatan', 'kecamatan.id = lokasi.id_kecamatan');

        if ($id_kategori) {
            $this->db->where('kategori_id', $id_kategori);
        }
        return $this->db->get_where($this->table, [
            'pengesahan_barang.id_kartu_inventaris_barang' => $id_kartu_inventaris_barang,
            // 'is_active' => 1,
        ])->result();
    }

    function get_inventaris_barang($id_lokasi, $id_kategori = null, $periode = null, $index = null)
    {
        $tahun = date('Y');

        $this->db->select('MIN(tanggal_pengadaan) AS tanggal_awal');
        // $this->db->join('pengesahan_barang', 'pengesahan_barang.id_barang = barang.id');
        // $this->db->join('kartu_inventaris_barang', 'pengesahan_barang.id_kartu_inventaris_barang = kartu_inventaris_barang.id');

        $this->db->join('kategori', 'kategori.id = barang.kategori_id');
        $this->db->join('lokasi', 'lokasi.id = barang.id_lokasi');

        if ($id_kategori) {
            $this->db->where('kategori_id', $id_kategori);
        }
        $tanggal_awal = $this->db->get_where($this->table, [
            'barang.id_lokasi' => $id_lokasi,
            'is_inventaris' => 1,
        ])->row()->tanggal_awal;

        $this->db->select('*, barang.id AS id_barang, kategori.id AS id_kategori, kategori.nama AS nama_kategori, barang.nama AS nama_barang');
        // $this->db->join('pengesahan_barang', 'pengesahan_barang.id_barang = barang.id');
        // $this->db->join('kartu_inventaris_barang', 'pengesahan_barang.id_kartu_inventaris_barang = kartu_inventaris_barang.id');

        $this->db->join('kategori', 'kategori.id = barang.kategori_id');
        $this->db->join('lokasi', 'lokasi.id = barang.id_lokasi');
        $this->db->join('kecamatan', 'kecamatan.id = lokasi.id_kecamatan');

        if ($id_kategori) {
            $this->db->where('kategori_id', $id_kategori);
        }
        switch ($periode) {
            case 'triwulan':
                switch ($index) {
                    case 1:
                        $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
                        $this->db->where('MONTH(tanggal_pengadaan) >=', 1);
                        $this->db->where('MONTH(tanggal_pengadaan) <=', 3);
                        break;
                    case 2:
                        $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
                        $this->db->where('MONTH(tanggal_pengadaan) >=', 4);
                        $this->db->where('MONTH(tanggal_pengadaan) <=', 6);
                        break;
                    case 3:
                        $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
                        $this->db->where('MONTH(tanggal_pengadaan) >=', 7);
                        $this->db->where('MONTH(tanggal_pengadaan) <=', 9);
                        break;
                    case 4:
                        $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
                        $this->db->where('MONTH(tanggal_pengadaan) >=', 10);
                        $this->db->where('MONTH(tanggal_pengadaan) <=', 12);
                        break;
                }
                break;
            case 'semester':
                switch ($index) {
                    case 1:
                        $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
                        $this->db->where('MONTH(tanggal_pengadaan) >=', 1);
                        $this->db->where('MONTH(tanggal_pengadaan) <=', 6);
                        break;
                    case 2:
                        $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
                        $this->db->where('MONTH(tanggal_pengadaan) >=', 7);
                        $this->db->where('MONTH(tanggal_pengadaan) <=', 12);
                        break;
                }
                break;
            case 'tahunan':
                $tahun = $index;
                $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
                break;
        }
        // if ($periode == 'triwulan') {
        //     switch ($index) {
        //         case 1:
        //             $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
        //             $this->db->where('MONTH(tanggal_pengadaan) >=', 1);
        //             $this->db->where('MONTH(tanggal_pengadaan) <=', 3);
        //             break;
        //         case 2:
        //             $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
        //             $this->db->where('MONTH(tanggal_pengadaan) >=', 4);
        //             $this->db->where('MONTH(tanggal_pengadaan) <=', 6);
        //             break;
        //         case 3:
        //             $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
        //             $this->db->where('MONTH(tanggal_pengadaan) >=', 7);
        //             $this->db->where('MONTH(tanggal_pengadaan) <=', 9);
        //             break;
        //         case 4:
        //             $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
        //             $this->db->where('MONTH(tanggal_pengadaan) >=', 10);
        //             $this->db->where('MONTH(tanggal_pengadaan) <=', 12);
        //             break;
        //     }
        // } elseif ($periode == 'semester') {
        //     switch ($index) {
        //         case 1:
        //             $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
        //             $this->db->where('MONTH(tanggal_pengadaan) >=', 1);
        //             $this->db->where('MONTH(tanggal_pengadaan) <=', 6);
        //             break;
        //         case 2:
        //             $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
        //             $this->db->where('MONTH(tanggal_pengadaan) >=', 7);
        //             $this->db->where('MONTH(tanggal_pengadaan) <=', 12);
        //             break;
        //     }
        // } elseif ($periode == 'tahunan') {
        //     $tahun = $index;
        //     $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
        // }
        return $this->db->get_where($this->table, [
            'barang.id_lokasi' => $id_lokasi,
            'is_inventaris' => 1,
        ])->result();
    }
    function get_kib($id_lokasi, $id_kategori = null, $periode = null, $index = null)
    {
        $tahun = date('Y');

        if ($periode == null || $periode == "semua") {
            $this->db->select("kategori.id AS id_kategori, kategori.kib AS kib, YEAR(barang.tanggal_pengadaan) AS tahun, '' AS periode, '' AS indeks, kartu_inventaris_barang.kode_pengesahan, kartu_inventaris_barang.status_pengesahan");
        } elseif ($periode == "triwulan") {
            switch ($index) {
                case '1':
                    $this->db->select("kategori.id AS id_kategori, kategori.kib AS kib, YEAR(barang.tanggal_pengadaan) AS tahun, 'Triwulan' AS periode, '$index' AS indeks, kartu_inventaris_barang.kode_pengesahan, kartu_inventaris_barang.status_pengesahan");
                    break;
                case '2':
                    $this->db->select("kategori.id AS id_kategori, kategori.kib AS kib, YEAR(barang.tanggal_pengadaan) AS tahun, 'Triwulan' AS periode, '$index' AS indeks, kartu_inventaris_barang.kode_pengesahan, kartu_inventaris_barang.status_pengesahan");
                    break;
                case '3':
                    $this->db->select("kategori.id AS id_kategori, kategori.kib AS kib, YEAR(barang.tanggal_pengadaan) AS tahun, 'Triwulan' AS periode, '$index' AS indeks, kartu_inventaris_barang.kode_pengesahan, kartu_inventaris_barang.status_pengesahan");
                    break;
                case '4':
                    $this->db->select("kategori.id AS id_kategori, kategori.kib AS kib, YEAR(barang.tanggal_pengadaan) AS tahun, 'Triwulan' AS periode, '$index' AS indeks, kartu_inventaris_barang.kode_pengesahan, kartu_inventaris_barang.status_pengesahan");
                    break;
                default:
                    $this->db->select("kategori.id AS id_kategori, kategori.kib AS kib, YEAR(barang.tanggal_pengadaan) AS tahun, 'Triwulan' AS periode, IF(MONTH(barang.tanggal_pengadaan)<=3, 1, IF(MONTH(barang.tanggal_pengadaan)<=6, 2, IF(MONTH(barang.tanggal_pengadaan)<=9, 3, 4))) AS indeks, kartu_inventaris_barang.kode_pengesahan, kartu_inventaris_barang.status_pengesahan");
                    break;
            }
        } elseif ($periode == "semester") {
            switch ($index) {
                case '1':
                    $this->db->select("kategori.id AS id_kategori, kategori.kib AS kib, YEAR(barang.tanggal_pengadaan) AS tahun, 'Semester' AS periode, '$index' AS indeks, kartu_inventaris_barang.kode_pengesahan, kartu_inventaris_barang.status_pengesahan");
                    break;
                case '2':
                    $this->db->select("kategori.id AS id_kategori, kategori.kib AS kib, YEAR(barang.tanggal_pengadaan) AS tahun, 'Semester' AS periode, '$index' AS indeks, kartu_inventaris_barang.kode_pengesahan, kartu_inventaris_barang.status_pengesahan");
                    break;
                default:
                    $this->db->select("kategori.id AS id_kategori, kategori.kib AS kib, YEAR(barang.tanggal_pengadaan) AS tahun, 'Semester' AS periode, IF(MONTH(barang.tanggal_pengadaan)<=6,1,2) AS indeks, kartu_inventaris_barang.kode_pengesahan, kartu_inventaris_barang.status_pengesahan");
                    break;
            }
        } elseif ($periode == "tahunan") {
            if ($index && $index != "NaN") {
                $this->db->select("kategori.id AS id_kategori, kategori.kib AS kib, YEAR(barang.tanggal_pengadaan) AS tahun, 'Tahun' AS periode, '$index' AS indeks, kartu_inventaris_barang.kode_pengesahan, kartu_inventaris_barang.status_pengesahan");
            } else {
                $this->db->select("kategori.id AS id_kategori, kategori.kib AS kib, YEAR(barang.tanggal_pengadaan) AS tahun, 'Tahun' AS periode, YEAR(barang.tanggal_pengadaan) AS indeks, kartu_inventaris_barang.kode_pengesahan, kartu_inventaris_barang.status_pengesahan");
            }
        }
        $this->db->distinct();
        // $this->db->join('kartu_inventaris_barang', 'pengesahan_barang.id_kartu_inventaris_barang = kartu_inventaris_barang.id');

        $this->db->join('barang', 'kategori.id = barang.kategori_id');
        $this->db->join('lokasi', 'lokasi.id = barang.id_lokasi');
        $this->db->join('kecamatan', 'kecamatan.id = lokasi.id_kecamatan');
        $this->db->join('pengesahan_barang', 'pengesahan_barang.id_barang = barang.id');
        $this->db->join('kartu_inventaris_barang', 'pengesahan_barang.id_kartu_inventaris_barang = kartu_inventaris_barang.id');

        if ($id_kategori) {
            $this->db->where('kategori_id', $id_kategori);
        }
        switch ($periode) {
            case 'triwulan':
                switch ($index) {
                    case 1:
                        $this->db->where('MONTH(tanggal_pengadaan) >=', 1);
                        $this->db->where('MONTH(tanggal_pengadaan) <=', 3);
                        break;
                    case 2:
                        $this->db->where('MONTH(tanggal_pengadaan) >=', 4);
                        $this->db->where('MONTH(tanggal_pengadaan) <=', 6);
                        break;
                    case 3:
                        $this->db->where('MONTH(tanggal_pengadaan) >=', 7);
                        $this->db->where('MONTH(tanggal_pengadaan) <=', 9);
                        break;
                    case 4:
                        $this->db->where('MONTH(tanggal_pengadaan) >=', 10);
                        $this->db->where('MONTH(tanggal_pengadaan) <=', 12);
                        break;
                }
                break;
            case 'semester':
                switch ($index) {
                    case 1:
                        $this->db->where('MONTH(tanggal_pengadaan) >=', 1);
                        $this->db->where('MONTH(tanggal_pengadaan) <=', 6);
                        break;
                    case 2:
                        $this->db->where('MONTH(tanggal_pengadaan) >=', 7);
                        $this->db->where('MONTH(tanggal_pengadaan) <=', 12);
                        break;
                }
                break;
            case 'tahunan':
                if ($index && $index != "NaN") {
                    $tahun = $index;
                    $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
                }
                break;
        }
        $this->db->order_by('kategori.kib');
        return $this->db->get_where("kategori", [
            'barang.id_lokasi' => $id_lokasi,
            'is_inventaris' => 1,
        ])->result();
    }

    function get_non_inventaris_barang($id_lokasi, $id_kategori = null, $periode = null, $index = null)
    {
        $tahun = date('Y');
        $this->db->select('*, barang.id AS id_barang, kategori.id AS id_kategori, kategori.nama AS nama_kategori, barang.nama AS nama_barang');
        $this->db->join('kategori', 'kategori.id = barang.kategori_id');
        $this->db->join('lokasi', 'lokasi.id = barang.id_lokasi');
        $this->db->join('kecamatan', 'kecamatan.id = lokasi.id_kecamatan');

        if ($id_kategori) {
            $this->db->where('kategori_id', $id_kategori);
        }
        if ($periode) {
            switch ($periode) {
                case 'triwulan':
                    switch ($index) {
                        case 1:
                            $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
                            $this->db->where('MONTH(tanggal_pengadaan) >=', 1);
                            $this->db->where('MONTH(tanggal_pengadaan) <=', 3);
                            break;
                        case 2:
                            $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
                            $this->db->where('MONTH(tanggal_pengadaan) >=', 4);
                            $this->db->where('MONTH(tanggal_pengadaan) <=', 6);
                            break;
                        case 3:
                            $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
                            $this->db->where('MONTH(tanggal_pengadaan) >=', 7);
                            $this->db->where('MONTH(tanggal_pengadaan) <=', 9);
                            break;
                        case 4:
                            $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
                            $this->db->where('MONTH(tanggal_pengadaan) >=', 10);
                            $this->db->where('MONTH(tanggal_pengadaan) <=', 12);
                            break;
                    }
                    break;
                case 'semester':
                    switch ($index) {
                        case 1:
                            $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
                            $this->db->where('MONTH(tanggal_pengadaan) >=', 1);
                            $this->db->where('MONTH(tanggal_pengadaan) <=', 6);
                            break;
                        case 2:
                            $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
                            $this->db->where('MONTH(tanggal_pengadaan) >=', 7);
                            $this->db->where('MONTH(tanggal_pengadaan) <=', 12);
                            break;
                    }
                    break;
                case 'tahunan':
                    $tahun = $index;
                    $this->db->where('YEAR(tanggal_pengadaan)', $tahun);
                    break;
            }
        }
        return $this->db->get_where($this->table, [
            'barang.id_lokasi' => $id_lokasi,
            'is_inventaris' => 0,
        ])->result();
    }
    function get_data_tahun($id_lokasi, $id_kategori = null)
    {

        $this->db->select('DISTINCT(YEAR(tanggal_pengadaan)) AS tahun');
        $this->db->join('kategori', 'kategori.id = barang.kategori_id');
        $this->db->join('lokasi', 'lokasi.id = barang.id_lokasi');
        $this->db->join('kecamatan', 'kecamatan.id = lokasi.id_kecamatan');

        if ($id_kategori) {
            $this->db->where('kategori_id', $id_kategori);
        }
        return $this->db->get_where($this->table, [
            'barang.id_lokasi' => $id_lokasi,
            'is_inventaris' => 0,
        ])->result();
    }

    function get_kartu_inventaris_barang($id_kartu_inventaris_barang)
    {
        return $this->db
            ->select('*, kartu_inventaris_barang.id AS id_kartu_inventaris_barang')
            ->join('lokasi', 'lokasi.id=kartu_inventaris_barang.id_lokasi')
            ->join('kecamatan', 'kecamatan.id=lokasi.id_kecamatan')
            // ->join('user', 'user.id=kartu_inventaris_barang.id_camat')
            // ->where('is_active', 1)
            ->get_where('kartu_inventaris_barang', [
                'kartu_inventaris_barang.id' => $id_kartu_inventaris_barang
            ])->row();
    }

    function get_barang_by_lokasi($id_lokasi)
    {
        return $this->db
            ->select('*')
            ->join('lokasi', 'lokasi.id=barang.id_lokasi')
            ->join('kecamatan', 'kecamatan.id=lokasi.id_kecamatan')
            // ->join('user', 'user.id=kartu_inventaris_barang.id_camat')
            // ->where('is_active', 1)
            ->get_where('barang', [
                'lokasi.id' => $id_lokasi
            ])->row();
    }

    public function getBarang($id_barang = null)
    {
        $this->db->select('barang.*, lokasi.nama_lokasi AS nama_lokasi, barang.nama AS nama_barang, kategori.nama AS nama_kategori');
        $this->db->from('barang');
        $this->db->join('lokasi', 'lokasi.id = barang.id_lokasi');
        $this->db->join('kategori', 'kategori.id = barang.kategori_id');
        $this->db->where('barang.id', $id_barang);
        return $this->db->get();
    }


    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('jenis', $q);
        $this->db->or_like('kode', $q);
        $this->db->or_like('kategori_id', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        // Join tabel dengan tabel kategori
        $this->db->select('b.*, k.nama');
        $this->db->from('barang b');
        $this->db->join('kategori k', 'k.id = b.kategori_id');

        $this->db->order_by('b.id', $this->order);
        $this->db->like('b.id', $q);
        $this->db->or_like('b.nama', $q);
        $this->db->or_like('b.jenis', $q);
        $this->db->or_like('b.kode', $q);
        $this->db->or_like('b.kategori_id', $q);
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    function insertPengesahanBarang($id_kartu_inventaris_barang, $id_lokasi)
    {
        $barang = $this->db->get_where('barang', [
            'id_lokasi' => $id_lokasi,
            'is_active' => 1,
            'is_inventaris' => 1,
        ])->result();
        foreach ($barang as $key) {
            $this->db->insert('pengesahan_barang', [
                'id_barang' => $key->id,
                'id_kartu_inventaris_barang' => $id_kartu_inventaris_barang
            ]);
        }
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        $this->db->where('id_lokasi', $data['id_lokasi']);
        $this->db->update('kartu_inventaris_barang', ['is_valid' => 0]);
        $this->db->insert('kartu_inventaris_barang', [
            'id_lokasi' => $data['id_lokasi'],
            'id_staff' => $this->session->userdata('id')
        ]);
        $this->insertPengesahanBarang($this->db->insert_id(), $data['id_lokasi']);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);

        $this->db->where('id_lokasi', $data['id_lokasi']);
        $this->db->update('kartu_inventaris_barang', ['is_valid' => 0]);
        $this->db->insert('kartu_inventaris_barang', [
            'id_lokasi' => $data['id_lokasi'],
            'id_staff' => $this->session->userdata('id')
        ]);
        $this->insertPengesahanBarang($this->db->insert_id(), $data['id_lokasi']);
    }

    // delete data
    function delete($id)
    {
        $data = $this->db->get_where($this->table, ['id' => $id])->row_array();
        $this->db->where($this->id, $id);
        $this->db->update($this->table, ['is_active' => 0]);

        $this->db->where($this->id, $id);
        $this->db->update($this->table, ['deleted_at' => date('Y-m-d H:i:s')]);
        $this->db->insert('sampah', [
            'tabel' => $this->table,
            'id_subjek' => $id
        ]);


        $this->db->where('id_lokasi', $data['id_lokasi']);
        $this->db->update('kartu_inventaris_barang', ['is_valid' => 0]);
        $this->db->insert('kartu_inventaris_barang', [
            'id_lokasi' => $data['id_lokasi'],
            'id_staff' => $this->session->userdata('id')
        ]);
        $this->insertPengesahanBarang($this->db->insert_id(), $data['id_lokasi']);
    }
}

/* End of file MBarang.php */
/* Location: ./application/models/MBarang.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-05-29 15:33:03 */
/* http://harviacode.com */