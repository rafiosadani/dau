<?php
$tgl1 = substr($this->input->post('date'),0,10);
$tgl2 = substr($this->input->post('date'),13,10);
date_default_timezone_set('Asia/Jakarta');
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php $this->load->view('partials/head') ?>
    <style type="text/css">
    body{
      margin-top: -9px;
      font-family: arial;
      font-size: 12px;
      color: black;
    }
    table{
      width:100%;
    }
    td{
      border: 1px solid black;
      padding-left: 5px;
      padding-right: 5px;
    }
    span{
      padding-right: 10px;
    }
    hr{
      border-color: #9A9A9A;
      padding: 0;
      margin-top: 6px;
      margin-bottom: 0;
    }
    </style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="box-body table-responsive">
    <table  style="width:100%;border:none;margin:0;padding:0;">
      <tr>
        <td style="padding:0;margin:0;border:none;width:100px;"><img src="http://202.154.58.50/dau_old/inventori/images/logo-dau.png" alt=""> </td>
        <td style="padding:0;margin:0;border:none;">
          <b style="font-size:20px;font-weight:700px;font-family:arial">LEMBAGA AMIL ZAKAT</b> <br>
          <b style="font-size:18px;font-weight:700px;font-family:arial">Sk Kemenag Nomor 520 Tahun 2017</b>
        </td>
      </tr>
    </table>
    <hr>
    <table>
      <tr>
        <td align="center" colspan="20" style="border:none;padding-top:5px;"> <b style="width:12px;font-weight:700px">REKAP PEROLEHAN TOTAL PER PROZIS</b> </td>
      </tr>
      <tr>
        <td align="center" colspan="20" style="border:none;padding-bottom:10px;"> <b style="width:12px;font-weight:700px"> <span> KODE PROZIS : <?php echo $this->input->post('kodej'); ?> </span> <span> PERIODE : <?php echo $tgl1.' S/D '. $tgl2 ?> </span> <span> TANGGAL CETAK : <?php echo date('Y-m-d H:i:s'); ?> </span> </b> </td>
      </tr>
    </table>
    <table>
      <tr>
        <td rowspan="2" style="width:10px">No</td>
        <td rowspan="2">Kawasan</td>
        <td colspan="2">Target</td>
        <td rowspan="2">RK</td>
        <td colspan="2">Hasil</td>
        <td colspan="2">Gagal</td>
        <td colspan="2">Donatur Baru</td>
        <td colspan="2">Lebih</td>
        <td colspan="2">Total</td>
        <td colspan="2">Kwitansi Gagal</td>
        <td colspan="2">%</td>
        <td rowspan="2">Rata %</td>
      </tr>
      <tr>
        <td>Donatur</td>
        <td>Donasi</td>
        <td>Donatur</td>
        <td>Donasi</td>
        <td>Donatur</td>
        <td>Donasi</td>
        <td>Donatur</td>
        <td>Donasi</td>
        <td>Donatur</td>
        <td>Donasi</td>
        <td>Donatur</td>
        <td>Donasi</td>
        <td>DNT</td>
        <td>DNS</td>
        <td>DNT</td>
        <td>DNS</td>
      </tr>
      <tr>
        <?php
        $sum1 = 0;$sum2 = 0;$sum3 = 0;$sum4 = 0;$sum5 = 0;$sum6 = 0;
            $sum7 = 0;$sum8 = 0;$sum9 = 0;$sum10 = 0;$sum11 = 0;$sum12 = 0;
            $sum13 = 0;$sum14 = 0;$sum15 = 0;$sum16 = 0;$sum17 =0;
          foreach($prl as $key => $prl) {
            $sum1 += $prl->Trg_dnt;
            $sum2 += $prl->trg_dns;
            $sum3 += $prl->hsl_dnt;
            $sum4 += $prl->hsl_dns;
            $sum5 += $prl->ggl_dnt;
            $sum6 += $prl->ggl_dns;
            $sum7 += $prl->br_dnt;
            $sum8 += $prl->br_dns;
            $sum9 += $prl->lb_dnt;
            $sum10 += $prl->lb_dns;
            $sum11 += $prl->ttl_dnt;
            $sum12 += $prl->ttl_dns;
            $sum13 += round(100*($prl->ttl_dnt/$prl->Trg_dnt) / $count->total ,2);
            $sum14 += round(100*($prl->ttl_dns/$prl->trg_dns) / $count->total ,2);
            $sum15 += $prl->btl_dnt;
            $sum16 += $prl->btl_dns;
            ?>
            <tr>
              <td>
                <?php echo $key+1 ?>
              </td>
              <td>
                <?php echo $prl->kwsn ?>
              </td>
              <td align=right>
                <?php echo $prl->Trg_dnt ?>
              </td>
              <td align=right>
                <?php echo number_format($prl->trg_dns,0,',','.') ?>
              </td>
              <td>
                <?php echo $prl->rk ?>
              </td>
              <td align=right>
                <?php echo $prl->hsl_dnt ?>
              </td>
              <td align=right>
                <?php echo number_format($prl->hsl_dns,0,',','.') ?>
              </td>
              <td align=right>
                <?php echo $prl->ggl_dnt ?>
              </td>
              <td align=right>
                <?php echo number_format($prl->ggl_dns,0,',','.') ?>
              </td>
              <td align=right>
                <?php echo $prl->br_dnt ?>
              </td>
              <td align=right>
                <?php echo number_format($prl->br_dns,0,',','.') ?>
              </td>
              <td align=right>
                <?php echo $prl->lb_dnt ?>
              </td>
              <td align=right>
                <?php echo number_format($prl->lb_dns,0,',','.') ?>
              </td>
              <td align=right>
                <?php echo $prl->ttl_dnt ?>
              </td>
              <td align=right>
                <?php echo number_format($prl->ttl_dns,0,',','.') ?>
              </td>
              <td align=right>
                <?php echo $prl->btl_dnt ?>
              </td>
              <td align=right>
                <?php echo $prl->btl_dns ?>
              </td>
              <td align=right>
                <?php echo round(100*($prl->ttl_dnt/$prl->Trg_dnt),2).'%' ?>
              </td>
              <td align=right>
                <?php echo round(100*($prl->ttl_dns/$prl->trg_dns),2).'%' ?>
              </td>
              <?php
                $pdnt = 100*($prl->ttl_dnt/$prl->Trg_dnt);
                $pdns = 100*($prl->ttl_dns/$prl->trg_dns);
                $rtrt = (($pdnt)+($pdns)) / 2;
               ?>
              <td align=right>
                <?php echo round($rtrt,2).'%' ?>
              </td>

            </tr>

            <?php
          }
          $sum17 += (($sum13)+($sum14)) / 2;
          $fee5persen = $sum12*(5/100);
          if ($sum14>=98) {
            $r20persen = $fee5persen*(20/100);
          }else {
            $r20persen = 0;
          }
          if ($sum14<=95) {
            $p10persen = $fee5persen*(10/100);
          }else {
            $p10persen = 0;
          }
          $totaltot = $fee5persen+$r20persen-$p10persen;
         ?>
        <td colspan="2">J U M L A H</td>
        <td align="right"><?php echo $sum1 ?></td>
        <td align="right"><?php echo number_format($sum2,0,',','.') ?></td>
        <td></td>
        <td align="right"><?php echo $sum3 ?></td>
        <td align="right"><?php echo number_format($sum4,0,',','.') ?></td>
        <td align="right"><?php echo $sum5 ?></td>
        <td align="right"><?php echo number_format($sum6,0,',','.') ?></td>
        <td align="right"><?php echo $sum7 ?></td>
        <td align="right"><?php echo number_format($sum8,0,',','.') ?></td>
        <td align="right"><?php echo $sum9 ?></td>
        <td align="right"><?php echo number_format($sum10,0,',','.') ?></td>
        <td align="right"><?php echo $sum11 ?></td>
        <td align="right"><?php echo number_format($sum12,0,',','.') ?></td>
        <td align="right"><?php echo $sum15 ?></td>
        <td align="right"><?php echo number_format($sum16,0,',','.') ?></td>
        <td align="right"><?php echo $sum13.'%' ?></td>
        <td align="right"><?php echo $sum14.'%' ?></td>
        <td align="right"><?php echo $sum17.'%' ?></td>
      </tr>
      <tr>
        <td colspan="14" align="right"> J U M L A H total Fee 5%</td>
        <td colspan="6" align="right"><?php echo number_format($fee5persen,0,',','.'); ?></td>
      </tr>
      <tr>
        <td colspan="14" align="right"> Reward pencapaian 20% jika donasi mencapai >= 98%	</td>
        <td colspan="6" align="right"><?php echo number_format($r20persen,0,',','.'); ?></td>
      </tr>
      <tr>
        <td colspan="14" align="right"> Punishment 10% dari fee jika donasi <= 95%</td>
        <td colspan="6" align="right"><?php echo number_format($p10persen,0,',','.'); ?></td>
      </tr>
      <tr>
        <td colspan="14" align="right"> <b>TOTAL fee + Reward</b> </td>
        <td colspan="6" align="right"> <b> Rp. <?php echo number_format($totaltot,0,',','.'); ?> </b> </td>
      </tr>
    </table><br>

    <table>
      <tr>
        <td style="width:5%;">No</td>
        <td style="width:35%;">Program</td>
        <td style="width:15%;">Tertagih</td>
        <td style="width:15%;">Keuangan</td>
        <td style="width:15%;">Blm Setor</td>
        <td style="width:15%;">Kwitansi Balik</td>
      </tr>
      <?php
        $sum1 = 0;$sum2 = 0;$sum3 = 0;$sum4 = 0;
        foreach ($jumlah as $key => $value) {
        $sum1 += $value->jumlah;
        $sum2 += $value->keuangan;
        $sum3 += $value->belum;
      ?>
      <tr>
        <td><?php echo $key+1 ?></td>
        <td><?php echo $value->program ?></td>
        <td align=right><?php echo number_format($value->jumlah,0,',','.') ?></td>
        <td align=right><?php echo number_format($value->keuangan,0,',','.') ?></td>
        <td align=right><?php echo number_format($value->belum,0,',','.') ?></td>
        <?php
        foreach ($this->mperolehan_manager->getKwitansi($value->prog) as $a) {
        $sum4 += $a->kwitansi;?>
        <td align=right><?php echo number_format($a->kwitansi,0,',','.') ?></td>
        <?php }
         ?>
      </tr>
      <?php } ?>
      <tr>
        <td colspan="2"> <b>J U M L A H</b> </td>
        <td align=right>
          <b><?php echo number_format($sum1,0,',','.') ?></b>
        </td>
        <td align=right>
          <b><?php echo number_format($sum2,0,',','.') ?></b>
        </td>
        <td align=right>
          <b><?php echo number_format($sum3,0,',','.') ?></b>
        </td>
        <td align=right>
          <b><?php echo number_format($sum4,0,',','.') ?></b>
        </td>
      </tr>
    </table>
    <p style="padding-top:50px;"></p>
    <table style="text-align:center;">
      <tr>
        <td style="border:none;"></td>
        <td style="border:none;">M e n g e t a h u i</td>
        <td style="border:none;"></td>
        <td style="border:none;"></td>
        <td style="border:none;"></td>
        <td style="border:none;">Sidoarjo, <?php echo date('Y-m-d');  ?></td>
      </tr>
      <tr>
        <td style="border:none;"></td>
        <td style="border:none;"></td>
        <td style="border:none;"></td>
        <td style="border:none;"></td>
        <td style="border:none;"></td>
        <td style="border:none;">Tertanda</td>
      </tr>
      <tr>
        <td style="border:none;padding-top:60px;"></td>
        <td style="border:none;"></td>
        <td style="border:none;"></td>
        <td style="border:none;"></td>
        <td style="border:none;"></td>
        <td style="border:none;"></td>
      </tr>
      <tr>
        <td style="border:none;text-decoration: underline;"> <b>Sugeng Pribadi, S.I.Kom</b> </td>
        <td style="border:none;text-decoration: underline;"> <b>Moh. Takwil, S.Pd.I</b> </td>
        <td style="border:none;text-decoration: underline;"> <b>Sudayat Kosasih</b> </td>
        <td style="border:none;text-decoration: underline;"> <b>Indah Permatasari</b> </td>
        <td style="border:none;text-decoration: underline;"> <b>Luqman Hakim</b> </td>
        <?php foreach ($staf as $key => $value) {
        ?>
          <td style="border:none;text-decoration: underline;"> <b><?php echo $value->name  ?></b> </td>
        <?php
        } ?>
      </tr>
      <tr>
        <td style="border:none;">Ka. Div. Sosial</td>
        <td style="border:none;">Ka. Div. KUI I / HRD</td>
        <td style="border:none;">Manager Fundraising</td>
        <td style="border:none;">Ka. Div Keuangan</td>
        <td style="border:none;">Admin Fundraising</td>
        <td style="border:none;">Staff ProfZIS</td>
      </tr>
    </table>
    </div>
  </body>
</html>
