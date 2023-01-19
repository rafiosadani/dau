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
          Draft SMS Donatur
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Draft SMS Donatur</li>
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
                <h3 class="box-title">Data Draft Donatur</h3>
                <a href="<?php echo base_url('draft-sms-donatur/baru') ?>"><button class="btn btn-primary" style="margin-left: 15px"><span class="glyphicon glyphicon-plus text-light"></span><b>  Baru</b></button></a>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">

                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th width="25px;">Action</th>
                      <th width="15px;">No</th>
                      <th>Judul</th>
                      <th>Isi SMS</th>
                      <th width="10px;"></th>
                    </tr>
                  </thead>
 
                  <tbody>
                    <?php foreach ($draft as $key => $user) : ?>
                    <tr>
                      <td>
                        <a href="<?php echo base_url('draft-sms-donatur/edit/'.$user['sms_id']) ?>"><button class="btn btn-info"><span class="glyphicon glyphicon-pencil text-light"></span></button></a>
                        <a onclick="deleteConfirm('<?php echo base_url('draft-sms-donatur/delete/'.$user['sms_id']) ?>')" href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal-delete"><span class="glyphicon glyphicon-trash text-light"></span></a>
                      </td>
                      <td style="font-weight:600; font-size: 14px;">
                        <?php echo $key+1 ?>
                      </td>
                      <td style="font-weight:600; font-size: 14px;">
                        <?php echo $user['judul'] ?>
                      </td>
                      <td style="font-weight:600; font-size: 14px;">
                        <?php echo $user['isi_sms'] ?>
                      </td>
                      <td>
                        <form action="<?php echo base_url('kirim-sms-donatur')?>" method="post">
                          <input type="hidden" name="iddraft" value="<?= $user['sms_id']; ?>">
                          <input type="hidden" name="juduldraft" value="<?= $user['judul']; ?>">
                          <input type="hidden" name="isi_smsdraft" value="<?= $user['isi_sms']; ?>">
                          <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus text-light"></span> Buat Pesan</i></button>
                        </form>
                      </td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>

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
