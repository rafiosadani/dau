<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php $this->load->view('partials/head') ?>
    <style type="text/css">
    body{
      font-family: arial;
      font-size: 12px;
      color: black;
    }
    </style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <?php
      function tgl_indo($tanggal){
      $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
      );
      $pecahkan = explode('-', $tanggal);
      return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
      }
     ?>
    <div class="box-body table-responsive">
      <table align="center" style="margin-top:8%">
        <tr>
          <td> <b><?php echo $noid ?></b> </td>
        </tr>
        <tr>
          <td> <b><?php echo $nama ?></b> </td>
        </tr>
        <tr>
          <td> <b><?php echo $alamat ?></b> </td>
        </tr>
        <tr>
          <td> <b><?php echo $instansi ?></b> </td>
        </tr>
        <tr>
          <td> <b><?php echo $kodekawasan ?></b> <b style="padding-left:10px;">Kode Prozis <?php echo $kodeprozis ?></b> </td>
        </tr>
        <tr>
          <td> <b><?php echo tgl_indo(date('Y-m-d')); ?></b> </td>
        </tr>
        <tr>
          <td> <b><?php echo $nominal ?></b> </td>
        </tr>
    </div>
    <div class="box-body table-responsive">
      <table align="center" style="margin-top:8%">
        <tr>
          <td> <b><?php echo $noid ?></b> </td>
        </tr>
        <tr>
          <td> <b><?php echo $nama ?></b> </td>
        </tr>
        <tr>
          <td> <b><?php echo $alamat ?></b> </td>
        </tr>
        <tr>
          <td> <b><?php echo $instansi ?></b> </td>
        </tr>
        <tr>
          <td> <b><?php echo $kodekawasan ?></b> <b style="padding-left:10px;">Kode Prozis <?php echo $kodeprozis ?></b> </td>
        </tr>
        <tr>
          <td> <b><?php echo tgl_indo(date('Y-m-d')); ?></b> </td>
        </tr>
        <tr>
          <td> <b><?php echo $nominal ?></b> </td>
        </tr>
    </div>
  </body>
</html>
