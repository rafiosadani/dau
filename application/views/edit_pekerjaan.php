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
          Edit Pekerjaan
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo base_url('data/donatur') ?>">Setup</a></li>
          <li class="active">Edit Pekerjaan</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- /.row -->
        <!-- Main row -->
        <form class="form-horizontal" action="<?php echo base_url("pekerjaan/edit") ?>" method="post">
          <div class="row">
            <div class="col-xs-12">
              <div class="nav-tabs-custom">
			  	<div class="box-body">
				  <div class="col-sm-5">
					<label for="status" class="control-label">Nama Pekerjaan<span style="color: red"> *</span></label>
					<div class="input-group">
						<?php 
						foreach ($pekerjaan as $value) {
							?>
							<span class="input-group-addon"><?= $value->PEKERJAAN?></span>
                            <input type="hidden" name="pekerjaan" value="<?= $value->PEKERJAAN?>">
							<?php	
						}
						?>
						<input type="text" class="form-control" name="nama_pekerjaan" value="<?= $value->NM_PEKERJAAN?>" required>
					</div>
				  </div>
				  <div class="col-sm-3" style="padding-top:27px;">
				  	<input type="submit" name="submit" class="btn btn-info" value="Edit Pekerjaan" />
				  </div>
				</div>
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
    </html>
