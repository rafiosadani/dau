<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msms_inbox extends CI_Model {

  public function getSms($tgl1,$tgl2){
    $tahun= substr($tgl2,0,4);
    $bulan= substr($tgl2,5,2);
    $hari= substr($tgl2,8,2);
    $day = $hari+1;
    $tgl2 = $tahun."-".$bulan."-".$day;
    $this->db->select('inbox.SenderNumber as hp,inbox.ReceivingDateTime as tgl,inbox.TextDecoded as isi, donatur.noid as noid, donatur.nama as nama');
    $this->db->from('inbox');
    $this->db->join('donatur','substring(inbox.SenderNumber,4) = substring(donatur.telphp,2)');
    $this->db->where("ReceivingDateTime>='".$tgl1."' and ReceivingDateTime<'".$tgl2."'");
    $this->db->where("substring(inbox.SenderNumber,8) != ''");
    return $this->db->get()->result();
  }

}
 ?>
