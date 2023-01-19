<!DOCTYPE html>
<html>

<head>
  <?php $this->load->view('partials/head') ?>
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
  <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/css/dataTables.checkboxes.css" rel="stylesheet" />
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
          Kirim sms donatur
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Kirim sms donatur</li>
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
              <form action="<?php echo base_url('kirim-sms-donatur') ?>" method="post">
              <div class="form-group">
                  <div class="col-sm-5"> 
                    <label for="kodej" class="control-label">Proza<span style="color: red"> *</span></label>
                    <select class="form-control selectpicker" id="jungut" name="kodej" data-live-search="true">
                        <option value="null" disabled <?php if(empty($this->session->userdata('jungut'))){echo ("selected");} ?>>Pilih</option>
                      <?php foreach ($jungut as $report) : ?>
                        <option name="kodej" value="<?php echo $report->kodej ?>" <?php if($report->kodej == $this->session->userdata('jungut')){echo ("selected");} ?>><?php echo $report->kodej.' - '.$report->name ?></option>
                      <?php endforeach; ?>
                   
                    </select>
                    </div>
                    
                    <div class="col-sm-5"> 
                      <label for="kawasan" class="control-label">Kawasan<span style="color: red"> *</span></label>
                      <select class="form-control selectpicker" id="kawasan" name="kawasan" data-live-search="true">
                      </select>
                    </div>


                    <div class="col-sm-2">
                    <label for="button"> </label>
                      <button type="submit" name="button" class="btn btn-block btn-success">Submit  <span><i class="fa fa-search"></i></span></button>
                    </div>
                    </div>
              </div>
              
              <!-- /.box-body -->
              </div>
              </form>
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->

        </div>
        <!-- /.row (main row) -->

        <div class="row">
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
              <table id="tabel_batal" class="table table-bordered table-hover">
                <thead>
                <tr>
                <th></th>
                <th>Noid</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>No Telp</th>
                  <th>Proza</th>
                  <th>Kawasan</th>  
                  <th>Status</th>                
                </tr>
                </thead>
                <tbody>
                <?php
                if(!empty($hasil)):
                foreach($hasil as $hasil): ?>
                <tr>
                  <td nilai="<?php echo $hasil->telphp?>" noid="<?php echo $hasil->noid?>" nama="<?php echo $hasil->nama?>"></td>
                  <td><?php echo $hasil->noid ?></td>
                  <td><?php echo $hasil->nama ?></td>
                  <td><?php echo $hasil->alamat ?></td>
                  <td><?php echo $hasil->telphp ?></td>
                  <td><?php echo $hasil->jupen ?></td>
                  <td><?php echo $hasil->kwsn ?></td>
                  <td><?php echo $hasil->status ?></td>
                </tr>
                <?php endforeach;
                endif; ?>
                <!-- <form action="" id="batal_form" method="post"> -->
                </tbody>
              </table>

              <!-- </form> -->
              <!-- /.box-body -->
              </div>
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->

        </div>

        <div class="row">
          <div class="col-xs-12">
            <div class="box box-info">
              <div class="box-header">
                <h3 class="box-title">Kirim SMS Donatur</h3>
              </div>
              
              <!-- /.box-header -->
              <div class="box-body">
              <div class="row">
              <form action="<?php echo base_url('sms_donatur/kirim') ?>" method="post">
              <div class="form-group">
                
            </div>
              </div>
              <div class="form-group">
                <div class="col-sm-6">
                    <label for="draft" class="control-label">Draft</label>
                    <select class="form-control selectpicker2" id="draft" name="draft" data-live-search="true">
                    <option value="">Tanpa Draft</option>
                    <?php foreach($draft as $draft) : ?>
                     <option name="draft" value="<?php echo $draft->sms_id ?>"><?php echo $draft->judul?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <label for="judul" class="control-label">Judul<span style="color: red"> *</span></label>
                    <?php if($this->input->post('juduldraft')){ ?>
                      <input type="text" class="form-control" value="<?php echo $this->input->post('juduldraft'); ?>" name="judul" id="judul" placeholder="Input Judul" required>
                    <?php }else{ ?>
                      <input type="text" class="form-control" name="judul" id="judul" placeholder="Input Judul" required>
                    <?php }?>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                    <label for="notelp" class="control-label">No Telp <span style="color: red"> *</span></label>
                    <input type="text" class="form-control" name="notelp" id="telphp" placeholder="Input No Telp"
                    required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                    <label for="isisms" class="control-label">ISI SMS <span style="color: red"> *</span></label>
                    <?php if($this->input->post('juduldraft')){ ?>
                      <textarea name="isisms" class="form-control  isi" id="isisms" rows="10" require><?php echo $this->input->post('isi_smsdraft');  ?></textarea>
                    <?php }else{ ?>
                      <textarea name="isisms" class="form-control  isi" id="isisms" rows="10" require></textarea>
                    <?php }?>
                    

                </div>
              </div>
              <!-- hidden -->
              <input type="hidden" id="noid" name="noid">
              <input type="hidden" id="nama" name="nama">
              <br>
              <!-- hidden -->
              <div class="form-group">
                  <div class="col-sm-12">
                    <br>
                    <button id="btnprog" type="submit" class="btn btn-info pull-right"> <i class="fa fa-send" ></i> Kirim</button>
                  </div>
              </div>
              <!-- /.box-body -->
              </div>
              </form>
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
<?php $this->load->view('partials/js') ?>
<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
<script>
$(document).ready(function(){

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
        startDate: moment(),
        endDate  : moment()
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
  //
  $("select#jungut").on('change',function() {
        var kodej = $(this).children("option:selected").val();
        var tgl = $("#date").val();
        var cont = '<option value="" selected> - </option>';
        $.ajax({
          type  : 'GET',
          url   : '<?php echo base_url('sms_donatur/getKawasanJ') ?>',
          data  : {
            kodej : kodej,
          },
          async : true,
          dataType : 'json',
          success : function(data){
            for (var i=0;i<data.length;i++) {
              cont += '<option  value="'+data[i].kwsn+'">'+data[i].kwsn+' - '+data[i].nm_kawasan+' </option>';
            };
            $('select#kawasan').html(cont);
            $('.selectpicker').selectpicker('refresh');
          }
        });
      });

      $("select#draft").on('change',function() {
         var sms_id = $(this).children("option:selected").val();
         var judul = '';
         var isi = '';
         $.ajax({
           type  : 'GET',
           url   : '<?php echo base_url('sms_donatur/draft') ?>',
           data  : {sms_id : sms_id},
           async : true,
           dataType : 'json',
           success : function(data){
             for (var i=0;i<data.length;i++) {
               judul = data[i].judul;
               isi = data[i].isi_sms;
               
             }
             $("#judul").val(judul);
             $('#isisms').html(isi);
             $('.selectpicker2').selectpicker('refresh');
           }
         });
       });

    })  

    //
    // 

