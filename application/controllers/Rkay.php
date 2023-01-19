<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

// Load library phpspreadsheet
require('./phpSpreadSheet/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// End load library phpspreadsheet

class Rkay extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mrkay');
        $this->load->model('mprogram');
        if ($this->session->userdata('login') != TRUE) {
            redirect(base_url());
        }
    }

    public function index() {
        if ($this->session->userdata('admin') == TRUE) {
            if ($this->session->userdata('superadmin') == TRUE) {
                $data['cabang'] = $this->mprogram->getCabang();
            } else if ($this->session->userdata('superadmin') != TRUE && $this->session->userdata('admin_cabang') == TRUE) {
                $data['cabang'] = $this->mprogram->getCabangCab();
            } else if ($this->session->userdata('admin_grup') == TRUE) {
                $data['cabang'] = $this->mprogram->getCabangGrup();
            }
            $data['pintu'] = $this->mrkay->getPintu();
            $this->load->view('rkay', $data);
        } else {
            redirect(base_url());
        }
    }

    public function cetakRekap() {
        $bulan = $this->input->post('bulan');
        $cabang = $this->input->post('cabang');
        $pintu = $this->input->post('pintu');

        if ($this->input->post('btncetak')) {
            if ($cabang == '-') {
                if ($pintu == '-') {
                    if ($this->session->userdata('superadmin') == TRUE) {
                        $data['rkay'] = $this->mrkay->rkayAll2($bulan);
                    } else if ($this->session->userdata('admin_grup') == TRUE) {
                        $data['rkay'] = $this->mrkay->rkayGrupAll($bulan);
                    }
                } else {
                    if ($this->session->userdata('superadmin') == TRUE) {
                        $data['rkay'] = $this->mrkay->rkayAll($bulan,$pintu);
                    } else if ($this->session->userdata('admin_grup') == TRUE) {
                        $data['rkay'] = $this->mrkay->rkayGrup($bulan,$pintu);
                    }
                }
            } else {
                if ($pintu == '-') {
                    $data['rkay'] = $this->mrkay->rkay2($bulan,$cabang);
                } else {
                    $data['rkay'] = $this->mrkay->rkay($bulan,$cabang,$pintu);
                }
            }
            $this->load->view('rekap_rkay', $data);
        } else {
            $nbsp = "\xc2\xa0";
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $styleArray = array(
                'borders' => array(
                    'allBorders' => array(
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => array('argb' => '000000'),
                    ),
                ),
            );

            if ($cabang == '-') {
                if ($pintu == '-') {
                    if ($this->session->userdata('superadmin') == TRUE) {
                        $data = $this->mrkay->rkayAll2($bulan);
                    } else if ($this->session->userdata('admin_grup') == TRUE) {
                        $data = $this->mrkay->rkayGrupAll($bulan);
                    }
                } else {
                    if ($this->session->userdata('superadmin') == TRUE) {
                        $data = $this->mrkay->rkayAll($bulan,$pintu);
                    } else if ($this->session->userdata('admin_grup') == TRUE) {
                        $data = $this->mrkay->rkayGrup($bulan,$pintu);
                    }
                }
            } else {
                if ($pintu == '-') {
                    $data = $this->mrkay->rkay2($bulan,$cabang);
                } else {
                    $data = $this->mrkay->rkay($bulan,$cabang,$pintu);
                }
            }

            $sheet->setCellValue('A1', "REKAP RKAY")->mergeCells('A1:R1')
                ->getStyle('A1')->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('A3', "Nama Program")->mergeCells('A3:C4')
                ->getStyle('A3')->getAlignment()->setHorizontal('center')->setVertical('center');
            $sheet->setCellValue('D3', "Bulan Ini")->mergeCells('D3:H3')
                ->getStyle('D3')->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('I3', "Bulan Januari sd Bulan ini")->mergeCells('I3:M3')
                ->getStyle('I3')->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('N3', "Pencapaian Setahun")->mergeCells('N3:R3')
                ->getStyle('N3')->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('D4', "Perolehan 2019")->getStyle('D4')
                ->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('E4', "Perolehan 2018")->getStyle('E4')
                ->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('F4', "Rkay 2019")->getStyle('F4')
                ->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('G4', "rata2 1")->getStyle('G4')
                ->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('H4', "rata2 2")->getStyle('H4')
                ->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('I4', "Perolehan 2019")->getStyle('I4')
                ->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('J4', "Perolehan 2018")->getStyle('J4')
                ->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('K4', "Rkay 2019")->getStyle('K4')
                ->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('L4', "rata2 1")->getStyle('L4')
                ->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('M4', "rata2 2")->getStyle('M4')
                ->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('N4', "Perolehan 2019")->getStyle('N4')
                ->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('O4', "Perolehan 2018")->getStyle('O4')
                ->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('P4', "Rkay 2019")->getStyle('P4')
                ->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('Q4', "rata2 1")->getStyle('Q4')
                ->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('R4', "rata2 2")->getStyle('R4')
                ->getAlignment()->setHorizontal('center');

            $row = 5;
            $sum1 = $sum2 = $sum3 = $sum4 = $sum5 = $sum6 = $sum7 = $sum8 = $sum9 = 0;
            foreach ($data as $value) {
                $sum1 += $value->per20191;
                $sum2 += $value->per20181;
                $sum3 += $value->rkay20191;
                $sum4 += $value->per20192;
                $sum5 += $value->per20182;
                $sum6 += $value->rkay20192;
                $sum7 += $value->per20193;
                $sum8 += $value->per20183;
                $sum9 += $value->rkay20193;

                $sheet->setCellValue('A'.$row, $value->rkay_2)->getStyle('A'.$row);
                $sheet->setCellValue('B'.$row, $value->rkay_1)->getStyle('B'.$row);
                $sheet->setCellValue('C'.$row, $value->nm_rkay)->getStyle('C'.$row);
                $sheet->setCellValue('D'.$row, number_format($value->per20191,0,'.',','))->getStyle('D'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $sheet->setCellValue('E'.$row, number_format($value->per20181,0,'.',','))->getStyle('E'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $sheet->setCellValue('F'.$row, number_format($value->rkay20191,0,'.',','))->getStyle('F'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                if ($value->per20181 == 0 || $value->per20191 == 0) {
                    $sheet->setCellValue('G'.$row, '0.00%')->getStyle('G'.$row)
                        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                } else if ($value->per20181 != 0 && $value->per20191 != 0 ) {
                    $sheet->setCellValue('G'.$row, round(100*($value->per20181/$value->per20191),2)."%")->getStyle('G'.$row)
                        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                }
                if ($value->per20181 == 0 || $value->rkay20191 == 0) {
                    $sheet->setCellValue('H'.$row, '0.00%')->getStyle('H'.$row)
                        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                } else if ($value->per20181 != 0 && $value->rkay20191 != 0 ) {
                    $sheet->setCellValue('H'.$row, round(100*($value->per20181/$value->rkay20191),2)."%")->getStyle('H'.$row)
                        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                }
                $sheet->setCellValue('I'.$row, number_format($value->per20192,0,'.',','))->getStyle('I'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $sheet->setCellValue('J'.$row, number_format($value->per20182,0,'.',','))->getStyle('J'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $sheet->setCellValue('K'.$row, number_format($value->rkay20192,0,'.',','))->getStyle('K'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                if ($value->per20182 == 0 || $value->per20192 == 0) {
                    $sheet->setCellValue('L'.$row, '0.00%')->getStyle('L'.$row)
                        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                } else if ($value->per20182 != 0 && $value->per20192 != 0 ) {
                    $sheet->setCellValue('L'.$row, round(100*($value->per20182/$value->per20192),2)."%")->getStyle('L'.$row)
                        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                }
                if ($value->per20182 == 0 || $value->rkay20192 == 0) {
                    $sheet->setCellValue('M'.$row, '0.00%')->getStyle('M'.$row)
                        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                } else if ($value->per20182 != 0 && $value->rkay20192 != 0 ) {
                    $sheet->setCellValue('M'.$row, round(100*($value->per20182/$value->rkay20192),2)."%")->getStyle('M'.$row)
                        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                }
                $sheet->setCellValue('N'.$row, number_format($value->per20193,0,'.',','))->getStyle('N'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $sheet->setCellValue('O'.$row, number_format($value->per20183,0,'.',','))->getStyle('O'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                $sheet->setCellValue('P'.$row, number_format($value->rkay20193,0,'.',','))->getStyle('P'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                if ($value->per20183 == 0 || $value->per20193 == 0) {
                    $sheet->setCellValue('Q'.$row, '0.00%')->getStyle('Q'.$row)
                        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                } else if ($value->per20183 != 0 && $value->per20193 != 0 ) {
                    $sheet->setCellValue('Q'.$row, round(100*($value->per20183/$value->per20193),2)."%")->getStyle('Q'.$row)
                        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                }
                if ($value->per20183 == 0 || $value->rkay20193 == 0) {
                    $sheet->setCellValue('R'.$row, '0.00%')->getStyle('R'.$row)
                        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                } else if ($value->per20183 != 0 && $value->rkay20193 != 0 ) {
                    $sheet->setCellValue('R'.$row, round(100*($value->per20183/$value->rkay20193),2)."%")->getStyle('R'.$row)
                        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
                }
                $row++;
            }

            $sheet->setCellValue('A'.$row, "TOTAL JUMLAH")->mergeCells('A'.$row.':C'.$row)
                ->getStyle('A'.$row)->getAlignment()->setHorizontal('center')->setVertical('center');
            $sheet->setCellValue('D'.$row, number_format($sum1,0,'.',','))->getStyle('D'.$row)
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue('E'.$row, number_format($sum2,0,'.',','))->getStyle('E'.$row)
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue('F'.$row, number_format($sum3,0,'.',','))->getStyle('F'.$row)
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            if ($sum2 == 0 || $sum1 == 0) {
                $sheet->setCellValue('G'.$row, '0.00%')->getStyle('G'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            } else if ($sum2 != 0 && $sum1 != 0 ) {
                $sheet->setCellValue('G'.$row, round(100*($sum2/$sum1),2)."%")->getStyle('G'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            }
            if ($sum2 == 0 || $sum3 == 0) {
                $sheet->setCellValue('H'.$row, '0.00%')->getStyle('H'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            } else if ($sum2 != 0 && $sum3 != 0 ) {
                $sheet->setCellValue('H'.$row, round(100*($sum2/$sum3),2)."%")->getStyle('H'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            }
            $sheet->setCellValue('I'.$row, number_format($sum4,0,'.',','))->getStyle('I'.$row)
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue('J'.$row, number_format($sum5,0,'.',','))->getStyle('J'.$row)
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue('K'.$row, number_format($sum6,0,'.',','))->getStyle('K'.$row)
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            if ($sum5 == 0 || $sum4 == 0) {
                $sheet->setCellValue('L'.$row, '0.00%')->getStyle('L'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            } else if ($sum5 != 0 && $sum4 != 0 ) {
                $sheet->setCellValue('L'.$row, round(100*($sum5/$sum4),2)."%")->getStyle('L'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            }
            if ($sum5 == 0 || $sum6 == 0) {
                $sheet->setCellValue('M'.$row, '0.00%')->getStyle('M'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            } else if ($sum5 != 0 && $sum6 != 0 ) {
                $sheet->setCellValue('M'.$row, round(100*($sum5/$sum6),2)."%")->getStyle('M'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            }
            $sheet->setCellValue('N'.$row, number_format($sum7,0,'.',','))->getStyle('N'.$row)
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue('O'.$row, number_format($sum8,0,'.',','))->getStyle('O'.$row)
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue('P'.$row, number_format($sum9,0,'.',','))->getStyle('P'.$row)
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            if ($sum8 == 0 || $sum7 == 0) {
                $sheet->setCellValue('Q'.$row, '0.00%')->getStyle('Q'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            } else if ($sum8 != 0 && $sum7 != 0 ) {
                $sheet->setCellValue('Q'.$row, round(100*($sum8/$sum7),2)."%")->getStyle('Q'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            }
            if ($sum8 == 0 || $sum9 == 0) {
                $sheet->setCellValue('R'.$row, '0.00%')->getStyle('R'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            } else if ($sum8 != 0 && $sum9 != 0 ) {
                $sheet->setCellValue('R'.$row, round(100*($sum8/$sum9),2)."%")->getStyle('R'.$row)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            }

            $sheet->getStyle('A3:R'.$row)->applyFromArray($styleArray); 

            for ($x = 'A';$x <= 'R';$x++) {
                $sheet->getColumnDimension($x)->setAutoSize(true);
            }
            
            $writer = new Xlsx($spreadsheet);
            $filename = 'rekap_rkay';
            
            // download file
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
        }   
    }

}

/* End of file Rkay.php */
