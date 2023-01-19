<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms_donatur extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Msms_donatur');
        $this->load->library('form_validation');
        if ($this->session->userdata('login') != TRUE) {
            redirect(base_url());
        }
    }

    public function index() {
        if ($this->session->userdata('superadmin') == TRUE) {
          $data['jungut']=$this->Msms_donatur->getAll();
          $data['hasil']=$this->Msms_donatur->search();
          $data['draft']=$this->Msms_donatur->draft();
          $this->load->view('sms_donatur',$data);
        }
    }

    public function getKawasanJ()
    {
        $where = array(
            'kodejgt' => $this->input->get('kodej')
        );
        $data = $this->db->get_where('kawasan', $where)->result();
        echo json_encode($data);
    }

    public function draft(){
        $where = array(
            'sms_id' => $this->input->get('sms_id')
        );
        $data = $this->db->get_where('sms_donatur_draft', $where )->result();
        echo json_encode($data);
    }

    public function kirim(){
        if ($this->input->post('isisms') == "") {
            
        }elseif ($this->input->post('isisms')) {
            $status= "";
            $long = explode(",", $this->input->post('notelp'));
            $jum_baris=count($long);

            for($a=0;$a<$jum_baris;$a++){
                $tlp = explode(",", $this->input->post('notelp'));
                $nama = explode(",", $this->input->post('nama'));
                $noid = explode(",", $this->input->post('noid'));
                $tlp = $tlp[$a];
                $isi = $this->input->post('isisms');
                $judul = $this->input->post('judul');
                date_default_timezone_set('Asia/Jakarta');
                $tanggal = date('Y-m-d H:i:s');
                if($noid[$a] == ""){
                    $noid = "";
                }else {
                    $noid = $noid[$a];
                }
                if($nama[$a] == ""){
                    $nama = "";
                }else {
                    $nama = $nama[$a];
                }
                $flag = "NULL";
                $status= "berhasil";
                $this->Msms_donatur->save($noid,$nama,$tanggal,$tlp,$isi,$flag,$judul);
                
            }

            if($status == "berhasil"){
                redirect(base_url('kirim-sms-donatur'));
            }
        }
    }

}

 ?>
