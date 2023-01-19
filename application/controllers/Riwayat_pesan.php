<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat_pesan extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Mriwayat');
	}

	public function index() {
		$data['riwayat'] = $this->db->get('sms_donatur')->result_array();
		$this->load->view('riwayat_pesan', $data);
	}
}