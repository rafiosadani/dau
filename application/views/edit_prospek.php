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
          Edit Prospek
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="<?php echo base_url('data/donatur') ?>">Setup</a></li>
          <li class="active">Edit Prospek</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- /.row -->
        <!-- Main row -->
        <form class="form-horizontal" action="<?php echo base_url("prospek/edit") ?>" method="post">
          <div class="row">
            <div class="col-xs-12">
              <div class="nav-tabs-custom">
			  	<div class="box-body">
				  <div class="col-sm-5">
					<label for="status" class="control-label">Nama Prospek<span style="color: red"> *</span></label>
					<div class="input-group">
						<?php 
						foreach ($prospek as $value) {
							?>
							<span class="input-group-addon"><?= $value->INFO?></span>
              <input type="hidden" name="info" value="<?= $value->INFO?>">
							<?php	
						}
						?>
						<input type="text" class="form-control" name="prospek" value="<?= $value->NM_INFO?>" required>
					</div>
				  </div>
				  <div class="col-sm-3" style="padding-top:27px;">
				  	<input type="submit" name="submit" class="btn btn-info" value="Edit Prospek" />
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
