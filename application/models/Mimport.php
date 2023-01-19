<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mimport extends CI_Model {

    public function insertData($no,$noid,$prog,$jumlah,$kwitansi,$tanggal,$jenis,$kosong1,$noslip,$bulan,$tahun,$idtagih,$stop,$start,$kosong2,$kodej){
        $object = array(
            'noid' => $noid,
            'kodej' => $kodej,
            'prog' => $prog,
            'tanggal' => $tanggal,
            'jumlah' => $jumlah,
            'kwitansi' => $kwitansi,
            'jenis' => $jenis,
            'noslip' => $noslip,
            'start' => $start,
            'stop' => $stop,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'id_tagihan' => $idtagih

        );
        $this->db->insert('report_tagih', $object);
    }

    public function insertDataKeu($pegawai,$prog,$jml,$noslip,$tgl,$validasi){
        $object = array(
            'entr_pegawai' => $pegawai,
            'prog' => $prog,
            'jml' => $jml,
            'noslip' => $noslip,
            'tgl_input' => $tgl,
            'validasi' => $validasi,

        );
        $this->db->insert('keu_j', $object);
    }

    public function cekID($idtagih,$noid,$bulan,$tahun,$noslip){
        $this->db->select('id_tagihan,count(id_tagihan) as tgh');
        $this->db->from('report_tagih');
        $this->db->where('id_tagihan',$idtagih);
        $this->db->where('noid',$noid);
        $this->db->where('bulan',$bulan);
        $this->db->where('tahun',$tahun);
        $this->db->where('noslip',$noslip);
        $this->db->where('device_id','');
        return $this->db->get()->result();
    }

    public function cekIDTwo($noid,$bulan,$tahun,$noslip){
        $this->db->select('id_tagihan,count(id_tagihan) as tgh');
        $this->db->from('report_tagih');
        $this->db->where('noid',$noid);
        $this->db->where('bulan',$bulan);
        $this->db->where('tahun',$tahun);
        $this->db->where('noslip',$noslip);
        $this->db->where('device_id','');
        return $this->db->get()->result();
    }

    public function cekIDkeu($prog,$noslip){
        $this->db->select('id,count(id) as tgh');
        $this->db->from('keu_j');
        $this->db->where('prog',$prog);
        $this->db->where('noslip',$noslip);
        return $this->db->get()->result();
    }

}
?>