<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mpage extends CI_Model {

    private $table = "sec_users";
    private $table_prl = "vw_prl_tot";
    private $table_report = "report_tagih";
    public $usrid;
	public $login;
	public $pswd;
	public $name;
    public $email;
    public $active;
    public $activation_code;
    public $priv_admin;
	public $idcabang;
    public $idpusat;
    public $group_id;
	public $kodej;
	public $kodep;
	public $level;
	public $hak;
	  public $lapangan;

    public function cekCabang() {
        return $this->db->get("cabang")->result();
    }

    public function getCount() {
        $post = $this->input->post();
        $this->db->select('COUNT(*) as total');
        $this->db->from($this->table_prl);
        $this->db->where(["kodej" => $post["kodej"]]);
        $query = $this->db->get();
        return $query->row();
    }

    public function getAll() {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('kodej > 0');
        $this->db->where("lapangan = 'A'");
        $query = $this->db->get();
        return $query->result();
    }

    public function getPtgs() {
        $post = $this->input->post();
        $this->db->select('name,kodej');
        $this->db->from($this->table);
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

    public function getAllTwo($idcabang) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('kodej > 0');
        $this->db->where("lapangan = 'A'");
        $this->db->where(["idcabang" => $idcabang]);
        $query = $this->db->get();
        return $query->result();
    }


    public function getAllThree($kodej) {
        return $this->db->get_where($this->table,["kodej" => $kodej])->row();
    }

    public function getAllFour($idgrup) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('kodej > 0');
        $this->db->where("lapangan = 'A'");
        $this->db->where(["group_id" => $idgrup]);
        $query = $this->db->get();
        return $query->result();
    }

    public function getUsrid() {
        $this->db->select('usrid');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getUserById($id) {
        return $this->db->get_where($this->table, ["usrid" => $id])->row();
    }

    public function addUser() {
        $post = $this->input->post();
        $this->usrid = $post["usrid"];
        $this->login = $post["username"];
        $this->pswd = $post["password"];
        $this->name = $post["name"];
        $this->email = $post["email"];
        $this->active = $post["active"];
        $this->activation_code = $post["activcode"];
        $this->priv_admin = $post["privadmin"];
        $this->idcabang = $post["idcabang"];
        $this->idpusat = $post["idpusat"];
        $this->group_id = $post["idgroup"];
        $this->kodej = $post["kodej"];
        $this->kodep = $post["kodep"];
        $this->level = $post["level"];
        $this->hak = $post["hak"];
        $this->lapangan = $post["lapangan"];
        $this->db->insert($this->table, $this);
    }

    public function updateUser() {
        $post = $this->input->post();
        $this->usrid = $post["usrid"];
        $this->login = $post["username"];
        $this->pswd = $post["password"];
        $this->name = $post["name"];
        $this->email = $post["email"];
        $this->active = $post["active"];
        $this->activation_code = $post["activcode"];
        $this->priv_admin = $post["privadmin"];
        $this->idcabang = $post["idcabang"];
        $this->idpusat = $post["idpusat"];
        $this->group_id = $post["idgroup"];
        $this->kodej = $post["kodej"];
        $this->kodep = $post["kodep"];
        $this->level = $post["level"];
        $this->hak = $post["hak"];
        $this->lapangan = $post["lapangan"];
        $this->db->update($this->table, $this, array("usrid" => $post["usrid"]));
    }

    public function deleteUser($id) {
        return $this->db->delete($this->table, array("usrid" => $id));
    }
    public function Target(){
        $where = " month(now()) = Bulan AND year(now()) = tahun ";
        $this->db->select('sum(infaq) as Total  ');
        $this->db->from('tagihandonatur');
        // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
        // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
        $this->db->where($where);
        $hasil=$this->db->get()->result();
        return $hasil;
    }
    public function Tertagih(){
        $where = "month(now())=month(tgl_setor) and year(now())=year(tgl_setor) ";
        $this->db->select('sum(jml) as Total  ');
        $this->db->from('keu_j');
        // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
        // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
        $this->db->where($where);
        $hasil=$this->db->get()->result();
        return $hasil;
    }
    public function Keuangan(){
        $where = "month(now())=month(tgl_setor) and year(now())=year(tgl_setor) AND validasi='y'";
        $this->db->select('sum(jml) as Total  ');
        $this->db->from('keu_j');
        // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
        // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
        $this->db->where($where);
        $hasil=$this->db->get()->result();
        return $hasil;
    }

    public function aktifUmur20(){
        $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun  AND year(now())-year(donaturbaru.tgllahir) < '20' AND donaturbaru.tgllahir != '0000-00-00' AND donaturbaru.status='A'";
        $this->db->select('count(distinct tagihandonatur.noid) as Total ,sum(tagihandonatur.infaq) as Infaq');
        $this->db->from('tagihandonatur');
        $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
        // $this->db->join('donatur','tagihandonatur.id = donatur.autoid','left');
        $this->db->where($where);
        $hasil=$this->db->get();
        return $hasil->result();
    }

    // semua waktu
    public function aktifUmur20AllTime(){
        $this->db->select('count(noid) as Total');
        $this->db->from('donaturbaru');
        $this->db->where("year(now())-year(tgllahir) < '20' AND tgllahir != '0000-00-00' AND status='A' ");
        $hasil=$this->db->get();
        return $hasil->result();
    }

    public function aktifUmur2030(){
    $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '20' AND year(now())-year(donaturbaru.tgllahir) <30 AND donaturbaru.tgllahir != '0000-00-00' AND donaturbaru.status='A'";
    $this->db->select('count(distinct tagihandonatur.noid) as Total,sum(tagihandonatur.infaq) as Infaq');
    $this->db->from('tagihandonatur');
    $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
    // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
    $this->db->where($where);
    $hasil=$this->db->get()->result();
    return $hasil;
    }

    // semua waktu
    public function aktifUmur2030AllTime(){
        $this->db->select('count(noid) as Total');
        $this->db->from('donaturbaru');
        $this->db->where("year(now())-year(tgllahir) >= '20' AND year(now())-year(tgllahir) <30 AND tgllahir != '0000-00-00' AND status='A' ");
        $hasil=$this->db->get();
        return $hasil->result();
    }



    public function aktifUmur3040(){
        $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '30' AND year(now())-year(donaturbaru.tgllahir) <40 AND donaturbaru.tgllahir != '0000-00-00' AND donaturbaru.status='A' ";
        $this->db->select('count(distinct tagihandonatur.noid) as Total ,sum(tagihandonatur.infaq) as Infaq ');
        $this->db->from('tagihandonatur');
        $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
        // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
        $this->db->where($where);
        $hasil=$this->db->get()->result();
            return $hasil;
        }

    // semua waktu
    public function aktifUmur3040AllTime(){
        $this->db->select('count(noid) as Total');
        $this->db->from('donaturbaru');
        $this->db->where("year(now())-year(tgllahir) >= '30' AND year(now())-year(tgllahir) <40 AND tgllahir != '0000-00-00' AND status='A' ");
        $hasil=$this->db->get();
        return $hasil->result();
    }
    
    public function aktifUmur4050(){
            $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '40' AND year(now())-year(donaturbaru.tgllahir) <50 AND donaturbaru.tgllahir != '0000-00-00' AND donaturbaru.status='A'";
            $this->db->select('count(distinct tagihandonatur.noid) as Total ,sum(tagihandonatur.infaq) as Infaq ');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
            }

    // semua waktu
    public function aktifUmur4050AllTime(){
        $this->db->select('count(noid) as Total');
        $this->db->from('donaturbaru');
        $this->db->where("year(now())-year(tgllahir) >= '40' AND year(now())-year(tgllahir) <50 AND tgllahir != '0000-00-00' AND status='A' ");
        $hasil=$this->db->get();
        return $hasil->result();
    }

    public function aktifUmur50(){
            $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '50' AND donaturbaru.tgllahir != '0000-00-00' AND donaturbaru.status='A'";
            $this->db->select('count(distinct tagihandonatur.noid) as Total ,sum(tagihandonatur.infaq) as Infaq ');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
    }

    // semua waktu
    public function aktifUmur50AllTime(){
        $this->db->select('count(noid) as Total');
        $this->db->from('donaturbaru');
        $this->db->where("year(now())-year(donaturbaru.tgllahir) >= '50' AND tgllahir != '0000-00-00' AND status='A' ");
        $hasil=$this->db->get();
        return $hasil->result();
    }

        public function unknownAktifUmur(){
            $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND donaturbaru.tgllahir  = '0000-00-00' AND donaturbaru.status='A'";
            $this->db->select('count(distinct tagihandonatur.noid) as Total');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
        }

     // semua waktu
    public function unknownAktifUmurAllTime(){
        $this->db->select('count(noid) as Total');
        $this->db->from('donaturbaru');
        $this->db->where("tgllahir = '0000-00-00' AND status='A'");
        $hasil=$this->db->get();
        return $hasil->result();
    }   

        public function aktifKelaminL(){
            $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND donaturbaru.sex = 'l' AND status='A'";
            $this->db->select('count(distinct tagihandonatur.noid) as Total ,sum(tagihandonatur.infaq) as Infaq ');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
        }

        // semua waktu
        public function aktifKelaminLAllTime(){
            $this->db->select('count(noid) as Total');
            $this->db->from('donaturbaru');
            $this->db->where("sex = 'l' AND status='A' ");
            $hasil=$this->db->get();
            return $hasil->result();
        }   

        public function aktifKelaminP(){
            $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun  AND donaturbaru.sex = 'p' AND status='A' ";
            $this->db->select('count(distinct tagihandonatur.noid) as Total ,sum(tagihandonatur.infaq) as Infaq ');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
        }

        // semua waktu
        public function aktifKelaminPAllTime(){
            $this->db->select('count(noid) as Total');
            $this->db->from('donaturbaru');
            $this->db->where("sex = 'p' AND status='A' ");
            $hasil=$this->db->get();
            return $hasil->result();
        }   

        public function unknownAktifKelamin(){
            $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND donaturbaru.sex = '' AND status='A'";
            $this->db->select('count(distinct tagihandonatur.noid) as Total');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
        }

   // semua waktu
        public function unknownAktifKelaminAllTime(){
            $this->db->select('count(noid) as Total');
            $this->db->from('donaturbaru');
            $this->db->where("sex = '' AND status='A'");
            $hasil=$this->db->get();
            return $hasil->result();
        }

        public function aktifYesTelp(){
            $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun  AND donaturbaru.telphp != '' AND status='A' ";
            $this->db->select('count(distinct tagihandonatur.noid) as Total ,sum(tagihandonatur.infaq) as Infaq ');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
        }

         // semua waktu
        public function aktifYesTelpAllTime(){
            $this->db->select('count(noid) as Total');
            $this->db->from('donaturbaru');
            $this->db->where("telphp != '' AND status='A'");
            $hasil=$this->db->get();
            return $hasil->result();
        }

        public function aktifNoTelp(){
            $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun  AND donaturbaru.telphp = '' AND status='A' ";
            $this->db->select('count(distinct tagihandonatur.noid) as Total ,sum(tagihandonatur.infaq) as Infaq ');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
        }

        // semua waktu
        public function aktifNoTelpAllTime(){
            $this->db->select('count(noid) as Total');
            $this->db->from('donaturbaru');
            $this->db->where("telphp = '' and status='A'");
            $hasil=$this->db->get();
            return $hasil->result();
        }

        public function aktifSetor20(){
            $where = "infaq < '20000' AND month(now()) = Bulan AND year(now()) = tahun AND donaturbaru.status='A' ";
            $this->db->select('sum(infaq) as Total,count(distinct noid_new) as Orang');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
        }

        // semua waktu
        public function aktifSetor20AllTime(){
            $where = "infaq < '20000' AND donaturbaru.status = 'A'";
            $this->db->select('count(infaq) as Orang  ');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;  
        }

        public function aktifSetor2030(){
            $where = "infaq >= '20000' AND infaq < '30000' AND month(now()) = Bulan AND year(now()) = tahun  AND status='A'";
            $this->db->select('sum(infaq) as Total, count(distinct noid_new) as Orang');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
        }

                // semua waktu
        public function aktifSetor2030AllTime() {
            $where = "infaq >= '20000' AND infaq < '30000' AND donaturbaru.status = 'A'";
            $this->db->select('count(infaq) as Orang  ');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;  
        }

        public function aktifSetor3050(){
            $where = "infaq >= '30000' AND infaq < '50000' AND month(now()) = Bulan AND year(now()) = tahun AND status='A'";
            $this->db->select('sum(infaq) as Total, count(distinct noid_new) as Orang  ');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
        }

        // semua waktu
        public function aktifSetor3050AllTime(){
            $where = "infaq >= '30000' AND infaq < '50000' AND donaturbaru.status = 'A'";
            $this->db->select('count(infaq) as Orang  ');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;  
        }

        public function aktifSetor50100(){
            $where = "infaq >= '50000' AND infaq <= '100000' AND month(now()) = Bulan AND year(now()) = tahun AND status='A' ";
            $this->db->select('sum(infaq) as Total, count(distinct noid_new) as Orang');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
        }

        // semua waktu
        public function aktifSetor50100AllTime(){
            $where = "infaq >= '50000' AND infaq < '100000' AND donaturbaru.status = 'A'";
            $this->db->select('count(infaq) as Orang  ');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;  
        }

        public function aktifSetor100(){
            $where = "infaq > '100000' AND month(now()) = Bulan AND year(now()) = tahun AND status='A' ";
            $this->db->select('sum(infaq) as Total, count(distinct noid_new) as Orang');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
        }

        // semua waktu
        public function aktifSetor100AllTime(){
            $where = "infaq > '100000' AND donaturbaru.status = 'A'";
            $this->db->select('count(infaq) as Orang  ');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            // $this->db->join('donatur','tagihandonatur.id=donatur.autoid','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;  
        }

        public function TargetCabang(){
            $idcabang=$this->session->userdata('idcab');
            $where = " month(now()) = Bulan AND year(now()) = tahun AND sec_users.idcabang = $idcabang";
            $this->db->select('sum(infaq) as Total  ');
            $this->db->from('tagihandonatur');
            // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
        }

        public function TertagihCabang(){
            $idcabang=$this->session->userdata('idcab');
            $where = "month(now())=month(tgl_setor) and year(now())=year(tgl_setor) AND sec_users.idcabang=$idcabang ";
            $this->db->select('sum(jml) as Total  ');
            $this->db->from('keu_j');
            // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            $this->db->join('sec_users','keu_j.entr_pegawai=sec_users.kodej','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
        }

        public function KeuanganCabang(){
            $idcabang=$this->session->userdata('idcab');
            $where = "month(now())=month(tgl_setor) and year(now())=year(tgl_setor) AND validasi='y' AND sec_users.idcabang=$idcabang ";
            $this->db->select('sum(jml) as Total  ');
            $this->db->from('keu_j');
            // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            $this->db->join('sec_users','keu_j.entr_pegawai=sec_users.kodej','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
        }

        public function aktifUmur20Cabang(){
            $idcabang=$this->session->userdata('idcab');
            $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun  AND year(now())-year(donaturbaru.tgllahir) < '20' AND donaturbaru.tgllahir != '0000-00-00' AND sec_users.idcabang=$idcabang";
            $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
            $this->db->where($where);
            $hasil=$this->db->get();
            return $hasil->result();
        }

        public function aktifUmur2030Cabang(){
            $idcabang=$this->session->userdata('idcab');
            $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '20' AND year(now())-year(donaturbaru.tgllahir) <30 AND donaturbaru.tgllahir != '0000-00-00' AND sec_users.idcabang=$idcabang";
            $this->db->select('count(tagihandonatur.infaq) as Total,sum(tagihandonatur.infaq) as Infaq');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
        }



        public function aktifUmur3040Cabang(){
            $idcabang=$this->session->userdata('idcab');
            $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '30' AND year(now())-year(donaturbaru.tgllahir) <40 AND donaturbaru.tgllahir != '0000-00-00' AND sec_users.idcabang=$idcabang";
            $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
                return $hasil;
            }
        public function aktifUmur4050Cabang(){
            $idcabang=$this->session->userdata('idcab');
                $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '40' AND year(now())-year(donaturbaru.tgllahir) <50 AND donaturbaru.tgllahir != '0000-00-00' AND sec_users.idcabang=$idcabang";
                $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                $this->db->from('tagihandonatur');
                $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                return $hasil;
                }
        public function aktifUmur50Cabang(){
            $idcabang=$this->session->userdata('idcab');
                $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '50' AND donaturbaru.tgllahir != '0000-00-00' AND sec_users.idcabang=$idcabang";
                $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                $this->db->from('tagihandonatur');
                $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                return $hasil;
            }

            public function unknownAktifUmurCabang(){
                $idcabang=$this->session->userdata('idcab');
                $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND donaturbaru.tgllahir  = '0000-00-00' AND sec_users.idcabang=$idcabang";
                $this->db->select('count(tagihandonatur.infaq) as Total');
                $this->db->from('tagihandonatur');
                $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                return $hasil;
            }

            public function aktifKelaminLCabang(){
                $idcabang=$this->session->userdata('idcab');
                $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '50' AND donaturbaru.sex = 'l' AND sec_users.idcabang=$idcabang";
                $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                $this->db->from('tagihandonatur');
                $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                return $hasil;
            }
            public function aktifKelaminPCabang(){
                $idcabang=$this->session->userdata('idcab');
                $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun  AND donaturbaru.sex = 'p' AND sec_users.idcabang=$idcabang";
                $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                $this->db->from('tagihandonatur');
                $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                return $hasil;
            }
            public function unknownAktifKelaminCabang(){
                $idcabang=$this->session->userdata('idcab');
                $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND donaturbaru.sex = '' AND sec_users.idcabang=$idcabang";
                $this->db->select('count(tagihandonatur.infaq) as Total');
                $this->db->from('tagihandonatur');
                $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                return $hasil;
            }
            public function aktifYesTelpCabang(){
                $idcabang=$this->session->userdata('idcab');
                $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun  AND donaturbaru.telphp != '' AND sec_users.idcabang=$idcabang";
                $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                $this->db->from('tagihandonatur');
                $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                return $hasil;
            }
            public function aktifNoTelpCabang(){
                $idcabang=$this->session->userdata('idcab');
                $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun  AND donaturbaru.telphp = '' AND sec_users.idcabang=$idcabang";
                $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                $this->db->from('tagihandonatur');
                $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                return $hasil;
            }
            public function aktifSetor20Cabang(){
                $idcabang=$this->session->userdata('idcab');
                $where = "infaq < '20000' AND month(now()) = Bulan AND year(now()) = tahun AND sec_users.idcabang=$idcabang";
                $this->db->select('sum(infaq) as Total,count(infaq) as Orang  ');
                $this->db->from('tagihandonatur');
                // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                return $hasil;
            }
            public function aktifSetor2030Cabang(){
                $idcabang=$this->session->userdata('idcab');
                $where = "infaq >= '20000' AND infaq < '30000' AND month(now()) = Bulan AND year(now()) = tahun AND sec_users.idcabang = $idcabang";
                $this->db->select('sum(infaq) as Total, count(infaq) as Orang');
                $this->db->from('tagihandonatur');
                // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                return $hasil;
            }
            public function aktifSetor3050Cabang(){
                $idcabang=$this->session->userdata('idcab');
                $where = "infaq >= '30000' AND infaq < '50000' AND month(now()) = Bulan AND year(now()) = tahun AND sec_users.idcabang=$idcabang";
                $this->db->select('sum(infaq) as Total, count(infaq) as Orang  ');
                $this->db->from('tagihandonatur');
                // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                return $hasil;
            }
            public function aktifSetor50100Cabang(){
                $idcabang=$this->session->userdata('idcab');
                $where = "infaq >= '50000' AND infaq <= '100000' AND month(now()) = Bulan AND year(now()) = tahun AND sec_users.idcabang=$idcabang";
                $this->db->select('sum(infaq) as Total, count(infaq) as Orang  ');
                $this->db->from('tagihandonatur');
                // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                return $hasil;
            }
            public function aktifSetor100Cabang(){
                $idcabang=$this->session->userdata('idcab');
                $where = "infaq > '100000' AND month(now()) = Bulan AND year(now()) = tahun AND sec_users.idcabang=$idcabang";
                $this->db->select('sum(infaq) as Total, count(infaq) as Orang');
                $this->db->from('tagihandonatur');
                // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                return $hasil;
            }
            public function TargetGroup(){
                $idgroup=$this->session->userdata('idgrup');
                $where = " month(now()) = Bulan AND year(now()) = tahun AND sec_users.group_id= $idgroup";
                $this->db->select('sum(infaq) as Total  ');
                $this->db->from('tagihandonatur');
                // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                return $hasil;
            }
            public function TertagihGroup(){
                $idgroup=$this->session->userdata('idgrup');
                $where = "month(now())=month(tgl_setor) and year(now())=year(tgl_setor) AND sec_users.group_id=$idgroup";
                $this->db->select('sum(jml) as Total  ');
                $this->db->from('keu_j');
                // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','keu_j.entr_pegawai=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                return $hasil;
            }
            public function KeuanganGroup(){
                $idgroup=$this->session->userdata('idgrup');
                $where = "month(now())=month(tgl_setor) and year(now())=year(tgl_setor) AND validasi='y' AND sec_users.group_id=$idgroup";
                $this->db->select('sum(jml) as Total  ');
                $this->db->from('keu_j');
                // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','keu_j.entr_pegawai=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                return $hasil;
            }

            public function aktifUmur20Group(){
                $idgroup=$this->session->userdata('idgrup');
                $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun  AND year(now())-year(donaturbaru.tgllahir) < '20' AND donaturbaru.tgllahir != '0000-00-00' AND sec_users.group_id=$idgroup";
                $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq');
                $this->db->from('tagihandonatur');
                $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get();
                return $hasil->result();
                }

            public function aktifUmur2030Group(){
                $idgroup=$this->session->userdata('idgrup');
            $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '20' AND year(now())-year(donaturbaru.tgllahir) <30 AND donaturbaru.tgllahir != '0000-00-00' AND sec_users.group_id=$idgroup";
            $this->db->select('count(tagihandonatur.infaq) as Total,sum(tagihandonatur.infaq) as Infaq');
            $this->db->from('tagihandonatur');
            $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
            $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
            $this->db->where($where);
            $hasil=$this->db->get()->result();
            return $hasil;
            }



            public function aktifUmur3040Group(){
                $idgroup=$this->session->userdata('idgrup');
                $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '30' AND year(now())-year(donaturbaru.tgllahir) <40 AND donaturbaru.tgllahir != '0000-00-00' AND sec_users.group_id=$idgroup";
                $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                $this->db->from('tagihandonatur');
                $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                    return $hasil;
                }
            public function aktifUmur4050Group(){
                $idgroup=$this->session->userdata('idgrup');
                    $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '40' AND year(now())-year(donaturbaru.tgllahir) <50 AND donaturbaru.tgllahir != '0000-00-00' AND sec_users.group_id=$idgroup";
                    $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                    $this->db->from('tagihandonatur');
                    $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get()->result();
                    return $hasil;
                    }
            public function aktifUmur50Group(){
                $idgroup=$this->session->userdata('idgrup');
                    $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '50' AND donaturbaru.tgllahir != '0000-00-00' AND sec_users.group_id=$idgroup";
                    $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                    $this->db->from('tagihandonatur');
                    $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get()->result();
                    return $hasil;
                }

                public function unknownAktifUmurGroup(){
                    $idgroup=$this->session->userdata('idgrup');
                    $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND donaturbaru.tgllahir  = '0000-00-00' AND sec_users.group_id=$idgroup";
                    $this->db->select('count(tagihandonatur.infaq) as Total');
                    $this->db->from('tagihandonatur');
                    $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get()->result();
                    return $hasil;
                }

                public function aktifKelaminLGroup(){
                    $idgroup=$this->session->userdata('idgrup');
                    $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '50' AND donaturbaru.sex = 'l' AND sec_users.group_id=$idgroup";
                    $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                    $this->db->from('tagihandonatur');
                    $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get()->result();
                    return $hasil;
                }
                public function aktifKelaminPGroup(){
                    $idgroup=$this->session->userdata('idgrup');
                    $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun  AND donaturbaru.sex = 'p' AND sec_users.group_id=$idgroup";
                    $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                    $this->db->from('tagihandonatur');
                    $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get()->result();
                    return $hasil;
                }
                public function unknownAktifKelaminGroup(){
                    $idgroup=$this->session->userdata('idgrup');
                    $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND donaturbaru.sex = '' AND sec_users.group_id=$idgroup";
                    $this->db->select('count(tagihandonatur.infaq) as Total');
                    $this->db->from('tagihandonatur');
                    $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get()->result();
                    return $hasil;
                }
                public function aktifYesTelpGroup(){
                    $idgroup=$this->session->userdata('idgrup');
                    $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun  AND donaturbaru.telphp != '' AND sec_users.group_id=$idgroup";
                    $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                    $this->db->from('tagihandonatur');
                    $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get()->result();
                    return $hasil;
                }
                public function aktifNoTelpGroup(){
                    $idgroup=$this->session->userdata('idgrup');
                    $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun  AND donaturbaru.telphp = '' AND sec_users.group_id=$idgroup";
                    $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                    $this->db->from('tagihandonatur');
                    $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get()->result();
                    return $hasil;
                }
                public function aktifSetor20Group(){
                    $idgroup=$this->session->userdata('idgrup');
                    $where = "infaq < '20000' AND month(now()) = Bulan AND year(now()) = tahun AND sec_users.group_id=$idgroup";
                    $this->db->select('sum(infaq) as Total,count(infaq) as Orang  ');
                    $this->db->from('tagihandonatur');
                    // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get()->result();
                    return $hasil;
                }
                public function aktifSetor2030Group(){
                    $idgroup=$this->session->userdata('idgrup');
                    $where = "infaq >= '20000' AND infaq < '30000' AND month(now()) = Bulan AND year(now()) = tahun AND sec_users.group_id= $idgroup";
                    $this->db->select('sum(infaq) as Total, count(infaq) as Orang');
                    $this->db->from('tagihandonatur');
                    // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get()->result();
                    return $hasil;
                }
                public function aktifSetor3050Group(){
                    $idgroup=$this->session->userdata('idgrup');
                    $where = "infaq >= '30000' AND infaq < '50000' AND month(now()) = Bulan AND year(now()) = tahun AND sec_users.group_id=$idgroup";
                    $this->db->select('sum(infaq) as Total, count(infaq) as Orang  ');
                    $this->db->from('tagihandonatur');
                    // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get()->result();
                    return $hasil;
                }
                public function aktifSetor50100Group(){
                    $idgroup=$this->session->userdata('idgrup');
                    $where = "infaq >= '50000' AND infaq <= '100000' AND month(now()) = Bulan AND year(now()) = tahun AND sec_users.group_id=$idgroup";
                    $this->db->select('sum(infaq) as Total, count(infaq) as Orang  ');
                    $this->db->from('tagihandonatur');
                    // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get()->result();
                    return $hasil;
                }
                public function aktifSetor100Group(){
                    $idgroup=$this->session->userdata('idgrup');
                    $where = "infaq > '100000' AND month(now()) = Bulan AND year(now()) = tahun AND sec_users.group_id=$idgroup";
                    $this->db->select('sum(infaq) as Total, count(infaq) as Orang');
                    $this->db->from('tagihandonatur');
                    // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get()->result();
                    return $hasil;
                }
                public function TargetUser(){
                    $iduser=$this->session->userdata('ses_kodej');
                    $where = " month(now()) = Bulan AND year(now()) = tahun AND sec_users.kodej=$iduser";
                    $this->db->select('sum(infaq) as Total  ');
                    $this->db->from('tagihandonatur');
                    // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get()->result();
                    return $hasil;
                }
                public function TertagihUser(){
                    $iduser=$this->session->userdata('ses_kodej');
                    $where = "month(now())=month(tgl_setor) and year(now())=year(tgl_setor) AND sec_users.kodej=$iduser";
                    $this->db->select('sum(jml) as Total  ');
                    $this->db->from('keu_j');
                    // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','keu_j.entr_pegawai=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get()->result();
                    return $hasil;
                }
                public function KeuanganUser(){
                    $iduser=$this->session->userdata('ses_kodej');
                    $where = "month(now())=month(tgl_setor) and year(now())=year(tgl_setor) AND validasi='y' AND sec_users.kodej=$iduser";
                    $this->db->select('sum(jml) as Total  ');
                    $this->db->from('keu_j');
                    // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','keu_j.entr_pegawai=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get()->result();
                    return $hasil;
                }

                public function aktifUmur20User(){
                    $iduser=$this->session->userdata('ses_kodej');
                    $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun  AND year(now())-year(donaturbaru.tgllahir) < '20' AND donaturbaru.tgllahir != '0000-00-00' AND sec_users.kodej=$iduser";
                    $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq');
                    $this->db->from('tagihandonatur');
                    $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get();
                    return $hasil->result();
                }

                public function aktifUmur2030User(){
                    $iduser=$this->session->userdata('ses_kodej');
                $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '20' AND year(now())-year(donaturbaru.tgllahir) <30 AND donaturbaru.tgllahir != '0000-00-00' AND sec_users.kodej=$iduser";
                $this->db->select('count(tagihandonatur.infaq) as Total,sum(tagihandonatur.infaq) as Infaq');
                $this->db->from('tagihandonatur');
                $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                $this->db->where($where);
                $hasil=$this->db->get()->result();
                return $hasil;
                }



                public function aktifUmur3040User(){
                    $iduser=$this->session->userdata('ses_kodej');
                    $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '30' AND year(now())-year(donaturbaru.tgllahir) <40 AND donaturbaru.tgllahir != '0000-00-00' AND sec_users.kodej=$iduser";
                    $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                    $this->db->from('tagihandonatur');
                    $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                    $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                    $this->db->where($where);
                    $hasil=$this->db->get()->result();
                        return $hasil;
                    }
                public function aktifUmur4050User(){
                    $iduser=$this->session->userdata('ses_kodej');
                        $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '40' AND year(now())-year(donaturbaru.tgllahir) <50 AND donaturbaru.tgllahir != '0000-00-00' AND sec_users.kodej=$iduser";
                        $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                        $this->db->from('tagihandonatur');
                        $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                        $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                        }
                public function aktifUmur50User(){
                    $iduser=$this->session->userdata('ses_kodej');
                        $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '50' AND donaturbaru.tgllahir != '0000-00-00' AND sec_users.kodej=$iduser";
                        $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                        $this->db->from('tagihandonatur');
                        $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                        $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }

                    public function unknownAktifUmurUser(){
                        $iduser=$this->session->userdata('ses_kodej');
                        $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND donaturbaru.tgllahir  = '0000-00-00' AND sec_users.kodej=$iduser";
                        $this->db->select('count(tagihandonatur.infaq) as Total');
                        $this->db->from('tagihandonatur');
                        $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                        $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }

                    public function aktifKelaminLUser(){
                        $iduser=$this->session->userdata('ses_kodej');
                        $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND year(now())-year(donaturbaru.tgllahir) >= '50' AND donaturbaru.sex = 'l' AND sec_users.kodej=$iduser";
                        $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                        $this->db->from('tagihandonatur');
                        $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                        $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }
                    public function aktifKelaminPUser(){
                        $iduser=$this->session->userdata('ses_kodej');
                        $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun  AND donaturbaru.sex = 'p' AND sec_users.kodej=$iduser";
                        $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                        $this->db->from('tagihandonatur');
                        $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                        $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }
                    public function unknownAktifKelaminUser(){
                        $iduser=$this->session->userdata('ses_kodej');
                        $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun AND donaturbaru.sex = '' AND sec_users.kodej=$iduser";
                        $this->db->select('count(tagihandonatur.infaq) as Total');
                        $this->db->from('tagihandonatur');
                        $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                        $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }
                    public function aktifYesTelpUser(){
                        $iduser=$this->session->userdata('ses_kodej');
                        $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun  AND donaturbaru.telphp != '' AND sec_users.kodej=$iduser";
                        $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                        $this->db->from('tagihandonatur');
                        $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                        $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }
                    public function aktifNoTelpUser(){
                        $iduser=$this->session->userdata('ses_kodej');
                        $where = "tagihandonatur.infaq != '0' AND month(now()) = tagihandonatur.Bulan AND year(now()) = tagihandonatur.tahun  AND donaturbaru.telphp = '' AND sec_users.kodej=$iduser";
                        $this->db->select('count(tagihandonatur.infaq) as Total ,sum(tagihandonatur.infaq) as Infaq ');
                        $this->db->from('tagihandonatur');
                        $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                        $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }
                    public function aktifSetor20User(){
                        $iduser=$this->session->userdata('ses_kodej');
                        $where = "infaq < '20000' AND month(now()) = Bulan AND year(now()) = tahun AND sec_users.kodej=$iduser";
                        $this->db->select('sum(infaq) as Total,count(infaq) as Orang  ');
                        $this->db->from('tagihandonatur');
                        // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                        $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }
                    public function aktifSetor2030User(){
                        $iduser=$this->session->userdata('ses_kodej');
                        $where = "infaq >= '20000' AND infaq < '30000' AND month(now()) = Bulan AND year(now()) = tahun AND sec_users.kodej= $iduser";
                        $this->db->select('sum(infaq) as Total, count(infaq) as Orang');
                        $this->db->from('tagihandonatur');
                        // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                        $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }
                    public function aktifSetor3050User(){
                        $iduser=$this->session->userdata('ses_kodej');
                        $where = "infaq >= '30000' AND infaq < '50000' AND month(now()) = Bulan AND year(now()) = tahun AND sec_users.kodej=$iduser";
                        $this->db->select('sum(infaq) as Total, count(infaq) as Orang  ');
                        $this->db->from('tagihandonatur');
                        // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                        $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }
                    public function aktifSetor50100User(){
                        $iduser=$this->session->userdata('ses_kodej');
                        $where = "infaq >= '50000' AND infaq <= '100000' AND month(now()) = Bulan AND year(now()) = tahun AND sec_users.kodej=$iduser";
                        $this->db->select('sum(infaq) as Total, count(infaq) as Orang  ');
                        $this->db->from('tagihandonatur');
                        // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                        $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }
                    public function aktifSetor100User(){
                        $iduser=$this->session->userdata('ses_kodej');
                        $where = "infaq > '100000' AND month(now()) = Bulan AND year(now()) = tahun AND sec_users.kodej=$iduser";
                        $this->db->select('sum(infaq) as Total, count(infaq) as Orang');
                        $this->db->from('tagihandonatur');
                        // $this->db->join('donaturbaru','tagihandonatur.noid_new = donaturbaru.noid','left');
                        $this->db->join('sec_users','tagihandonatur.kodej=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }

                    public function semuaPekerjaan(){
                        $this->db->select('*');
                        $this->db->from('pekerjaan');
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }

                    //admin

                    public function donatur_pekerjaan($pekerjaan){
                      $idcabang=$this->session->userdata('idcab');
                      $idgroup=$this->session->userdata('idgrup');
                      $iduser = $this->session->userdata('ses_kodej');
                      $this->db->select('count(pekerjaan) as donatur');
                      $this->db->from('donaturbaru');
                      if($this->session->userdata('superadmin') == TRUE){

                      }
                      elseif ($this->session->userdata('superadmin') != TRUE && $this->session->userdata('admin_cabang')==TRUE) {
                        $this->db->join('sec_users','donaturbaru.jupen=sec_users.kodej','left');
                        $this->db->where('sec_users.idcabang',$idcabang);  
                      }elseif($this->session->userdata('admin_grup') == TRUE){
                        $this->db->join('sec_users','donaturbaru.jupen=sec_users.kodej','left');
                        $this->db->where('sec_users.group_id',$idgroup);
                      }else{
                        $this->db->join('sec_users','donaturbaru.jupen=sec_users.kodej','left');
                        $this->db->where('sec_users.kodej',$iduser);
                      }
                      $this->db->where('PEKERJAAN',$pekerjaan);
                      $hasil=$this->db->get()->result();
                      return $hasil;
                    }

                    public function infaq_pekerjaan($pekerjaan){
                      $idcabang=$this->session->userdata('idcab');
                      $idgroup=$this->session->userdata('idgrup');
                      $iduser = $this->session->userdata('ses_kodej');
                      $this->db->select('sum(donatur_item.besar) as infaq');
                      $this->db->from('donaturbaru');
                      $this->db->join('donatur_item','donatur_item.noid = donaturbaru.autoid');
                      if($this->session->userdata('superadmin') == TRUE){

                      }
                      elseif ($this->session->userdata('superadmin') != TRUE && $this->session->userdata('admin_cabang')==TRUE) {
                        $this->db->join('sec_users','donaturbaru.jupen=sec_users.kodej','left');
                        $this->db->where('sec_users.idcabang',$idcabang);  
                      }elseif($this->session->userdata('admin_grup') == TRUE){
                        $this->db->join('sec_users','donaturbaru.jupen=sec_users.kodej','left');
                        $this->db->where('sec_users.group_id',$idgroup);
                      }else{
                        $this->db->join('sec_users','donaturbaru.jupen=sec_users.kodej','left');
                        $this->db->where('sec_users.kodej',$iduser);
                      }
                      $this->db->where('PEKERJAAN',$pekerjaan);
                      $hasil=$this->db->get()->result();
                      return $hasil;
                    }
                    public function donaturlain2(){
                        $where = "pekerjaan = ''";
                        $this->db->select('count(pekerjaan) as donatur');
                        $this->db->from('donaturbaru');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }

                    public function infaqlain2(){
                        $where = "donaturbaru.pekerjaan = ''";
                        $this->db->select('sum(donatur_item.besar) as infaq');
                        $this->db->from('donaturbaru');
                        $this->db->join('donatur_item','donatur_item.noid = donaturbaru.autoid');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }

                    //cabang

                    public function donaturlain2Cabang(){
                        $idcabang=$this->session->userdata('idcab');
                        $where = "pekerjaan = '' and sec_users.idcabang = $idcabang";
                        $this->db->select('count(pekerjaan) as donatur'); 
                        $this->db->from('donaturbaru');
                        $this->db->join('sec_users','donaturbaru.jupen=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }

                    public function infaqlain2Cabang(){
                        $idcabang=$this->session->userdata('idcab');
                        $where = "donaturbaru.pekerjaan = '' and sec_users.idcabang = $idcabang";
                        $this->db->select('sum(donatur_item.besar) as infaq');
                        $this->db->from('donaturbaru');
                        $this->db->join('donatur_item','donatur_item.noid = donaturbaru.autoid');
                        $this->db->join('sec_users','donaturbaru.jupen=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;

                    }


                    //group
                    public function donaturlain2Group(){
                        $idgroup=$this->session->userdata('idgrup');
                        $where = "pekerjaan = '' and sec_users.group_id = $idgroup";
                        $this->db->select('count(pekerjaan) as donatur');
                        $this->db->from('donaturbaru');
                        $this->db->join('sec_users','donaturbaru.jupen=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }

                    public function infaqlain2Group(){
                        $idgroup=$this->session->userdata('idgrup');
                        $where = "donaturbaru.pekerjaan = '' and sec_users.group_id = $idgroup";
                        $this->db->select('sum(donatur_item.besar) as infaq');
                        $this->db->from('donaturbaru');
                        $this->db->join('donatur_item','donatur_item.noid = donaturbaru.autoid');
                        $this->db->join('sec_users','donaturbaru.jupen=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                    }


                    //user
                    public function donaturlain2User(){
                        $iduser = $this->session->userdata('ses_kodej');
                        $where = "pekerjaan = '' and sec_users.kodej = $iduser";
                        $this->db->select('count(pekerjaan) as donatur');
                        $this->db->from('donaturbaru');
                        $this->db->join('sec_users','donaturbaru.jupen=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;
                }

                    public function infaqlain2User(){
                        $iduser = $this->session->userdata('ses_kodej');
                        $where = "donaturbaru.pekerjaan =  '' and sec_users.kodej = $iduser";
                        $this->db->select('sum(donatur_item.besar) as infaq');
                        $this->db->from('donaturbaru');
                        $this->db->join('donatur_item','donatur_item.noid = donaturbaru.autoid');
                        $this->db->join('sec_users','donaturbaru.jupen=sec_users.kodej','left');
                        $this->db->where($where);
                        $hasil=$this->db->get()->result();
                        return $hasil;  
                    }

                    public function daftarKota() {
                    $this->db->select('master_kab.NAMA as Kota, substring(donaturbaru.iddesa,1,4) as desaid');
                    $this->db->from('donaturbaru');
                    $this->db->join('master_kab', 'master_kab.IDKAB = substring(donaturbaru.iddesa,1,4)');
                    $this->db->where("substring(iddesa,1,4) != ''");
                    $this->db->group_by('substring(iddesa,1,4)');
                    $hasil = $this->db->get()->result();
                    return $hasil;
                    }

                    public function donaturKota($id_desa) {
                        $this->db->select('count(noid) as donatur');
                        $this->db->from('donaturbaru');
                        $this->db->where('substring(donaturbaru.iddesa,1,4)', $id_desa);
                        $hasil = $this->db->get()->result();
                        return $hasil;
                    }

                    public function infaqKota($id_desa) {
                        $this->db->select('sum(donatur_item.besar) as infaq');
                        $this->db->from('donaturbaru');
                        $this->db->join('donatur_item', 'donaturbaru.autoid = donatur_item.noid');
                        $this->db->where('substring(donaturbaru.iddesa,1,4)', $id_desa);
                        $hasil = $this->db->get()->result();
                        return $hasil; 
                    }

                    public function daftarPendidikan() {
                        $this->db->select('pendidikan.NM_pendidikan as pendidikan, pendidikan.PENDIDIKAN as pendidikanid');
                        $this->db->from('pendidikan');
                        $this->db->join('donaturbaru', 'donaturbaru.pendidikan = pendidikan.PENDIDIKAN');
                        $this->db->where('donaturbaru.pendidikan != ""');
                        $this->db->group_by('donaturbaru.pendidikan');
                        $hasil = $this->db->get()->result();
                        return $hasil;
                    }

                    public function donaturPendidikan($id_pendidikan) {
                        $this->db->select('count(noid) as donatur');
                        $this->db->from('donaturbaru');
                        $this->db->where('pendidikan', $id_pendidikan);
                        $hasil = $this->db->get()->result();
                        return $hasil;
                    }

                    public function infaqPendidikan($id_pendidikan) {
                        $this->db->select('sum(donatur_item.besar) as infaq');
                        $this->db->from('donaturbaru');
                        $this->db->join('donatur_item', 'donaturbaru.autoid = donatur_item.noid');
                        $this->db->where('donaturbaru.pendidikan', $id_pendidikan);
                        $hasil = $this->db->get()->result();
                        return $hasil;
                    }
}


/* End of file Mpage.php */
