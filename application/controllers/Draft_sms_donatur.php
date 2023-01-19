<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Draft_sms_donatur extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Mdraft_donatur');
	}

	public function index() {
		$data['draft'] = $this->Mdraft_donatur->getAllDraft();
		$this->load->view('draft_sms_donatur', $data);
	}

	public function baru() {
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('isi', 'Isi SMS', 'required|max_length[160]');

		if($this->form_validation->run() == FALSE) {
			$this->load->view('add_draft');
		} else {
			$this->Mdraft_donatur->addDraft();
			redirect('draft-sms-donatur');
		}
	}

	public function edit($id) {
		$data['draft'] = $this->Mdraft_donatur->getElementById($id);
		$this->load->view('edit_draft', $data);
	}

	public function update() {
		$this->form_validation->set_rules('judul', 'Judul', 'required');
		$this->form_validation->set_rules('isi', 'Isi SMS', 'required|max_length[160]');

		if($this->form_validation->run() == FALSE) {
			$this->load->view('edit_draft');
		} else {
			$this->Mdraft_donatur->updateDraft();
			redirect('draft-sms-donatur');
		}
	}

	public function delete($id) {
		$this->Mdraft_donatur->deleteDraft($id);
		redirect('draft-sms-donatur');
	}
}