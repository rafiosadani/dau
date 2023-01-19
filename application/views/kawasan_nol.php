<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('partials/head') ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
    <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/css/dataTables.checkboxes.css"
        rel="stylesheet" />
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
                    Rekap Kawasan Kurang Target
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Rekap Kawasan Kurang Target</li>
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
                                <h3 class="box-title">Filter Pencarian</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <form action="" method="post" target="_blank">
                                      <div class="form-group">
                                          <div class="col-sm-4">
                                              <label for="kodej" class="control-label">Prozis<span style="color: red">
                                                      *</span></label>
                                              <select class="form-control selectpicker" id="kodej" name="kodej" data-live-search="true">
                                                  <?php foreach($jungut as $jungut) : ?>
                                                  <option name="kodej" value="<?php echo $jungut->kodej."|".$jungut->name; ?>"><?php echo $jungut->kodej." - ".$jungut->name ?></option>
                                                  <?php endforeach; ?>
                                              </select>
                                          </div>
                                          <div class="col-sm-4">
                                              <label for="date" class="control-label">Tanggal<span style="color: red">
                                                      *</span></label>
                                              <div class="input-group date">
                                                  <div class="input-group-addon">
                                                      <i class="fa fa-calendar"></i>
                                                  </div>
                                                  <input type="text" class="form-control daterange-btn" id="date" name="date" />
                                              </div>
                                          </div>

                                          <div class="col-sm-2">
                                              <label for="button"> </label>
                                              <button id="btnsubmit" type="button" name="button" class="btn btn-block btn-success">
                                                  Submit
                                                  <span><i class="fa fa-search"></i></span>
                                              </button>
                                          </div>
										  <?php if($this->input->get('tgl')&&$this->input->get('kp')){?>
                                          <div class="col-sm-1" id="btnhd">
                                            <label for="excel"></label>
                                              <button type="submit" name="btnexcel" class="btn btn-block btn-primary" value=" "><span class="fa fa-file-excel-o"></span></button>
                                            </div>
                                          <div class="col-sm-1" id="btnhdd">
                                            <label for="cetak"></label>
                                              <button type="submit" name="btncetak" class="btn btn-block btn-info" value=" "><span class="glyphicon glyphicon-print text-light"></span></button>
                                            </div>
										  <?php } ?>
                                      </div>
                                    </form>
                                </div>

                                <!-- /.box-body -->
                            </div>
                            <!-- </form> -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->

                </div>
                <!-- /.row (main row) -->

                <?php
                  // Load library phpspreadsheet
                  if ($this->input->post('btncetak')) {
                    list($jungut,$nm_jungut) = explode('|', $_POST['kodej']);
                    $tgl = $this->input->post('date');
                    header("location:".base_url()."report/kawasan-kurang-target/rekap?jungut=$jungut&&tgl=$tgl&&nm=$nm_jungut");
                  }elseif ($this->input->post('btnexcel')){
                    list($jungut,$nm_jungut) = explode('|', $_POST['kodej']);
                    $tgl = $this->input->post('date');
                    header("location:".base_url()."report/kawasan-kurang-target/excel?jungut=$jungut&&tgl=$tgl");
                  }
                 ?>
				<?php if($this->input->get('tgl')&&$this->input->get('kp')){?>
                <div class="row" id="divTable">
                    <div class="col-xs-12">
                        <div class="box box-info">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="table" class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">No.</th>
												<th rowspan="2"></th>
                                                <th rowspan="2">Kawasan</th>
                                                <th rowspan="2">Nama Kawasan</th>
                                                <th colspan="2">Target</th>
                                                <th colspan="2">Kurang Target</th>
                                                <th rowspan="2">RK</th>
                                            </tr>
                                            <tr>
                                              <th>Donatur</th>
                                              <th>Donasi</th>
                                              <th>Donatur</th>
                                              <th>Donasi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
										<?php list($jungut,$nm_jungut) = explode('|', $_GET['kp']);
										$tanggal = $this->input->get('tgl');
										$kodejj = $this->input->get('kp');
										$tgl = explode(' - ', $this->input->get('tgl'));
										$tgl1 = $tgl[0]; $tgl2 = $tgl[1];
										foreach ($this->mkwsn_nol->getKawasanNol($jungut,$tgl1,$tgl2) as $no => $tampil) :
										?>
										<script>
											<?php if($no != ''){  ?>
											$('#btnhd').show();
											$('#btnhdd').show();
											<?php	
											}
											?>
										</script>
										
										<tr>
											<td><?php echo $no+1?> </td>
											<td><a href="<?php echo base_url('report/kawasan-kurang-target/data?kwsn='.$tampil->kwsn.'&&tgl='.$tanggal.'&&kodej='.$kodejj)?>" target="_blank"><button class="btn btn-info"><span class="glyphicon glyphicon-print text-light"></span></button></a></td>
											<td><?php echo $tampil->kwsn.'/'.$tampil->kwsn_lm?> </td>
											<td><?php echo $tampil->ins_pk?> </td>
											<?php foreach ($this->mkwsn_nol->getTarget($tampil->Bulan,$tampil->tahun,$tampil->kodej,$tampil->kwsn) as $v) : ?>
												<td><?php echo $v->t_dnt?></td>
												<td><?php echo number_format($v->t_dns,0,'.','.') ?></td>
											<?php endforeach; ?>
											<td><?php echo $tampil->noid?> </td>
											<td><?php echo number_format($tampil->infaq,0,'.','.') ?></td>											<td><?php echo $tampil->rk?> </td>
										</tr>
										<?php endforeach;?>
										</tbody>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->

                </div>
				<?php } ?>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php $this->load->view('partials/footer') ?>


    </div>
    <!-- ./wrapper -->

    <?php $this->load->view('partials/modal') ?>

    <!-- <script>
    function deleteConfirm(url) {
      $('#btn-delete').attr('href', url);
      // $('#Delete').modal();
    }
  </script> -->
</body>
<?php $this->load->view('partials/js') ?>
<script type="text/javascript"
    src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<?php $kp = $this->input->get('kp')?>
<script>
    $(document).ready(function () {
		<?php if($this->input->get('tgl')&&$this->input->get('kp')){?>
		$('select#kodej').selectpicker("val" , '<?php echo $kp  ?>');
		<?php } ?>
        $("#table").DataTable();
        $(function () {
            $('.daterange-btn').daterangepicker(
                {
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    locale: {
                        format: 'YYYY-MM-DD'
                    },
                    startDate: moment().startOf('month'),
                    endDate: moment().endOf('month')
                },
                function (start, end) {
                    $('.daterange-btn').html(start.format('YYYY-MM-DD') + ' ~ ' + end.format('YYYY-MM-DD'))
                }

            )

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            })
        });

        $("#btnsubmit").click(function() {
			var kodej = $("select#kodej").children("option:selected").val();
            var date = $("#date").val();
  			window.location.href = "<?php echo base_url('report/kawasan-kurang-target?tgl=') ?>" + date + "<?php echo '&&kp='?>"+ kodej;
			            
            
        });
        // $("#table").dataTable();
    });
</script>

</html>
