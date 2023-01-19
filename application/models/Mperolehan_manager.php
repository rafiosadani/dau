<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mperolehan_manager extends CI_Model {

  var $table_prl = 'vw_prl_tot';

  public function getCount() {
      $post = $this->input->post();
      $this->db->select('COUNT(*) as total');
      $this->db->from($this->table_prl);
      $this->db->where(["kodej" => $post["kodej"]]);
      $query = $this->db->get();
      return $query->row();
  }

  public function getPrltot() {
      $post = $this->input->post();
      return $this->db->get_where($this->table_prl,["kodej" => $post["kodej"]])->result();
      // $this->db->select('*');
      // $this->db->from($this->table_report);
      // $this->db->join($this->table_prl, 'report_tagih.kodej=vw_prl_tot.kodej');
      // $this->db->where(["report_tagih.kodej" => $post["kodej"]]);
      // $this->db->where("date(report_tagih.tanggal) >= '".$tanggal1."%'");
      // $this->db->where("date(report_tagih.tanggal) <= '".$tanggal2."%'");
      // $query = $this->db->get();
      // return $query->result();
  }

  public function getKwitansi($prog) {
      $post = $this->input->post();
      $tanggal = explode(" - ", $post['date']);
      $this->db->select('sum(case when batal = 1 then jumlah else 0 end) as kwitansi');
      $this->db->from('report_tagih');
      $this->db->where('vou_id = 0');
      $this->db->where('tanggal >= "'.$tanggal[0].' 00:00:00"');
      $this->db->where('tanggal <= "'.$tanggal[1].' 23:59:59"');
      $this->db->where('kodej', $post['kodej']);
      $this->db->where('prog', $prog);
      $this->db->group_by('report_tagih.prog');
      return $this->db->get()->result();
  }

  public function getStaf($kodej){
    $this->db->select('*');
    $this->db->from('sec_users');
    $this->db->where('kodej',$kodej);
    return $this->db->get()->result();
  }

  public function getJumlah($tanggal1,$tanggal2) {
      $post = $this->input->post();
      return $this->db->query("SELECT keu_j.prog,sum(keu_j.jml) as jumlah, sum(case when keu_j.validasi = 'y' then keu_j.jml else 0 end) as keuangan,sum(case when keu_j.validasi = 'n' then keu_j.jml else 0 end) as belum, program.NM_PROGRAM as program, entr_pegawai FROM keu_j JOIN program on keu_j.prog = program.PROG WHERE entr_pegawai = ".$post['kodej']." and date(tgl_setor) >= '".$tanggal1."' and date(tgl_setor) <= '".$tanggal2."' and keu_j.validasi in ('y', 'n') GROUP BY keu_j.prog;
      ")->result();
  }

}


 ?>