var tabel = $('#tabel_batal').DataTable({
      columnDefs: [ {
            targets: 0,
            data:7,
            'checkboxes':{
              'selectRow':true
            }
      }
         ],
        select: {
            style:'multi',
        },
        order: [[ 1, 'asc' ]]
    });

        
  var chckbxtbl = tabel.column(0).nodes().to$().find('input[type=checkbox]')
  $(chckbxtbl).change(function(){
  var checkbx = chckbxtbl;
  console.log(checkbx);
  var hp = "";
  var noid = "";
  var nama = "";
  for(i=0;i<checkbx.length;i++){
    if(checkbx[i].checked){
        if(hp==""){
            hp = $(checkbx[i]).parent().attr('nilai');
            noid = $(checkbx[i]).parent().attr('noid');
            nama = $(checkbx[i]).parent().attr('nama');
        }else{
            hp = hp+","+ $(checkbx[i]).parent().attr('nilai');
            noid = noid+","+ $(checkbx[i]).parent().attr('noid');
            nama = nama+","+ $(checkbx[i]).parent().attr('nama');
        }
    }
  }
  $("#telphp").val(hp);
  $("#noid").val(noid);
  $("#nama").val(nama);
})


</script>
<script>
$(document).ready(function(){


var all_form=$(".dt-checkboxes-select-all").find('input[type=checkbox]');
$(all_form).on('change',function(){
  if(this.checked){
    var checkbx = chckbxtbl;
    var hp = "";
    var noid = "";
    var nama = "";
    for(i=0;i<checkbx.length;i++){
    if(checkbx[i].checked){
        if(checkbx[i].checked){
        if(hp==""){
            hp = $(checkbx[i]).parent().attr('nilai');
            noid = $(checkbx[i]).parent().attr('noid');
            nama = $(checkbx[i]).parent().attr('nama');
        }else{
            hp = hp+","+ $(checkbx[i]).parent().attr('nilai');
            noid = noid+","+ $(checkbx[i]).parent().attr('noid');
            nama = nama+","+ $(checkbx[i]).parent().attr('nama');
        }
    }
    }
  }
 }else{
    var hp = "";
    var noid = "";
    var nama = "";
 }
 $("#telphp").val(hp);
  $("#noid").val(noid);
  $("#nama").val(nama);
});

});
</script>
<?php if($this->input->post('kodej')){ ?>
<script>
$('select#jungut').selectpicker("val" , '<?php echo $this->input->post('kodej') ?>');
$('select#kawasan').selectpicker("val" , '<?php echo $this->input->post('kawasan') ?>');
</script>
<?php }?>
<?php if($this->input->post('juduldraft')){ ?>
<script>
$('select#draft').selectpicker("val" , '<?php echo $this->input->post('iddraft') ?>');
</script>
  <?php }?>

</html>