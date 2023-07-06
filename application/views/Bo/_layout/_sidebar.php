<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="<?= site_url('Dashboard'); ?>">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->


    <li class="nav-heading">Pages</li>
    <?php if ($this->session->userdata('role') == '1') { ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?php echo site_url('User/Data_pengguna'); ?>">
          <i class="bi bi-person"></i>
          <span>Pengguna</span>
        </a>
      </li><!-- End Profile Page Nav -->
    <?php } ?>
    <li class="nav-item">
      <a class="nav-link collapsed" href="<?php echo site_url('Wisata/data_wisata'); ?>">
        <i class="bi bi-layout-text-window-reverse"></i>
        <span>Data Wisata</span>
      </a>
    </li><!-- End Profile Page Nav -->


  </ul>

</aside>
<!-- End Sidebar -->