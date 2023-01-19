<!DOCTYPE html>
<html>

<head>
  <?php $this->load->view('partials/head') ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">

    <div class="flashdata" data-flashdata="<?php echo $this->session->flashdata('flash')?>">
        
    </div>
    <div class="flashdata2" data-flashdata2="<?php echo $this->session->flashdata('flash2')?>">
        
    </div>
    <div class="flashdata3" data-flashdata3="<?php echo $this->session->flashdata('flash3')?>">
        
    </div>
    <div class="flashdata4" data-flashdata4="<?php echo $this->session->flashdata('flash4')?>">
        
    </div>
    <div class="flashdata5" data-flashdata5="<?php echo $this->session->flashdata('flash5')?>">
        
    </div>
  <div class="wrapper">

    <?php $this->load->view('partials/header') ?>
    <!-- Left side column. contains the logo and sidebar -->
    <?php if ($this->session->userdata('admin') == TRUE): ?>
        <?php $this->load->view('partials/sidebar') ?>
    <?php endif; ?>
    <?php if ($this->session->userdata('admin') != TRUE): ?>
        <?php $this->load->view('partials/sidebar_user') ?>
    <?php endif; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
        ImportDB
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">ImportDB</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <div class="col-xs-12">
            <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title">keu_j</h3>
              </div>
              <!-- /.box-header -->
              
              <div class="box-body" style="height: 380px">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-5">
                      <label for="file" class="control-label">Pilih File <span style="color: red">( .txt )</span></label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3" style="padding-bottom:5px;" >
                        <form action="<?php echo base_url('importDB/keu_j') ?>" id="form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="nama_file" id="nm_file" value="">
                        <input type="file" id="file" name="berkas" style="display:none;">
                        <?php
                        if($this->input->post('nama_file')){?>
                          <input class="form-control" type="text" value="<?php echo $this->input->post('nama_file'); ?>" id="filename" readonly onclick="document.getElementById('file').click()">
                        <?}else{?>
                          <input class="form-control" type="text" id="filename" readonly onclick="document.getElementById('file').click()">                        
                        <?}?>
                    </div>
                    <div class="col-sm-1" style="padding-bottom:5px;">
                      <input type="button" class="btn btn-block btn-success" value="Browse" onclick="document.getElementById('file').click()">
                      </form>
                    </div>
                    <div class="col-sm-1" style="padding-bottom:20px;">
                      <form action="<?php echo base_url('importdb/updateKeu') ?>" method="post">
                      <button type="submit" class="btn btn-block btn-primary">Import</button>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                   <?php if($this->input->post('nama_file')){?>
                    <div class="col-sm-12">
                        <textarea style="float: left;margin-top:-20px;width: 100%;outline: none;resize: none;" name="isi" id="" cols="150" rows="10"><?php
                        $lines = file(base_url('import/import_keu_j.txt'));
                        foreach ($lines as $line){print $line;}?></textarea>
                        </form>
                    </div>
                  <?}else{?>
                    <div class="col-sm-12">
                        <textarea style="float: left;margin-top:-20px;width: 100%;outline: none;resize: none;" name="isi" id="" cols="150" rows="10">
                        </textarea>
                        </form>
                    </div>
                  <?}?>
                  </div>
                </div>
              </div>
              

              <!-- /.box-body -->
            </div>
            <!-- /.box -->
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
const flashdata = $('.flashdata').data('flashdata');
const flashdata2 = $('.flashdata2').data('flashdata2');
const flashdata3 = $('.flashdata3').data('flashdata3');
const flashdata4 = $('.flashdata4').data('flashdata4');
const flashdata5 = $('.flashdata5').data('flashdata5');


if(flashdata){
    Swal.fire({
        title: 'Import',
        text: 'Berhasil ' + flashdata,
        type: 'success'
    });
}

if(flashdata2){
    Swal.fire({
        title: 'Duplicate',
        text: 'Data yang anda input sudah ' + flashdata2,
        type: 'warning'
    });
}

if(flashdata3){
    Swal.fire({
        title: 'Kesalahan',
        text: 'File yang dipilih harus ' + flashdata3,
        type: 'error'
    });
}

if(flashdata4){
    Swal.fire({
        title: 'Kesalahan',
        text: 'Pilih file untuk ' + flashdata4,
        type: 'error'
    });
}

if(flashdata5){
    Swal.fire({
        title: 'Kesalahan',
        text: 'Program tidak bisa membaca file yang anda ' + flashdata5,
        type: 'error'
    });
}
</script>
<script>
    // var nama_file = $("#filename").val();
    // $("#nm_file").val(nama_file);
    document.getElementById("file").onchange = function() {
    document.getElementById("nm_file").value=this.value;
    document.getElementById("form").submit();
};
</script>

</html>
