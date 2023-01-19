<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Valkasir extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mpage');
        $this->load->model('mvalkasir');
        if ($this->session->userdata('login') != TRUE) {
            redirect(base_url());
        }
    }

    public function index() {
        if ($this->session->userdata('admin') == TRUE) {
            if ($this->session->userdata('hak') == '0' || $this->session->userdata('hak') == '3') {
                if ($this->session->userdata('superadmin') == TRUE) {
                    $data['jungut'] = $this->mpage->getAll();
                } else if ($this->session->userdata('superadmin') != TRUE && $this->session->userdata('admin_cabang') == TRUE) {
                    $data['jungut'] = $this->mpage->getAllTwo($this->session->userdata('idcab'));
                } else if ($this->session->userdata('admin_grup') == TRUE) {
                    $data['jungut'] = $this->mpage->getAllFour($this->session->userdata('idgrup'));
                }
                $data['BANK'] = $this->mvalkasir->getBank();
                $this->load->view('validasi_kasir', $data);
            }
        } else {
            redirect(base_url());
        }
    }

    public function getData() {
        $tgl = explode(' - ', $this->input->get('date'));
        // $this->session->set_userdata('tgl', $this->input->get('date'));
        $this->session->set_userdata('kodej', $this->input->get('kodej'));
        // if ($this->input->get('kodej') == '-') {
        //     $data = $this->mvalkasir->getValidasiAll($tgl[0],$tgl[1]);
        //     foreach($data as $value) {
        //         $value->kwitansi = $this->mvalkasir->checkKwitansi($value->noslip);
        //     }
        // } else {
            $data = $this->mvalkasir->getValidasi($this->input->get('kodej'), $tgl[0],$tgl[1]);
            foreach($data as $value) {
                $value->kwitansi = $this->mvalkasir->checkKwitansi($value->noslip);
            }
        // }
        echo json_encode($data);
    }

    // public function getDntQrbn() {
    //     $data = $this->mvalkasir->getDntQrbn($this->input->get('noslip')); 
    //     // echo $this->input->get('noslip');
    //     // echo "<pre>";
    //     // print_r($data);
    //     // echo "</pre>";return;
    //     echo json_encode($data);
    // }

    // public function addVal($noslip = null) {
    //     if ($this->session->userdata('admin') == TRUE) {
    //         if ($this->session->userdata('hak') == '0' || $this->session->userdata('hak') == '3') {
    //             if (!isset($noslip)) redirect(base_url('report/validasi'));
    //             $object = array(
    //                 "bank" => $this->input->post('bank'),
    //                 "no_kasir" => $this->input->post('noksr'),
    //                 "ket" => $this->input->post('ket'),
    //                 "validasi" => "y"
    //             );
    //             $where = array(
    //                 "noslip" => $noslip
    //             );
    //             $this->mvalkasir->addVal($object, $where);
    //         }
    //     } else {
    //         redirect(base_url());
    //     }
    // }

    // public function addDntQrbn() {
    //     $qrbn = $this->mvalkasir->getDntQrbn($this->input->get('noslip'));
    //     foreach ($qrbn as $value) {
    //         $date = date_create($value->tanggal);
    //         $dnt = array(
    //             "noid" => $value->noid,
    //             "nama" => $value->nama,
    //             "almktr" => $value->almktr,
    //             "telphp" => $value->telphp,
    //             "kwsn" => $value->kwsn,
    //             "kodej" => $value->kodej,
    //             "tanggal" => $date->format('Y-m-d'),
    //             "prog" => $value->prog,
    //             "noslip" => $value->noslip,
    //             "jumlah" => $value->jumlah,
    //             "report_id" => $value->report_id,
    //             "ket" => $value->ket
    //         );
    //         // print_r($dnt);
    //         $data = $this->mvalkasir->addDntQrbn($dnt);  
    //     } 
    //     // echo json_encode($data);
    // }

    public function updateVal() {
        $where = array(
            "noslip" => $this->input->post('noslip')
        );

        $object = array(
            "bank" => $this->input->post('bank'),
            "ket" => $this->input->post('ket'),
            "no_kasir" => $this->input->post('noksr'),
            "tgl_val" => date('Y-m-d'),
            "idusr_v" => $this->session->userdata('usrid'),
            "validasi" => 'y'
        );

        $qrbn = $this->mvalkasir->getDntQrbn($this->input->post('noslip'));
        foreach ($qrbn as $value) {
            $date = date_create($value->tanggal);
            $dnt = array(
                "noid" => $value->noid,
                "nama" => $value->nama,
                "almktr" => $value->almktr,
                "telphp" => $value->telphp,
                "kwsn" => $value->kwsn,
                "kodej" => $value->kodej,
                "tanggal" => $date->format('Y-m-d'),
                "prog" => $value->prog,
                "noslip" => $value->noslip,
                "jumlah" => $value->jumlah,
                "report_id" => $value->report_id,
                "ket" => $value->ket
            );
            $this->mvalkasir->addDntQrbn($dnt);  
        } 
        
        $data = $this->mvalkasir->addVal($object, $where);
        echo json_encode($data);
    }

    public function cetakKasir($noslip) {
        if ($this->session->userdata('admin') == TRUE) {
            if ($this->session->userdata('hak') == '0' || $this->session->userdata('hak') == '3') {
                $data['data'] = array(
                    "title" => "BUKTI SETORAN ZIS",
                    "subtitle" => "",
                    "cek" => 0
                );
                $data['petugas'] = $this->mvalkasir->getPetugas($noslip);
                $data['petugas2'] = $this->mvalkasir->getPetugas2($noslip);
                $data['jumlah'] = $this->mvalkasir->getJml($noslip);
                $this->load->view('rekap_validasi_kasir', $data); 
            }
        } else {
            redirect(base_url());
        }
    }

    public function cetakBatal($noslip) {
        if ($this->session->userdata('admin') == TRUE) {
            if ($this->session->userdata('hak') == '0' || $this->session->userdata('hak') == '3') {
                $data['data'] = array(
                    "title" => "BUKTI SETORAN ZIS",
                    "subtitle" => "Setelah Terkoreksi",
                    "cek" => 1
                );
                $data['petugas'] = $this->mvalkasir->getPetugas($noslip);
                $data['petugas2'] = $this->mvalkasir->getPetugas2($noslip);
                $data['jumlah'] = $this->mvalkasir->getJml($noslip);
                $this->load->view('rekap_validasi_kasir', $data); 
            }
        } else {
            redirect(base_url());
        }
    }

    public function cetakKlaim($noslip) {
        if ($this->session->userdata('admin') == TRUE) {
            if ($this->session->userdata('hak') == '0' || $this->session->userdata('hak') == '3') {
                $data['data'] = array(
                    "title" => "BUKTI KLAIM ZIS",
                    "subtitle" => "",
                    "cek" => 1
                );
                $data['petugas'] = $this->mvalkasir->getPetugas($noslip);
                $data['petugas2'] = $this->mvalkasir->getPetugas2($noslip);
                $data['jumlah'] = $this->mvalkasir->getJml($noslip);
                $this->load->view('rekap_validasi_kasir', $data); 
            }
        } else {
            redirect(base_url());
        }
    }

}

/* End of file Valkasir.php */
