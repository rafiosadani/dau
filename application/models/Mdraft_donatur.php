<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdraft_donatur extends CI_Model {

	public function getAllDraft() {
		return $this->db->get('sms_donatur_draft')->result_array();
	}

	public function getElementById($id) {
		return $this->db->get_where('sms_donatur_draft', ['sms_id' => $id])->row_array();
	}

	public function addDraft() {
		$data = [
			'judul' => $this->input->post('judul'),
			'isi_sms' => $this->input->post('isi')
		];

		$this->db->insert('sms_donatur_draft', $data);
	}

	public function updateDraft() {
		$data = [
			'judul' => $this->input->post('judul'),
			'isi_sms' => $this->input->post('isi')
		];

		$this->db->where('sms_id', $this->input->post('id'));
		$this->db->update('sms_donatur_draft', $data);
	}

	public function deleteDraft($id) {
		$this->db->delete('sms_donatur_draft', ['sms_id' => $id]);
	}
}