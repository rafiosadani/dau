<!DOCTYPE html>
<html>

<head>
  <?php $this->load->view('partials/head') ?>
  <script src="https://cdn.jsdelivr.net/npm/table-to-json@0.13.0/lib/jquery.tabletojson.min.js" integrity="sha256-AqDz23QC5g2yyhRaZcEGhMMZwQnp8fC6sCZpf+e7pnw=" crossorigin="anonymous"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php $this->load->view('partials/header') ?>
    <!-- Left side column. contains the logo and sidebar -->
    <?php $this->load->view('partials/sidebar') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Donasi
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Donasi</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content-header">

        <!-- /.row -->
        <!-- Main row -->
        <form class="form-horizontal" action="<?php echo base_url("donatur/addKeu_j") ?>" method="post" target="_blank">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">Donasi</h3>

                </div>
                <div class="box-body">
                  <div class="form-group">
                    <div class="col-sm-5">
                      <label for="ID Donatur" class="control-label">ID Donatur<span style="color: red"> *</span></label>
                      <select id="iddonatur" class="form-control selectpicker" name="iddonatur" data-live-search="true" required>
                        <option value="">-</option>
                        <?php foreach($donasi as $tampil) : ?>
                          <option name="prov" value="<?php echo $tampil->noid ?>"><?php echo $tampil->noid ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-sm-5">
                      <label for="alamat" class="control-label">Alamat</label>
                      <input type="text" required name="alamat" id="alamat" class="form-control" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-5">
                      <label for="nama" class="control-label">Nama</label>
                      <input type="text" required name="nama" id="nama" class="form-control" value="">
                    </div>
                    <div class="col-sm-5">
                      <label for="Program" class="control-label">Program</label>
                      <select id="program" class="form-control selectpicker" data-live-search="true" name="program" required>
                        <?php foreach($program as $tampil) : ?>
                          <option name="program" value="<?php echo $tampil->PROG ?>"><?php echo $tampil->NM_PROGRAM ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-5">
                      <label for="kodekawasan" class="control-label">Kode Kawasan</label>
                      <input type="text" required name="kodekawasan" id="kodekawasan" class="form-control" value="">
                    </div>
                    <div class="col-sm-5">
                      <label for="Nominal" class="control-label">Nominal</label>
                      <input id="rupiah" class="form-control" required type="number" name="nominal" placeholder="Masukkan Nominal">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-5">
                      <label for="kodeprozis" class="control-label">Kode Prozis</label>
                      <select id="kodeprozis" class="form-control selectpicker" data-live-search="true" name="kodeprozis" required>
                        <option></option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-5">
                      <label for="Instansi" class="control-label">Instansi</label>
                      <input type="text" required name="instansi" id="instansi" class="form-control" value="">
                    </div>
                    <div class="col-sm-5" style="padding-top:27px;">
                      <b style="font-size:20px;"><input type="text" id="rph" disabled value="" style="background:none;border:none;"></b>
                      <button type="submit" name="btn-cetak" class="btn btn-info" style="margin-right: 15px;float: right"><span class="glyphicon glyphicon-print text-light"></span><b>    Print</b></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-body -->

          <!-- /.box-footer -->
        </form>
        </div>
        <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
        </div>

        </div>
        <!-- /.col -->

        </div>
        <!-- /.row (main row) -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php $this->load->view('partials/footer') ?>


  </div>
  <!-- ./wrapper -->

  <?php $this->load->view('partials/modal') ?>


