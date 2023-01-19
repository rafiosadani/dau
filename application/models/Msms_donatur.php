<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msms_donatur extends CI_Model{

public function getAll() { 
        $this->db->select('kodej,name');
        $this->db->from('sec_users');
        $this->db->where('kodej > 0');
        $this->db->where("lapangan = 'A'");
        $query = $this->db->get();
        return $query->result();
     }
    // public function getGrub($id) {
    //     $this->db->select('kodej,name');
    //     $this->db->from('sec_users');
    //     $this->db->where('kodej > 0');
    //     $this->db->where("lapangan = 'A'");
    //     $this->db->where("group_id = '$id'");
    //     $query = $this->db->get();
    //     return $query->result();
    // }
// public function getKawasan(){
//     $where = array(
//         'kodej' => $this->input->get('kodej')
//     );
//        $data = $this->db->get_where('*', $where )->result();
//        return json_encode($data);
// }
public function search(){
    $kodej=$this->input->post('kodej');
    $kawasan=$this->input->post('kawasan');
    $query = $this->db->query("select * from donaturbaru where telphp!='' and jupen='$kodej' and kwsn='$kawasan' ");
    return $query->result();
}
public function draft(){
    $query = $this->db->query("select * from sms_donatur_draft ");
    return $query->result();
}

public function save($noid,$nama,$tanggal,$telp,$isi,$flag,$judul){
    $object = array(
        'noid' => $noid,
        'nama' => $nama,
        'tanggal' => $tanggal,
        'telphp' => $telp,
        'isi_sms' => $isi,
        'flag' => $flag,
        'judul' => $judul

    );
    $this->db->insert('sms_donatur', $object);

}
// public function banyak_data($kodej,$kwsn){
//     $where = "report_tagih.kodej = '$kodej' AND kawasan.kwsn='$kwsn' AND batal is NULL AND month(report_tagih.tanggal) = month(now()) AND year(report_tagih.tanggal) = year(now())";
//     $this->db->select('*');
//     $this->db->from('report_tagih');
//     $this->db->join('sec_users','report_tagih.kodej = sec_users.kodej','left');
//     $this->db->join('program','report_tagih.prog = program.PROG','left');
//     $this->db->join('kawasan','report_tagih.kodej = kawasan.kodejgt','left');
//     $this->db->join('donatur','report_tagih.noid = donatur.noid','left');
//     $this->db->where($where);
//     $hasil=$this->db->get()->num_rows();
//     return $hasil;
// }
}
