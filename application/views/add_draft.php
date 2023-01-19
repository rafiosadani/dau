<!DOCTYPE html>
<html>

<head>
  <?php $this->load->view('partials/head') ?>
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
          Add Draft SMS Donatur
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Draft Baru</li>
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
                <h3 class="box-title">Add Draft Donatur</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">
                <form action="<?= base_url('draft-sms-donatur/baru')?>" method="post">
                  <div class="row">
                    <div class="form-group">
                      <div class="col-sm-5">
                        <label for="judul" class="control-label">Judul<span style="color: red"> *</span></label>
                        <?php if ($this->input->post('juduldraft') != "" && $this->input->post('isidraft') != ""): ?>
                          <input type="text" class="form-control" id="judul" name="judul" placeholder="Add Judul Draft" value="<?= $this->input->post('juduldraft') ?>" autocomplete="off">
                        <?php else : ?>
                          <input type="text" class="form-control" id="judul" name="judul" placeholder="Add Judul Draft" autocomplete="off">
                          <small class="form-text text-danger"><?= form_error('judul'); ?></small>
                        <?php endif ?>
                    </div>
                  </div>
                </div>
                  <div class="row">
                    <div class="form-group">
                      <div class="col-sm-5">
                        <label for="isi" class="control-label">Isi SMS<span style="color: red"> *</span></label>
                        <?php if ($this->input->post('juduldraft') != "" && $this->input->post('isidraft') != ""): ?>
                          <textarea name="isi" id="isi" class="form-control" rows="8"><?= $this->input->post('isidraft'); ?></textarea>
                        <?php else : ?>
                          <textarea name="isi" id="isi" class="form-control" rows="8"></textarea>  
                          <small class="form-text text-danger"><?= form_error('isi'); ?></small>
                        <?php endif; ?>
                      </div>
                    </div>
                </div>
                <div class="row">
                   <div class="form-group">
                      <div class="col-sm-5">
                        <br>
                        <button type="submit" class="btn btn-info" style="float: right;"><i class="fa fa-plus"></i> Add</button>
                      </div>
                    </div>
                </div>
              </form>
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

  <script>
    function deleteConfirm(url) {
      $('#btn-delete').attr('href', url);
      // $('#Delete').modal();
    }
  </script>
</body>
<?php $this->load->view('partials/js') ?>
<script>
  $(function () {
    $('#example1').DataTable()
  })
</script>

</html>
