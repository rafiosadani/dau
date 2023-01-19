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
          Dashboard
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">User</li>
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
                <h3 class="box-title">Data User</h3>
                <a href="<?php echo base_url('user/baru') ?>"><button class="btn btn-primary" style="margin-left: 15px"><span class="glyphicon glyphicon-plus text-light"></span><b>  Baru</b></button></a>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">

                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Action</th>
                      <th>No</th>
                      <th>UsrId</th>
                      <th>username</th>
                      <th>password</th>
                      <th>name</th>
                      <th>email</th>
                      <th>idcab</th>
                      <th>cabang</th>
                      <th>active</th>
                      <th>privAdmin</th>
                      <th>idpusat</th>
                      <th>kodej</th>
                      <th>kodep</th>
                      <th>level</th>
                      <th>hak</th>
                      <th>lapangan</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php foreach ($user as $key => $user) : ?>
                    <tr>
                      <td>
                        <a href="<?php echo base_url('user/edit/'.$user->usrid) ?>"><button class="btn btn-info"><span
                              class="glyphicon glyphicon-pencil text-light"></span></button></a>
                        <a onclick="deleteConfirm('<?php echo base_url('page/deleteUser/'.$user->usrid) ?>')" href="#"
                          class="btn btn-danger" data-toggle="modal" data-target="#modal-delete"><span class="glyphicon glyphicon-trash text-light"></span></a>
                      </td>
                      <td style="font-weight:400;">
                        <?php echo $key+1 ?>
                      </td>
                      <td style="font-weight:400;">
                        <?php echo $user->usrid ?>
                      </td>
                      <td style="font-weight:400;">
                        <?php echo $user->login ?>
                      </td>
                      <td style="font-weight:400;">
                        <?php echo $user->pswd ?>
                      </td>
                      <td style="font-weight:400;">
                        <?php echo $user->name ?>
                      </td>
                      <td style="font-weight:400;">
                        <?php echo $user->email ?>
                      </td>
                      <td style="font-weight:400;">
                        <?php echo $user->idcabang ?>
                      </td>
                      <td style="font-weight:400;">
                        <?php echo $user->nm_cabang ?>
                      </td>
                      <td style="font-weight:400;">
                        <?php echo $user->active ?>
                      </td>
                      <td style="font-weight:400;">
                        <?php echo $user->priv_admin ?>
                      </td>
                      <td style="font-weight:400;">
                        <?php echo $user->idpusat ?>
                      </td>
                      <td style="font-weight:400;">
                        <?php echo $user->kodej ?>
                      </td>
                      <td style="font-weight:400;">
                        <?php echo $user->kodep ?>
                      </td>
                      <td style="font-weight:400;">
                        <?php echo $user->level ?>
                      </td>
                      <td style="font-weight:400;">
                        <?php echo $user->hak ?>
                      </td>
                      <td style="font-weight:400;">
                        <?php echo $user->lapangan ?>
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
