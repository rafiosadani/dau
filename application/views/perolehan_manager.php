<!DOCTYPE html>
<html>

<head>
  <?php $this->load->view('partials/head') ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
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
          Report
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Rekap Perolehan Manager</li>
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
                        <h3 class="box-title">Rekap Perolehan Manager</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <form action="<?php echo base_url('report/perolehan-manager/cetak') ?>" method="post" target="_blank" >
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <label for="kodej" class="control-label">Jungut<span style="color: red">
                                                *</span></label>
                                        <select class="form-control selectpicker" id="kodej" name="kodej" data-live-search="true">
                                            <?php foreach($jungut as $jungut) : ?>
                                            <option name="kodej" value="<?php echo $jungut->kodej ?>"><?php echo $jungut->kodej." - ".$jungut->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-5">
                                        <label for="date" class="control-label">Tanggal<span style="color: red">
                                                *</span></label>
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control daterange-btn" id="date" name="date" />
                                        </div>
                                    </div>

                                    <div class="col-sm-2" style="padding-top:5px;">
                                        <label for="button"> </label>
                                        <button id="btnsubmit" type="submit" value="" name="btncetak" class="btn btn-block btn-success" value="">
                                            Submit
                                            <span><iclass="fa fa-search"></i></span>
                                        </button>
                                    </div>
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
<script>
//   $(function () {
//     $('#example1').DataTable()
//   })
// </script>
<script>
  $(function () {
    $('.daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
            format: 'YYYY-MM-DD'
      },
        startDate: moment().startOf('month'),
        endDate  : moment().endOf('month')
      },
      function (start, end) {
        $('.daterange-btn').html(start.format('YYYY-MM-DD') + ' ~ ' + end.format('YYYY-MM-DD'))
      }

    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
  })
</script>

</html>
