<!DOCTYPE html>
<html>
<?php $this->load->model('Mdonatur');
if ($keyword == '1') {
  $this->session->unset_userdata('keyword');
}
 ?>
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
          Dashboard
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Data Donatur</li>
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
                <div class="col-sm-2" style="height:29px;padding-top:8px;padding-bottom:26px;padding-left:0;width:120px;">
                  <h3 class="box-title">Data Donatur</h3>
                </div>
                <div class="col-sm-10" style="width:88%;padding-right: 0;">
                  <?php if ($this->session->userdata('admin') == TRUE) : ?>
                    <a href="<?php echo base_url('data/donatur/baru') ?>"><button class="btn btn-primary" style="margin-left:-15px;"><span class="glyphicon glyphicon-plus text-light"></span><b>  Baru</b></button></a>
                  <?php endif; ?>
                  <?php if($this->session->userdata('superadmin')==TRUE || $this->session->userdata('admin_grup')==TRUE): ?>
                    <a href="<?php echo base_url('data/donatur/excel/')?>" target="_blank"><button type="submit" name="btnexcel" class="btn btn-success" style="margin-left:23px" value=" ">  <span class="fa fa-file-excel-o"></span> <b style="padding-left:1px">Excel </b></button></a>
                  <?php endif; ?>
                    <a href="" data-toggle="modal" data-target="#modal-filter2"><button class="btn btn-success" style="float: right"><span class="glyphicon glyphicon-search text-light"></span><b>    Filter</b></button></a>
                </div>
                </form>
              </div>
              <!-- /.box-header -->
              <div class="box-body table-responsive">
                <?php $this->session->set_userdata('donatur',$donatur); ?>
                <p align="center"> Total Jumlah Donatur : <?php if(isset($donatur)){echo $tot_donatur;}?> </p>


                <table id="donatur" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Action</th>
                      <th>Kawasan</th>
                      <th>No.donatur</th>
                      <th>Nama</th>
                      <th>Status</th>
                      <th>Alamat</th>
                      <th>Program</th>
                      <th style="text-align:center;">Proza</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($donatur as $d) : ?>
                    <tr>
                      <td><a href="<?php echo base_url('data/donatur/edit/').$d->autoid ?>"><button class="btn btn-info"><span
                              class="glyphicon glyphicon-pencil text-light"></span></button></a></td>
                      <td><?php echo $d->kwsn ?></td>
                      <td><?php echo $d->noid ?></td>
                      <td><?php echo $d->nama ?></td>
                      <td><?php echo $d->status ?></td>
                      <td><?php echo $d->alamat ?></td>
                      <td>
                        <table class="table table-bordered table-striped table-hover" style="padding: -8px !important">
                          <tr>
                            <td bgcolor="#e0e0e0">Program</td>
                            <td bgcolor="#e0e0e0">Jumlah</td>
                            <td bgcolor="#e0e0e0">Ket</td>
                          </tr>
                          <?php foreach($this->Mdonatur->getDonaturItem($d->autoid) as $v) : ?>
                            <tr>
                              <td><?php echo $v->NM_PROGRAM ?></td>
                              <td><?php echo $v->besar ?></td>
                              <td><?php echo $v->keterangan ?></td>
                            </tr>
                          <?php endforeach; ?>
                        </table>
                      </td>
                      <td><?php echo $d->kodejgt ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>

                <?php echo $this->pagination->create_links(); ?>

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
//   $(function () {
//     $('#example1').DataTable()
//   })
// </script>
<script>
  $('#reportrange').daterangepicker(
  {
    dateLimit: { days: 1000 },
    showDropdowns: true,
    showWeekNumbers: true,
    timePicker: false,
    timePickerIncrement: 1,
    timePicker12Hour: true,
    ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
        'Last 7 Days': [moment().subtract('days', 6), moment()],
        'Last 30 Days': [moment().subtract('days', 29), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
    },
    opens: 'right',
    buttonClasses: ['btn btn-default'],
    applyClass: 'btn-small btn-primary',
    cancelClass: 'btn-small',
    format: 'MM/DD/YYYY',
    separator: ' to ',
    locale: {
        applyLabel: 'Submit',
        fromLabel: 'From',
        toLabel: 'To',
        customRangeLabel: 'Custom Range',
        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        firstDay: 1
    }
  },
    function(start, end) {
        console.log("Callback has been called!");
        $('#tglhimpun').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
        $('#from').val(start.format('YYYY-MM-DD'));
        $('#to').val(end.format('YYYY-MM-DD'));
        var tglhimp = start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD');
        $('#tgl1').val(tglhimp);
        // console.log(tglhimp);
      }
    );
    //Set the initial state of the picker label
    $('#tglhimpun').html("input tanggal");
</script>
<script>
 $(document).ready(function() {

   $("select#prov").change(function() {
     var prov = $(this).children("option:selected").val();
     var cont = '<option value="" selected> - </option>';
     $.ajax({
       type  : 'GET',
       url   : '<?php echo base_url('donatur/getKota') ?>',
       data  : {prov : prov},
       async : true,
       dataType : 'json',
       success : function(data){
         for (var i=0;i<data.length;i++) {
           cont += '<option value="'+data[i].IDKAB+'">'+data[i].NAMA+'</option>';
         }
         $("select#kota").html(cont);
         $('.selectpicker').selectpicker('refresh');
       }
     });
   });
   $("select#kota").change(function() {
     var kabkot = $(this).children("option:selected").val();
     var cont = '<option value="" selected> - </option>';
     $.ajax({
       type  : 'GET',
       url   : '<?php echo base_url('donatur/getKec') ?>',
       data  : {kabkot : kabkot},
       async : true,
       dataType : 'json',
       success : function(data){
         for (var i=0;i<data.length;i++) {
           cont += '<option n class="mdl" value="'+data[i].IDKEC+'">'+data[i].NAMA+'</option>';
         };
         $('#kecamatan').html(cont);
         $('.selectpicker').selectpicker('refresh');
       }
     });
   });
   $("select#kecamatan").change(function() {
     var kec = $(this).children("option:selected").val();
     var cont = '<option value="" selected> - </option>';
     $.ajax({
       type  : 'GET',
       url   : '<?php echo base_url('donatur/getDesa') ?>',
       data  : {kec : kec},
       async : true,
       dataType : 'json',
       success : function(data){
         for (var i=0;i<data.length;i++) {
           cont += '<option n class="mdl" value="'+data[i].IDDESA+'">'+data[i].NAMA+'</option>';
         };
         $('#desa').html(cont);
         $('.selectpicker').selectpicker('refresh');
       }
     });
   });
 });
</script>
</html>