</body>
<?php $this->load->view('partials/js') ?>
<script>
 $(document).ready(function() {

   $("select#iddonatur").change(function() {
     var iddonatur = $(this).children("option:selected").val();
     var cont = '<option></option>';
     $.ajax({
       type  : 'GET',
       url   : '<?php echo base_url('donatur/getDnsi') ?>',
       data  : {iddonatur : iddonatur},
       async : true,
       dataType : 'json',
       success : function(data){
         for (var i=0;i<data.length;i++) {
           $("#nama").val(data[i].nama);
         }
       }
     });
   });
   $("select#iddonatur").change(function() {
     var iddonatur = $(this).children("option:selected").val();
     var cont = '<option></option>';
     $.ajax({
       type  : 'GET',
       url   : '<?php echo base_url('donatur/getDnsi') ?>',
       data  : {iddonatur : iddonatur},
       async : true,
       dataType : 'json',
       success : function(data){
         for (var i=0;i<data.length;i++) {
          $("#kodekawasan").val(data[i].kwsn);
         };
       }
     });
   });
   $("select#iddonatur").change(function() {
     var iddonatur = $(this).children("option:selected").val();
     var cont = '<option selected></option>';
     $.ajax({
       type  : 'GET',
       url   : '<?php echo base_url('donatur/getDnsi') ?>',
       data  : {iddonatur : iddonatur},
       async : true,
       dataType : 'json',
       success : function(data){
         for (var i=0;i<data.length;i++) {
           cont += '<option selected value="'+data[i].kdprozis+'">'+data[i].kdprozis+'</option>';
           <?php foreach($dtprozis as $tampil) : ?>
           if (<?php echo $tampil->kodej;?> != data[i].kdprozis) {
             cont += '<option value="<?php echo $tampil->kodej ?>"><?php echo $tampil->kodej ?></option>';
           }
           <?php endforeach; ?>
        };
         $("select#kodeprozis").html(cont);
         $('.selectpicker').selectpicker('refresh');
       }
     });
   });
   $("select#iddonatur").change(function() {
     var iddonatur = $(this).children("option:selected").val();
     var cont = '<option></option>';
     $.ajax({
       type  : 'GET',
       url   : '<?php echo base_url('donatur/getDnsi') ?>',
       data  : {iddonatur : iddonatur},
       async : true,
       dataType : 'json',
       success : function(data){
         for (var i=0;i<data.length;i++) {
           $("#instansi").val(data[i].nm_kawasan);
         };
       }
     });
   });

   $("select#iddonatur").change(function() {
     var iddonatur = $(this).children("option:selected").val();
     var cont = '<option></option>';
     $.ajax({
       type  : 'GET',
       url   : '<?php echo base_url('donatur/getDnsi') ?>',
       data  : {iddonatur : iddonatur},
       async : true,
       dataType : 'json',
       success : function(data){
         for (var i=0;i<data.length;i++) {
           $("#alamat").val(data[i].alamat);
         };
       }
     });
   });

   $("select#iddonatur").change(function() {
     var iddonatur = $(this).children("option:selected").val();
     var cont = '<option></option>';
     $.ajax({
       type  : 'GET',
       url   : '<?php echo base_url('donatur/getDnsi') ?>',
       data  : {iddonatur : iddonatur},
       async : true,
       dataType : 'json',
       success : function(data){
         for (var i=0;i<data.length;i++) {
           $("#rupiah").val(data[i].nominal);
         }
       }
     });
   });

   $("select#iddonatur").change(function() {
     var iddonatur = $(this).children("option:selected").val();
     var cont = '<option></option>';
     $.ajax({
       type  : 'GET',
       url   : '<?php echo base_url('donatur/getDnsi') ?>',
       data  : {iddonatur : iddonatur},
       async : true,
       dataType : 'json',
       success : function(data){
         for (var i=0;i<data.length;i++) {
           var donasin = data[i].nominal;
           var reverse = donasin.toString().split('').reverse().join(''),
           donasi = reverse.match(/\d{1,3}/g);
           donasi = donasi.join('.').split('').reverse().join('');
           $("#rph").val('Rp. '+donasi+',00');
         }
       }
     });
   });


 });
</script>

<script type="text/javascript">

  var rupiah = document.getElementById('rupiah');
  var rph = document.getElementById('rph');
  rupiah.addEventListener('keyup', function(e){
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
  rph.value = formatRupiah(this.value, 'Rp. ');
  });

  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : 'Rp.0') + ',00';
  }
</script>
</html>
