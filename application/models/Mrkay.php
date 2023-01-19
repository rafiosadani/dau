<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mrkay extends CI_Model {

    public function rkay($bulan,$cabang,$pintu) {
        $select = "nm_rkay,rkay_1,rkay_2,
            sum(case when bulan = '".$bulan."' then perolehan2019 else 0 end) as per20191, 
            sum(case when bulan = '".$bulan."' then perolehan2018 else 0 end) as per20181,
            sum(case when bulan = '".$bulan."' then rkay2019 else 0 end) as rkay20191,
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then perolehan2019 else 0 end) as per20192, 
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then perolehan2018 else 0 end) as per20182,
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then rkay2019 else 0 end) as rkay20192,
            sum(perolehan2019) as per20193, 
            sum(perolehan2018) as per20183,
            sum(rkay2019) as rkay20193";
        $this->db->select($select);
        $this->db->from('vw_rky_jd19');
        $this->db->where('id_cab', $cabang);
        $this->db->where('id_pintu_rtn', $pintu);
        $this->db->order_by('rkay_2', 'desc');
        $this->db->group_by('rkay_1,nm_rkay');
        return $this->db->get()->result();
    }

    public function rkayAll($bulan,$pintu) {
        $select = "nm_rkay,rkay_1,rkay_2,
            sum(case when bulan = '".$bulan."' then perolehan2019 else 0 end) as per20191, 
            sum(case when bulan = '".$bulan."' then perolehan2018 else 0 end) as per20181,
            sum(case when bulan = '".$bulan."' then rkay2019 else 0 end) as rkay20191,
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then perolehan2019 else 0 end) as per20192, 
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then perolehan2018 else 0 end) as per20182,
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then rkay2019 else 0 end) as rkay20192,
            sum(perolehan2019) as per20193, 
            sum(perolehan2018) as per20183,
            sum(rkay2019) as rkay20193";
        $this->db->select($select);
        $this->db->from('vw_rky_jd19');
        $this->db->where('id_pintu_rtn', $pintu);
        $this->db->order_by('rkay_2', 'desc');
        $this->db->group_by('rkay_1,nm_rkay');
        return $this->db->get()->result();
    }   

    public function getPintu() {
        return $this->db->get('pintu_rtn')->result();
    }

    public function rkay2($bulan,$cabang) {
        $select = "nm_rkay,rkay_1,rkay_2,
            sum(case when bulan = '".$bulan."' then perolehan2019 else 0 end) as per20191, 
            sum(case when bulan = '".$bulan."' then perolehan2018 else 0 end) as per20181,
            sum(case when bulan = '".$bulan."' then rkay2019 else 0 end) as rkay20191,
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then perolehan2019 else 0 end) as per20192, 
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then perolehan2018 else 0 end) as per20182,
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then rkay2019 else 0 end) as rkay20192,
            sum(perolehan2019) as per20193, 
            sum(perolehan2018) as per20183,
            sum(rkay2019) as rkay20193";
        $this->db->select($select);
        $this->db->from('vw_rky_jd19');
        $this->db->where('id_cab', $cabang);
        $this->db->order_by('rkay_2', 'desc');
        $this->db->group_by('rkay_1,nm_rkay');
        return $this->db->get()->result();
    }

    public function rkayAll2($bulan) {
        $select = "nm_rkay,rkay_1,rkay_2,
            sum(case when bulan = '".$bulan."' then perolehan2019 else 0 end) as per20191, 
            sum(case when bulan = '".$bulan."' then perolehan2018 else 0 end) as per20181,
            sum(case when bulan = '".$bulan."' then rkay2019 else 0 end) as rkay20191,
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then perolehan2019 else 0 end) as per20192, 
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then perolehan2018 else 0 end) as per20182,
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then rkay2019 else 0 end) as rkay20192,
            sum(perolehan2019) as per20193, 
            sum(perolehan2018) as per20183,
            sum(rkay2019) as rkay20193";
        $this->db->select($select);
        $this->db->from('vw_rky_jd19');
        $this->db->order_by('rkay_2', 'desc');
        $this->db->group_by('rkay_1,nm_rkay');
        return $this->db->get()->result();
    }
    
    public function rkayGrup($bulan,$pintu) {
        $select = "nm_rkay,rkay_1,rkay_2,
            sum(case when bulan = '".$bulan."' then perolehan2019 else 0 end) as per20191, 
            sum(case when bulan = '".$bulan."' then perolehan2018 else 0 end) as per20181,
            sum(case when bulan = '".$bulan."' then rkay2019 else 0 end) as rkay20191,
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then perolehan2019 else 0 end) as per20192, 
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then perolehan2018 else 0 end) as per20182,
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then rkay2019 else 0 end) as rkay20192,
            sum(perolehan2019) as per20193, 
            sum(perolehan2018) as per20183,
            sum(rkay2019) as rkay20193";
        $this->db->select($select);
        $this->db->from('vw_rky_jd19');
        $this->db->where('id_group', $this->session->userdata('idgrup'));
        $this->db->where('id_pintu_rtn', $pintu);
        $this->db->order_by('rkay_2', 'desc');
        $this->db->group_by('rkay_1,nm_rkay');
        return $this->db->get()->result();
    }
    
    public function rkayGrupAll($bulan) {
        $select = "nm_rkay,rkay_1,rkay_2,
            sum(case when bulan = '".$bulan."' then perolehan2019 else 0 end) as per20191, 
            sum(case when bulan = '".$bulan."' then perolehan2018 else 0 end) as per20181,
            sum(case when bulan = '".$bulan."' then rkay2019 else 0 end) as rkay20191,
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then perolehan2019 else 0 end) as per20192, 
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then perolehan2018 else 0 end) as per20182,
            sum(case when bulan >= '1' and bulan <= '".$bulan."' then rkay2019 else 0 end) as rkay20192,
            sum(perolehan2019) as per20193, 
            sum(perolehan2018) as per20183,
            sum(rkay2019) as rkay20193";
        $this->db->select($select);
        $this->db->where('id_group', $this->session->userdata('idgrup'));
        $this->db->from('vw_rky_jd19');
        $this->db->order_by('rkay_2', 'desc');
        $this->db->group_by('rkay_1,nm_rkay');
        return $this->db->get()->result();
    }

}

/* End of file Mrkay.php */
