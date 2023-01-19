<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url('assets/images/icon.png') ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>
          <?php echo $this->session->userdata('ses_name') ?>
        </p>
        <a href="#">
          <?php echo $this->session->userdata('ses_email') ?></a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li>
          <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span style="font-weight:400;">Dashboard</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
      <?php if ($this->session->userdata('hak') == "0" ): ?>
      <li>
          <a href="<?php echo base_url('user') ?>">
            <i class="fa fa-user"></i> <span style="font-weight:400;">User</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
      <?php endif; ?>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-calendar"></i> <span style="font-weight:400;">Rekap Prozis</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="active" style="font-weight:400;"><a href="<?php echo base_url('report') ?>"><i class="fa fa-circle-o"></i> Rekap Perolehan</a></li>
          <li style="font-weight:400;"><a href="<?php echo base_url('report/perolehan-manager'); ?>"><i class="fa fa-circle-o"></i> Rekap Perolehan Manager</a></li>
          <li style="font-weight:400;"><a href="<?php echo base_url('report/harian') ?>"><i class="fa fa-circle-o"></i> Rekap Harian Prozis</a></li>
          <li style="font-weight:400;"><a href="<?php echo base_url('report/kawasan-kurang-target') ?>"><i class="fa fa-circle-o"></i> Rekap Kawasan Kurang Target</a></li>
          <li style="font-weight:400;"><a href="<?php echo base_url('report/setoran') ?>"><i class="fa fa-circle-o"></i> Rekap Setoran</a></li>
	  <li style="font-weight:400;"><a href="<?php echo base_url('report/centang') ?>"><i class="fa fa-circle-o"></i> Rekap Centang</a></li>
          <li style="font-weight:400;"><a href="<?php echo base_url('report/validasi') ?>"><i class="fa fa-circle-o"></i> Rekap Validasi</a></li>
          <li style="font-weight:400;"><a href="<?php echo base_url('report/gagal-kwitansi') ?>"><i class="fa fa-circle-o"></i> Rekap Kwitansi Gagal</a></li>

        </ul>
      </li>
      <!--
      <li class="treeview">
        <a href="#">
          <i class="fa fa-dollar"></i> <span style="font-weight:400;">Rekap Keuangan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li style="font-weight:400;" class="active"><a href="<?php //echo base_url('keuangan/program') ?>"><i class="fa fa-circle-o"></i> Per Program</a></li>
          <li style="font-weight:400;"><a href="<?php //echo base_url('keuangan/bank') ?>"><i class="fa fa-circle-o"></i> Per Bank</a></li>
          <li style="font-weight:400;"><a href="<?php //echo base_url('keuangan/rinci-slip/bank') ?>"><i class="fa fa-circle-o"></i> Rinci Slip Bank</a></li>
          <li style="font-weight:400;"><a href="<?php //echo base_url('keuangan/rekap-slip-bank') ?>"><i class="fa fa-circle-o"></i> Rekap Slip Bank</a></li>
          <li style="font-weight:400;"><a href="<?php //echo base_url('keuangan/rkay') ?>"><i class="fa fa-circle-o"></i> Rekap RKAY</a></li>
        </ul>
      </li> -->
     <?php if ($this->session->userdata('hak') == '0' || $this->session->userdata('hak') == '3') : ?>
     <li class="treeview">
        <a href="#">
          <i class="fa fa-file-text"></i> <span style="font-weight:400;">Front Office</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li style="font-weight:400;" class="active"><a href="<?php echo base_url('front-office/validasi-kasir') ?>"><i class="fa fa-circle-o"></i> Validasi Kasir</a></li>
          <!--  <li style="font-weight:400;" class=""><a href="<?php echo base_url('front-office/slip-manual') ?>"><i class="fa fa-circle-o"></i> Slip Manual</a></li>
          -->
          <li style="font-weight:400;"><a href="<?php echo base_url('data/donasi') ?>"><i class="fa fa-circle-o"></i>Donasi</a></li>
          <li style="font-weight:400;" class=""><a href="<?php echo base_url('front-office/rekap-sms-inbox') ?>"><i class="fa fa-circle-o"></i>Rekap Sms Inbox</a></li>
        </ul>
      </li>
     <?php endif; ?>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-briefcase"></i> <span style="font-weight:400;">Donatur</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li style="font-weight:400;" class="active"><a href="<?php echo base_url('data/donatur') ?>"><i class="fa fa-circle-o"></i>Data Donatur</a></li>
          <li style="font-weight:400;" ><a href="<?php echo base_url('data/koordinator') ?>"><i class="fa fa-circle-o"></i>Koordinator</a></li>
          <li style="font-weight:400;"><a href="<?php echo base_url('data/kawasan')?>"><i class="fa fa-circle-o"></i>Kawasan</a></li>
        </ul>
      </li>
      <li class="header" style="font-weight:400;">OTHER NAVIGATION</li>
      <?php if ($this->session->userdata('superadmin') == TRUE) { ?>
        <?php if ($this->session->userdata('hak') == '0') : ?>
        <li class="treeview">
        <a href="#">
          <i class="fa fa-database"></i> <span style="font-weight:400;">Import Database</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li style="font-weight:400;" class="active"><a href="<?php echo base_url('importDB/report_tagih') ?>"><i class="fa fa-circle-o"></i>report_tagih</a></li>
          <li style="font-weight:400;"><a href="<?php echo base_url('importDB/keu_j')?>"><i class="fa fa-circle-o"></i>keu_j</a></li>
        </ul>
      </li>
      <?php endif; ?>



			<li class="treeview">
        <a href="#">
          <i class="fa fa-plus"></i> <span style="font-weight:400;">Setup</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li style="font-weight:400;" class="active"><a href="<?php echo base_url('setup/prospek') ?>"><i class="fa fa-circle-o"></i>Prospek</a></li>
          <li style="font-weight:400;"><a href="<?php echo base_url('setup/pekerjaan')?>"><i class="fa fa-circle-o"></i>Pekerjaan</a></li>
        </ul>
      </li>
      <?php } ?>
			<?php if ($this->session->userdata('superadmin') == TRUE || $this->session->userdata('admin_grup') == TRUE) : ?>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-envelope"></i> <span style="font-weight:400;">Kirim sms donatur</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li style="font-weight:400;" class="active"><a href="<?php echo base_url('kirim-sms-donatur') ?>"><i class="fa fa-circle-o"></i>Kirim SMS</a></li>
          <li style="font-weight:400;" class="active"><a href="<?php echo base_url('riwayat-pesan') ?>"><i class="fa fa-circle-o"></i>Riwayat Pesan</a></li>
          <li style="font-weight:400;"><a href="<?php echo base_url('draft-sms-donatur')?>"><i class="fa fa-circle-o"></i>Draft</a></li>
        </ul>
      </li>
      <li>
          <a href="<?php echo base_url('batal/setor') ?>">
            <i class="fa fa-repeat"></i> <span style="font-weight:400;">Batal Setoran</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li> 
      <?php endif;?>
      <?php if ($this->session->userdata('superadmin') == TRUE) : ?>
        <!--
      <li>
          <a href="<?php //echo base_url('ydsf1') ?>">
            <i class="fa fa-send"></i> <span style="font-weight:400;" >Send Email</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
      -->
      <?php endif;?>
        <li>
          <a href="" data-toggle="modal" data-target="#modal-logout">
            <i class="fa fa-power-off"></i> <span style="font-weight:400;">Sign Out</span>
            <!-- <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span> -->
          </a>
        </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
