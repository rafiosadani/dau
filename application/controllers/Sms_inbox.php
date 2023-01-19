<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms_inbox extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('msms_inbox');
        if ($this->session->userdata('login') != TRUE) {
            redirect(base_url());
        }
    }

    public function index() {
        if ($this->session->userdata('superadmin') == TRUE) {
          $this->load->view('sms_inbox');
        }
    }

    public function getData(){
      $tgl = explode(' - ', $this->input->get('date'));
      $data = $this->msms_inbox->getSms($tgl[0],$tgl[1]);
      echo json_encode($data);
    }

}

 ?>
