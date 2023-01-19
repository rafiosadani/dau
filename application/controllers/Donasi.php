<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Donasi extends CI_Controller {

    public $keyword;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('M_donasi');
        $this->load->model('Mdonasi');
        if ($this->session->userdata('login') != TRUE) {
            redirect(base_url());
        }
    }

    public function donasi()
    {
        if ($this->session->userdata('admin') == TRUE) {
            $kodej = "SELECT DISTINCT kodejgt from kawasanbaru ORDER by kodejgt ASC";
            $data['petugas']=$this->M_donasi->query($kodej);
            
            $this->load->view('donasi_view', $data);
        } else {
            redirect(base_url('dashboard'));
        }
    }
    public function listDonasi()
    {
    	$donasi = $this->Mdonasi->getDonasi($this->session->userdata('usrid'));
    	$data=array("data"=>$donasi);
    	echo json_encode($data);
    
    }
    public function validasi()
    {
        if ($this->session->userdata('admin') == TRUE) {
            $kodej = "SELECT DISTINCT kodejgt from kawasanbaru ORDER by kodejgt ASC";
            $data['petugas']=$this->M_donasi->query($kodej);
            
            $this->load->view('validasi_manager_view', $data);
        } else {
            redirect(base_url('dashboard'));
        }
    }
    
    public function listValidasi()
    {
    	$donasi = $this->Mdonasi->getDonasi($this->session->userdata('usrid'));
    	$data=array("data"=>$donasi);
    	echo json_encode($data);
    
    }
    public function addDonasi($value='')
    {
        if ($this->session->userdata('admin') == TRUE) {
            $last_id = $this->db->query("select autoid from donaturbaru ORDER BY autoid DESC limit 1")->row();
            if ($this->input->post('nama') == NULL || $this->input->post('nama') == "") {
                /*$data['ket_ap'] = $this->M_donasi->query("select * from ket_ap");
                $data['program'] = $this->M_donasi->query("select PROG,NM_PROGRAM from program");
                $data['carabayar'] = $this->M_donasi->query("select * from cara_byr");
                $data['waktu_tagih'] = $this->M_donasi->query("select * from waktu_penagihan");
                $data['info'] = $this->M_donasi->query("select * from info");
                $data['gaji'] = $this->M_donasi->query("select * from gaji order by GAJI ASC");
                $data['hobi']      = $this->M_donasi->query("select * from hobby order by hobby ASC");
                $data['kerja']  = $this->M_donasi->query("select * from pekerjaan order by PEKERJAAN ASC");
                $data['jabatan']    = $this->M_donasi->query("select * from jabatan order by jabatan ASC");
                $data['pend'] = $this->M_donasi->query("select * from pendidikan order by PENDIDIKAN ASC");
                */
                $data['program'] = $this->M_donasi->query("select PROG,NM_PROGRAM from program");
                $data['jungut'] = $this->M_donasi->query("select KODEJ,NAMA from jungut");
                $this->load->view('add_donasi',$data);
            } else {
            	$data['report_noid']=$this->input->post('nama');
            	//$data['report_prog']=$this->input->post('nama_program');
                //$data['report_nominal']=intval($this->input->post('nominal'));
                //$data['report_ket']=$this->input->post('ket');
                $data['report_jupen']=$this->session->userdata('usrid');
                $donatur= $this->Mdonasi->getDonaturById($this->input->post('nama'));
                //$program= $this->Mdonasi->getProgramById($this->input->post('nama_program'));
                $jupen= $this->Mdonasi->getJupenById($this->session->userdata('usrid'));
                foreach(json_decode($this->input->post("donaturItem")) as $item) {
                	$data['report_prog']=$item[0];
                	$data['report_nominal']=intval($item[2]);
                	$data['report_ket']=$item[3];
                	$this->Mdonasi->insertDonasi($data); 
                }
                //$this->Mdonasi->insertDonasi($data);   
                $data['report_nama']=$donatur[0]->nama;                
                $data['report_alamat']=$donatur[0]->alamat;
                //$data['report_program']=$program[0]->NM_PROGRAM;
                $data['jupen_alm']=$jupen[0]->s_almktr;
                $data['jupen_tlpktr']=$jupen[0]->s_tlp;
                $data['jupen_nama']=$jupen[0]->name;
                $data['jupen_tlp']=$jupen[0]->s_petugas;
                $data['jupen_terima']=$jupen[0]->s_terima;
                $data['jupen_doa']=$jupen[0]->s_doa;
                $data['jupen_web']=$jupen[0]->s_web;
                //$data['donasi_item']=$this->input->post('donaturItem');
        		
                echo json_encode($data);
                
                //redirect(base_url('data/donasi'));
                // echo "<pre>";
                // print_r(json_decode($this->input->post('donaturItem')));
                // echo "</pre>";return;
            }
        } else {
            redirect(base_url('dashboard'));
        }
    }
    public function getDonaturAuto()
    {
    	$data = $this->Mdonasi->getDonatur();
    	$donatur=array();
    	foreach($data as $obj){
    		$donatur[]=array("value"=>$obj->noid,"label"=>$obj->noid." - ".$obj->nama);
    	}
    	echo json_encode($donatur);
    
    }
    public function getProgram()
    {
    	$data = $this->Mdonasi->getProgram();
    	$donatur="";
    	foreach($data as $obj){
    		$donatur.="<option value ='".$obj->PROG."' >".$obj->NM_PROGRAM."</option>";
    	}
    	$data=array("data"=>$donatur);
    	echo json_encode($data);
    
    }
    public function saveDonasi()
    {
    	$data = $this->Mdonasi->getProgram();
    	$donatur="";
    	foreach($data as $obj){
    		$donatur.="<option value ='".$obj->PROG."' >".$obj->NM_PROGRAM."</option>";
    	}
    	$data=array("data"=>$donatur);
    	echo json_encode($data);
    
    }
 
}

/* End of file  */
/* Location: ./application/controllers/ */