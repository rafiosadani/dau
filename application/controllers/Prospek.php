<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Prospek extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mprospek');
        if ($this->session->userdata('login') != TRUE) {
            redirect(base_url());
        }
    }

    public function index() {
        if ($this->session->userdata('admin') == TRUE) {
            if ($this->session->userdata('superadmin') == TRUE) {
                $data['prospek'] = $this->mprospek->getProspek();
                $this->load->view('prospek',$data);
            }
        } else {
            redirect(base_url());
        }
	}
	
	public function baru(){
		if ($this->session->userdata('admin') == TRUE) {
			if ($this->session->userdata('superadmin') == TRUE) {
				if ($this->input->post('prospek') && $this->input->post('info')) {
                    $this->mprospek->insertProspek();
                    redirect(base_url('setup/prospek'));
				}else{
					$data['lastid'] = $this->mprospek->Lastid();
					$this->load->view('add_prospek',$data);
				}
			}
		}else{
			redirect(base_url());
		}
    }

    public function edit($info=null){
        if ($this->session->userdata('admin') == TRUE) {
			if ($this->session->userdata('superadmin') == TRUE) {
                $where = array('INFO' => $this->input->post('info'));
				if ($this->input->post('prospek') && $this->input->post('info')) {
                    $this->mprospek->editProspek($where);
                    redirect(base_url('setup/prospek'));
				}else{
					$data['prospek'] = $this->mprospek->prospek($info);
					$this->load->view('edit_prospek',$data);
				}
			}
		}else{
			redirect(base_url());
		}
    }

    public function deleteProspek($info = null) {
        if (!isset($info)) show_404();

        if ($this->mprospek->deleteProspek($info)) {
            redirect(base_url('setup/prospek'));
        }
    }

}
 ?>
