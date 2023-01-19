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
          Setup
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Prospek by</li>
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
                <h3 class="box-title">Prospek</h3>
                <?php foreach ($prospek as $key => $tampil) { ?>
                <?} $keyy= $key + 2;?>
                <a href="<?php echo base_url('setup/prospek/baru?new='.$keyy) ?>"><button class="btn btn-primary" style="margin-left: 15px"><span class="glyphicon glyphicon-plus text-light"></span><b>  Baru</b></button></a>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">

                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Action</th>
                      <th>No</th>
                      <th>Prospek By</th>
                    </tr>
                  </thead>
 
                  <tbody>
                    <?php foreach ($prospek as $key => $tampil) : ?>
                    <tr>
                      <td style="width:90px;">

                        <a href="<?php echo base_url('setup/prospek/edit/'.$tampil->INFO) ?>"><button class="btn btn-info"><span
                              class="glyphicon glyphicon-pencil text-light"></span></button></a>
                        <a onclick="deleteConfirm('<?php echo base_url('Prospek/deleteProspek/'.$tampil->INFO) ?>')" href="#"
                          class="btn btn-danger" data-toggle="modal" data-target="#modal-delete"><span class="glyphicon glyphicon-trash text-light"></span></a>

                      </td>
                      <td style="width:10px;" >
                        <?php echo $key+1 ?>
                      </td>
                      <td>
                        <?php echo $tampil->NM_INFO ?>
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
