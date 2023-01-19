<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perolehan_manager extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mpage');
        $this->load->model('mperolehan_manager');
        if ($this->session->userdata('login') != TRUE) {
            redirect(base_url());
        }
    }

    public function index() {
        if ($this->session->userdata('admin') == TRUE) {
          if ($this->session->userdata('superadmin') == TRUE) {
              $data['jungut'] = $this->mpage->getAll();
          } else if ($this->session->userdata('superadmin') != TRUE && $this->session->userdata('admin_cabang') == TRUE) {
              $idCabang = $this->session->userdata('idcab');
              $data['jungut'] = $this->mpage->getJgtCabang($idCabang);
          } else if ($this->session->userdata('admin_grup') == TRUE) {
              $idGrup = $this->session->userdata('idgrup');
              $data['jungut'] = $this->mpage->getJgtGrup($idGrup);
          }
            $this->load->view('perolehan_manager',$data);
        } else {
            redirect(base_url());
        }
    }

    public function cetak(){
      if ($this->input->post('kodej') && $this->input->post('date')) {
        $tanggal = explode(" - ", $this->input->post('date'));
        $data['date'] = array(
            'tanggal1' => $tanggal[0],
            'tanggal2' => $tanggal[1]
        );
        $data['count'] = $this->mperolehan_manager->getCount();
        $data['prl'] = $this->mperolehan_manager->getPrltot();
        $data['staf'] = $this->mperolehan_manager->getStaf($this->input->post('kodej'));
        $data['jumlah'] = $this->mperolehan_manager->getJumlah($tanggal[0], $tanggal[1]);
        //$data['ptgs'] = $this->mpage->getPtgs();

        $this->load->view('rekap_perolehan_manager', $data);
      }
    }
  }

 ?>
