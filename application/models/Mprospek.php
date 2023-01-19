<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Mprospek extends CI_Model {

	private $table = "info";
 
	public function getProspek(){
		$this->db->select('*');
		$this->db->from('info');
		return $this->db->get()->result();
	}
  
	public function Lastid(){
		$this->db->select('*');
		$this->db->from('info');
		$this->db->order_by('INFO',desc);
		$this->db->limit('1');
		return $this->db->get()->result();
	}
	
	public function insertProspek(){
		$object = array(
			'INFO'        => $this->input->post('info'),
			'NM_INFO'        => $this->input->post('prospek'),
		);
		$this->db->insert('info', $object);
	}

	public function editProspek($where){
		$object = array(
			'INFO'        => $this->input->post('info'),
			'NM_INFO'        => $this->input->post('prospek'),
		);
		return $this->db->update('info', $object, $where);
	}

	public function deleteProspek($info){
		return $this->db->delete($this->table, array("INFO"=> $info));
	}

	public function prospek($info){
		$this->db->select('*');
		$this->db->from('info');
		$this->db->where('INFO',$info);
		return $this->db->get()->result();

	}

}

 ?>
