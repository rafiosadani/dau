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
                    Report Sms Inbox
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Report Sms Inbox</li>
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
                                          <div class="col-sm-5">
                                              <label for="date" class="control-label">Tanggal Sms Masuk<span style="color: red">
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
                                              <button id="btnsubmit" type="button" name="button" class="btn btn-block btn-success">
                                                  Submit
                                                  <span><i class="fa fa-search"></i></span>
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

                <div class="row" id="divTable" style="display:none;">
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
                                                <th>No</th>
                                                <th>No Telp</th>
                                                <th>Tanggal</th>
                                                <th>Noid</th>
                                                <th>Nama</th>
                                                <th>Isi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbody">
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
<?php $this->load->view('partials/js'); ?>
<script type="text/javascript"
    src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<script>
    $(document).ready(function () {

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
            $("#table").DataTable().destroy();
            $('#divTable').show();
            var date = $("#date").val();
            // console.log(date);
            var cont = "";
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url('sms_inbox/getData') ?>',
                data  : {
                    date : date,
                },
                async : true,
                dataType : 'json',
                success : function(data){
                    for (var i=0;i<data.length;i++) {
                        var str = data[i].tgl;
                        var tgl = str.substring(0, 10);
                        cont += "<tr><td style='width:5px;'>"+ (i+1) +'</td>'+
                        '<td>'+ data[i].hp+'</td>'+
                        '<td>'+tgl+'</td>'+
                        '<td>'+data[i].noid+'</td>'+
                        '<td>'+data[i].nama+'</td>'+
                        '<td>'+ data[i].isi+'</td>'+
                        '</tr>';
                    }
                    $("#tbody").html(cont);
                    $("#table").DataTable();
                    // $('.selectpicker').selectpicker('refresh');
                    console.log(data);
                }
            });
        });
    });







    // $(document).ready(function(){
    //     $("#form-val").submit(function(){
    //         $('#modal-validasi').modal('hide');
    //     });
    // });
</script>

</html>
