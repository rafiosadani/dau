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
                    Validasi Kasir
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Validasi Kasir</li>
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
                                    <form action="" method="post">
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

                                            <div class="col-sm-2">
                                                <label for="button"> </label>
                                                <button id="btnsubmit" type="button" name="button" class="btn btn-block btn-success">
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

                <div class="row" id="divTable" style="display:none;">
                    <div class="col-xs-12">
                        <div class="box box-info">
                            <div class="box-header">
                                <h5 class="text-center" >Validasi : Rp. <span id="tervalidasi">-</span> | Belum Validasi : Rp. <span id="belum-validasi">-</span></h5>
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
                                                <th>Action</th>
                                                <th>No Slip</th>
                                                <th>Tgl Setor</th>
                                                <th>Bank</th>
                                                <th>Jumlah</th>
                                                <th>Keterangan</th>
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
    <div class="modal fade" id="modal-validasi">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Validasi Kasir</h4>
      </div>
      <form class="form-vertical" id="form-val" method="post">
      <div class="modal-body">
        <div class="form-group">
          <label for="modal-noslip" class="control-label">noslip</label>
                          <input id="modal-noslip" type="text" class="form-control" name="noslip" readonly>
          </div>
        <div class="form-group">
        <label for="modal-jumlah" class="control-label">Jumlah</label>
            <input id="modal-jumlah" type="number" class="form-control" name="jumlah" readonly>
          </div>
          <div class="form-group">
          <label for="modal-bank" class="control-label">Bank<span style="color: red"> *</span></label>
            <select id="modal-bank" class="form-control selectpicker" name="bank" data-live-search="true" required>
              <?php foreach($BANK as $BANK) : ?>
                <option name="bank" value="<?php echo $BANK->BANK ?>"><?php echo $BANK->NM_BANK ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
          <label for="modal-noksr" class="control-label">no.kasir</label>
              <input id="modal-noksr" type="number" class="form-control" name="noksr">
          </div>
          <div class="form-group">
          <label for="modal-ket" class="control-label">Keterangan</label>
                          <input id="modal-ket" type="text" class="form-control" name="ket">
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-success" id="val-btn">Validasi</button>
      </div></form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

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

        function numberFormat(angka) {
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
            return rupiah.split('',rupiah.length-1).reverse().join('');
        }

        function tampil() {
            $("#table").DataTable().destroy();
            $('#divTable').show();
            var kodej = $("select#kodej").children("option:selected").val();
            var date = $("#date").val();
            // console.log(date);
            var cont = "";
            var tervalidasi = 0;
            var blmvalidasi = 0;
            $.ajax({
                type  : 'GET',
                url   : '<?php echo base_url('valkasir/getData') ?>',
                data  : {
                    kodej : kodej,
                    date : date,
                },
                async : true,
                dataType : 'json',
                success : function(data) {
                    for (var i=0;i<data.length;i++) {
                        var action = "";
                        var kwit = false;
                        for (b = 0;b<data[i].kwitansi.length;b++) {
                            var kwitansi = data[i].kwitansi[b];
                            if (kwitansi.cek > 0) {
                                kwit = true;
                            } else {
                                kwit = false;
                            }
                        }

                        if (data[i].validasi == 'Sudah') {
                            tervalidasi += parseInt(data[i].jumlah);
                            if (kwit == true) {
                                action = '<td><a href="<?php echo base_url('front-office/validasi-kasir/rekap-kasir/')?>'+ data[i].noslip +'" target="_blank"><button class="btn btn-success"><span class="glyphicon glyphicon-print text-light"></span></button></a>'+
                                '<a href="<?php echo base_url('front-office/validasi-kasir/rekap-batal/')?>'+ data[i].noslip +'" target="_blank"><button class="btn btn-success"><span class="glyphicon glyphicon-print text-light"></span></button></a>'+
                                '<a href="<?php echo base_url('front-office/validasi-kasir/rekap-klaim/')?>'+ data[i].noslip +'" target="_blank"><button class="btn btn-success"><span class="glyphicon glyphicon-print text-light"></span></button></a></td>';
                            } else {
                                action = '<td><a href="<?php echo base_url('front-office/validasi-kasir/rekap-kasir/')?>'+ data[i].noslip +'" target="_blank"><button class="btn btn-success"><span class="glyphicon glyphicon-print text-light"></span></button></a></td>';
                            }
                        } else {
                            blmvalidasi += parseInt(data[i].jumlah);
                            action = '<td><button id="btn-val" class="btn btn-danger" data-toggle="modal" data-target="#modal-validasi"><span class="glyphicon glyphicon-plus text-light"></span></button></td>';
                        }

                        var strdate = new Date(data[i].tgl_setor);
                        var tanggal = moment(strdate).format('DD-MM-YYYY');

                        cont += '<tr noslip="'+ data[i].noslip +'" jumlah="'+ data[i].jumlah +'" ket="'+ data[i].ket +'" bank="'+ data[i].bank +'" noksr="'+ data[i].no_kasir +'" >'+action+
                            '<td>'+ data[i].noslip +'</td>'+
                            '<td>'+ tanggal +'</td>'+
                            '<td>'+ data[i].bank +'</td>'+
                            '<td>'+ numberFormat(data[i].jumlah) +'</td>'+
                            '<td>'+ data[i].ket +'</td>'+
                            '</tr>';
                    }
                    $("span#tervalidasi").html(numberFormat(tervalidasi));
                    $("span#belum-validasi").html(numberFormat(blmvalidasi));
                    $("#tbody").html(cont);
                    $("#table").DataTable();
                    // console.log(kwit);
                }
            });
        }

        $("#btnsubmit").click(function() {
            // $("#table").DataTable();
            // $("#table").DataTable().destroy();
            // $("#table tbody").remove();
            tampil();
            $("#table tbody tr").each(function(){
                $(this).remove();
            });
            $("span#tervalidasi").html("");
            $("span#belum-validasi").html("");
        });

        $(document).on('click', 'button#btn-val', function () {
            var _this = $(this).closest('tr');
            var noslip = $(_this).attr('noslip');
            var jumlah = $(_this).attr('jumlah');
            var bank = $(_this).attr('bank');
            var ket = $(_this).attr('ket');
            var noksr = $(_this).attr('noksr');

            $("#modal-noslip").val(noslip);
            $("#modal-jumlah").val(jumlah);
            $("#modal-bank").val(bank);
            $("#modal-ket").val(ket);
            $("#modal-noksr").val(noksr);
            $(".selectpicker").selectpicker("refresh");
            // console.log($("#form-val").attr("action"));
        });

        $(document).on('click', 'button#val-btn', function () {
            var noslip = $("#modal-noslip").val();
            var bank = $("#modal-bank").val();
            var ket = $("#modal-ket").val();
            var noksr = $("#modal-noksr").val();
            $.ajax({
                type : 'POST',
                url : '<?php echo base_url('valkasir/updateVal') ?>',
                data : {
                    noslip : noslip,
                    bank : bank,
                    ket : ket,
                    noksr : noksr
                },
                async : true,
                dataType : 'json',
                success : function(data) {
                    window.open('<?php echo base_url('front-office/validasi-kasir/rekap-kasir/')?>'+ noslip, '_blank');
                    tampil();
                    $('#modal-validasi').modal('hide');
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
