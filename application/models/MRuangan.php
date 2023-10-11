<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MRuangan extends CI_Model
{

    public $table = 'ruangan';
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
        $this->db->where('is_active', 1);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->where('is_active', 1);
        return $this->db->get($this->table)->row();
    }

    function get_join_by_id_lokasi($id_kartu_inventaris_ruangan)
    {

        $this->db->select('*, ruangan.id AS id_ruangan, kartu_inventaris_ruangan.id AS id_kartu_inventaris_ruangan');
        $this->db->join('pengesahan_ruangan', 'pengesahan_ruangan.id_ruangan = ruangan.id');
        $this->db->join('kartu_inventaris_ruangan', 'pengesahan_ruangan.id_kartu_inventaris_ruangan = kartu_inventaris_ruangan.id');

        $this->db->join('lokasi', 'lokasi.id = ruangan.id_lokasi');
        $this->db->join('kecamatan', 'kecamatan.id = lokasi.id_kecamatan');
        // $this->db->where('is_active', 1);
        return $this->db->get_where($this->table, [
            'pengesahan_ruangan.id_kartu_inventaris_ruangan' => $id_kartu_inventaris_ruangan
        ])->result();
    }

    function get_kartu_inventaris_ruangan($id_kartu_inventaris_ruangan)
    {
        return $this->db
            ->select('*, kartu_inventaris_ruangan.id AS id_kartu_inventaris_ruangan')
            ->join('lokasi', 'lokasi.id=kartu_inventaris_ruangan.id_lokasi')
            ->join('kecamatan', 'kecamatan.id=lokasi.id_kecamatan')
            // ->join('user', 'user.id=kartu_inventaris_ruangan.id_camat')
            // ->where('is_active', 1)
            ->get_where('kartu_inventaris_ruangan', [
                'kartu_inventaris_ruangan.id' => $id_kartu_inventaris_ruangan
            ])->row();
    }


    // get total rows
    // function total_rows($q = NULL)
    // {
    //     $this->db->like('id', $q);
    //     $this->db->or_like('nama', $q);
    //     $this->db->or_like('jenis', $q);
    //     $this->db->or_like('kode', $q);
    //     $this->db->or_like('kategori_id', $q);
    //     $this->db->from($this->table);
    //     return $this->db->count_all_results();
    // }

    // // get data with limit and search
    // function get_limit_data($limit, $start = 0, $q = NULL)
    // {
    //     // Join tabel dengan tabel kategori
    //     $this->db->select('b.*, k.nama');
    //     $this->db->from('ruangan b');
    //     $this->db->join('kategori k', 'k.id = b.kategori_id');

    //     $this->db->order_by('b.id', $this->order);
    //     $this->db->like('b.id', $q);
    //     $this->db->or_like('b.nama', $q);
    //     $this->db->or_like('b.jenis', $q);
    //     $this->db->or_like('b.kode', $q);
    //     $this->db->or_like('b.kategori_id', $q);
    //     $this->db->limit($limit, $start);
    //     return $this->db->get()->result();
    // }

    // insert data

    function insertPengesahanRuangan($id_kartu_inventaris_ruangan, $id_lokasi)
    {
        $ruangan = $this->db->get_where('ruangan', [
            'id_lokasi' => $id_lokasi,
            'is_active' => 1
        ])->result();
        foreach ($ruangan as $key) {
            $this->db->insert('pengesahan_ruangan', [
                'id_ruangan' => $key->id,
                'id_kartu_inventaris_ruangan' => $id_kartu_inventaris_ruangan
            ]);
        }
    }

    function insert($data)
    {
        $this->db->insert($this->table, $data);
        $this->db->where('id_lokasi', $data['id_lokasi']);
        $this->db->update('kartu_inventaris_ruangan', ['is_valid' => 0]);
        $this->db->insert('kartu_inventaris_ruangan', ['id_lokasi' => $data['id_lokasi']]);
        $this->insertPengesahanRuangan($this->db->insert_id(), $data['id_lokasi']);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);

        $this->db->where('id_lokasi', $data['id_lokasi']);
        $this->db->update('kartu_inventaris_ruangan', ['is_valid' => 0]);
        $this->db->insert('kartu_inventaris_ruangan', ['id_lokasi' => $data['id_lokasi']]);
        $this->insertPengesahanRuangan($this->db->insert_id(), $data['id_lokasi']);
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
        $this->db->update('kartu_inventaris_ruangan', ['is_valid' => 0]);
        $this->db->insert('kartu_inventaris_ruangan', ['id_lokasi' => $data['id_lokasi']]);
        $this->insertPengesahanRuangan($this->db->insert_id(), $data['id_lokasi']);
    }
}

/* End of file Mruangan.php */
/* Location: ./application/models/Mruangan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-05-29 15:33:03 */
/* http://harviacode.com */