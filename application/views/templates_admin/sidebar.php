<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" class="nav-link nav-link-lg nav-link-user">
              <div class="d-sm-none d-lg-inline-block">Selamat Datang, <?= $this->session->userdata('nama_user'); ?></div>
            </a>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">

            <img src="<?= base_url('assets/assets_stisla/'); ?>/assets/img/logo2.png" alt="logo" width="150" class="">
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">SEAP</a>
          </div>
          <ul class="sidebar-menu">
            <li><a class="nav-link" href="<?= base_url('admin/dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>

            <li><a class="nav-link" href="<?= base_url('admin/data_admin'); ?>"><i class="fas fa-user"></i> <span>Data Admin</span></a></li>

            <li><a class="nav-link" href="<?= base_url('admin/data_user'); ?>"><i class="fas fa-users"></i> <span>Data User</span></a></li>

            <li><a class="nav-link" href="<?= base_url('admin/tiket'); ?>"><i class="fas fa-ticket-alt"></i> <span>Data Tiket</span></a></li>

            <li><a class="nav-link" href="<?= base_url('admin/transaksi'); ?>"><i class="fas fa-exchange-alt"></i> <span>Transaksi</span></a></li>

            <li><a class="nav-link" href="<?= base_url('admin/about'); ?>"><i class="fas fa-info-circle"></i> <span>About</span></a></li>

            <li><a class="nav-link" href="<?= base_url('admin/contact'); ?>"><i class="fas  fa-address-book"></i> <span>Contact</span></a></li>

            <li><a class="nav-link" href="<?= base_url('auth/logout'); ?>" onclick="return confirm('Yakin Logout?');"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
          </ul>
        </aside>
      </div>