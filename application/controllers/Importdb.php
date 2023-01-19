<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Importdb extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mimport');
        if ($this->session->userdata('login') != TRUE) {
            redirect(base_url());
        }
    }

    public function index() {
        if ($this->session->userdata('admin') == TRUE) {
            if($this->input->post('nama_file')){
                $path_to_file = './import/import_report_tagih.txt';
                $config['upload_path']          = './import/';
                $config['allowed_types']        = 'txt';
                $config['file_name']            = 'import_report_tagih';
                $config['overwrite']			= true;

                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('berkas')){
                    $this->session->set_flashdata('flash3','( .txt )');
                    redirect(base_url('importDB/report_tagih'));
                }else{
                    $this->upload->data("file_name");
                    $this->load->view('import');
                }
            }else{
                $this->load->view('import');
            }
        } else {
            redirect(base_url());
        }
    }

    public function update(){
        if($this->input->post('isi')=="                        "){
            $this->session->set_flashdata('flash4','Mengimport');
            redirect(base_url('importDB/report_tagih'));
        }elseif($this->input->post('isi')==""){
            $this->session->set_flashdata('flash4','Mengimport');
            redirect(base_url('importDB/report_tagih'));
        }else{
            $keterangan="";

            $arr_isi = explode("\r\n", $this->input->post('isi'));
            $jum_baris=count($arr_isi);
            $jum_baris= $jum_baris-1;
            for($a=0;$a<$jum_baris;$a++){

            $daftar = explode("\r\n", $this->input->post('isi'));
            $daftardata = $daftar[$a];

            $daftarisi = explode(",", $daftardata);
            $no = $daftarisi[0];
            $noid = $daftarisi[1];
            $prog = $daftarisi[2];
            $jumlah = $daftarisi[3];
            $kwitansi = $daftarisi[4];
            $tanggal = $daftarisi[5];
            $jenis = $daftarisi[6];
            $kosong1 = $daftarisi[7];
            $noslip = $daftarisi[8];
            $bulan = $daftarisi[9];
            $tahun = $daftarisi[10];
            $idtagih = $daftarisi[11];
            $stop = $daftarisi[12];
            $start = $daftarisi[13];
            $kosong2 = $daftarisi[14];
            $kodej = substr($daftarisi[15],0,4);

            foreach($this->mimport->cekIDTwo($noid,$bulan,$tahun,$noslip) as $tampil){
                $cekDT = $tampil->tgh;
            }
            foreach($this->mimport->cekID($idtagih,$noid,$bulan,$tahun,$noslip) as $tampil){
                if($tampil->tgh > 0){
                }elseif($cekDT > 0){
                }else{
                    $this->mimport->insertData($no,$noid,$prog,$jumlah,$kwitansi,$tanggal,$jenis,$kosong1,$noslip,$bulan,$tahun,$idtagih,$stop,$start,$kosong2,$kodej);
                    $keterangan="berhasil";
                    
                }
            }

        }
        if($keterangan=="berhasil"){
            $this->session->set_flashdata('flash','Dijalankan');
            redirect(base_url('importDB/report_tagih'));
        }else{
            $this->session->set_flashdata('flash2','Ada');
            redirect(base_url('importDB/report_tagih'));
        }


        }
    }

    public function keu_j(){
        if ($this->session->userdata('admin') == TRUE) {
            if($this->input->post('nama_file')){
                $path_to_file = './import/import_keu_j.txt';
                $config['upload_path']          = './import/';
                $config['allowed_types']        = 'txt';
                $config['file_name']            = 'import_keu_j';
                $config['overwrite']			= true;

                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('berkas')){
                    $this->session->set_flashdata('flash3','( .txt )');
                    redirect(base_url('importDB/keu_j'));
                }else{
                    $this->upload->data("file_name");
                    $this->load->view('import_keu');
                }
            }else{
                $this->load->view('import_keu');
            }
        } else {
            redirect(base_url());
        }
    }


    public function updateKeu(){
        if($this->input->post('isi')=="                        "){
            $this->session->set_flashdata('flash4','Mengimport');
            redirect(base_url('importDB/keu_j'));
        }elseif($this->input->post('isi')==""){
            $this->session->set_flashdata('flash4','Mengimport');
            redirect(base_url('importDB/keu_j'));
        }else{
            $keterangan="";

            $arr_isi = explode("\r\n", $this->input->post('isi'));
            $jum_baris=count($arr_isi);
            $jum_baris= $jum_baris-1;
            for($a=0;$a<$jum_baris;$a++){

            $daftar = explode("\r\n", $this->input->post('isi'));
            $daftardata = $daftar[$a];

            $daftarisi = explode(",", $daftardata);
            $pegawai = $daftarisi[0];
            $prog = $daftarisi[1];
            $jml = $daftarisi[2];
            $noslip = $daftarisi[3];
            $tgl = $daftarisi[4];
            $validasi = substr($daftarisi[5],0,1);

            foreach($this->mimport->cekIDkeu($prog,$noslip) as $tampil){
                if($tampil->tgh > 0){
                }else{
                    $this->mimport->insertDataKeu($pegawai,$prog,$jml,$noslip,$tgl,$validasi);
                    $keterangan="berhasil";
                    
                }
            }

        }
        if($keterangan=="berhasil"){
            $this->session->set_flashdata('flash','Dijalankan');
            redirect(base_url('importDB/keu_j'));
        }else{
            $this->session->set_flashdata('flash2','Ada');
            redirect(base_url('importDB/keu_j'));
        }


        }
    }

}
?>