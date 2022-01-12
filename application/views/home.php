<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $judul; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url('assets/assets_tiket/'); ?>assets/img/favicon2.png" rel="icon">
  <link href="<?= base_url('assets/assets_tiket/'); ?>assets/img/apple-touch-icon2.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/assets_tiket/'); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/assets_tiket/'); ?>assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?= base_url('assets/assets_tiket/'); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/assets_tiket/'); ?>assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/assets_tiket/'); ?>assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets/assets_tiket/'); ?>assets/css/style.css" rel="stylesheet">
  <!-- =======================================================
  * Template Name: TheEvent - v2.3.0
  * Template URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <!-- Uncomment below if you prefer to use a text logo -->
        <img src="<?= base_url('assets/assets_tiket/'); ?>assets/img/logo2.png" alt="" title="">
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="<?= base_url('home'); ?>">Home</a></li>
          <li><a href="#about">Tentang</a></li>
          <li><a href="#buy-tickets">Seminar</a></li>
          <li><a href="#contact">Kontak</a></li>
          <?php if ($this->session->userdata('hak_akses') == 'User') : ?>
            <li><a href="<?= base_url('transaksi'); ?>">Transaksi</a></li>
            <li class="buy-tickets"><a href="<?= base_url('auth/Logout'); ?>">Logout</a></li>
          <?php else : ?>
            <li class="buy-tickets"><a href="<?= base_url('auth/Login'); ?>">Login</a></li>
          <?php endif; ?>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Intro Section ======= -->
  <section id="intro">
    <div class="intro-container" data-aos="zoom-in" data-aos-delay="100">
    
      <!-- <p class="mb-4 pb-0">10-12 December, Downtown Conference Center, New York</p>
        <a href="#about" class="about-btn scrollto">About The Event</a> -->
    </div>
  </section> 

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about">
      <div class="container" data-aos="fade-up">
        <?php foreach ($about as $ab) : ?>
          <div class="row">
            <div class="col-lg-6">
              <h2>Tentang Kami</h2>
              <p><?= $ab->keterangan; ?></p>
            </div>
            <div class="col-lg-3">
              <h3></h3>
              <p><?= $ab->dimana; ?> </p>
            </div>

          </div>
        <?php endforeach; ?>
      </div>
    </section><!-- End About Section -->

    <!-- ======= Buy Ticket Section ======= -->
    <section id="buy-tickets" class="section-with-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Pilih Seminar</h2>
          <p>Silahkan melakukan pembelian di bawah ini</p>
        </div>

        <div class="row">
          <!-- Pro Tier -->
          <?php foreach ($tiket as $tk) : ?>
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
              <div class="card" style="border-radius: 20px">
                <div class="card-body" style="min-height: 400px">
                  <h5 class="card-title text-muted text-uppercase text-center"><?= $tk->nama_tiket; ?></h5>
                  <img src="<?= base_url('img/') . $tk->gambar; ?>" width="300px">
                </div>
                <div class="card-footer">
                  <div class="text-center">
                    <button type="button" class="btn" data-toggle="modal" data-target="#buy-ticket-modal<?= $tk->id_tiket; ?>" data-ticket-type="premium-access">Beli Sekarang</button>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </div>

      <?php foreach ($tiket as $tk) : ?>
        <!-- Modal Order Form -->
        <div id="buy-ticket-modal<?= $tk->id_tiket; ?>" class="modal fade">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Seminar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="<?= base_url('transaksi/tambah_transaksi_aksi'); ?>">

                  <div class="form-group">
                    <label>Jenis Tiket</label>
                    <input type="hidden" name="id_tiket" value="<?= $tk->id_tiket; ?>">
                    <!-- <select id="ticket-type" name="jenis_tiket" class="form-control">
                      <option value="online">Online</option>
                      <option value="offline">Offline</option>
                    </select> -->
                    <input type="text" class="form-control" name="jenis_tiket" value="Online" readonly>

                    <?= form_error('id_tiket', '<span class="text-small text-danger">', '</span>') ?>
                  </div>
                  <div class="form-group">
                    <label>Jumlah Tiket</label>
                    <input type="text" class="form-control" name="jumlah_tiket">
                    <?= form_error('jumlah_tiket', '<span class="text-small text-danger">', '</span>') ?>
                  </div>
                  <div class="form-group">
                    <label>Harga per tiket</label>
                    <input type="text" class="form-control" name="harga" value="<?= $tk->harga; ?>" readonly>
                    <?= form_error('harga', '<span class="text-small text-danger">', '</span>') ?>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-danger">Beli Sekarang</button>
                  </div>
                </form>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
      <?php endforeach; ?>

    </section><!-- End Buy Ticket Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="section-bg">

      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Kontak Kami</h2>
        </div>

        <?php foreach ($contact as $ct) : ?>
          <div class="row contact-info">

            <div class="col-md-4">
              <div class="contact-address">
                <i class="ion-ios-location-outline"></i>
                <h3>Alamat</h3>
                <address><?= $ct->alamat; ?></address>
              </div>
            </div>

            <div class="col-md-4">
              <div class="contact-phone">
                <i class="ion-ios-telephone-outline"></i>
                <h3>No. Telepon</h3>
                <p><a href="tel:+6285876218747"><?= $ct->no_telepon; ?></a></p>
              </div>
            </div>

            <div class="col-md-4">
              <div class="contact-email">
                <i class="ion-ios-email-outline"></i>
                <h3>Email</h3>
                <p><a href="mailto:info@SEAP.com"><?= $ct->email; ?></a></p>
              </div>
            </div>

          </div>
        <?php endforeach; ?>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="container">
      <div class="copyright">
        SEAP.Stream &copy; Copyright <?= date('Y'); ?>
      </div>
      <div class="credits">
        <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=TheEvent
      -->
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('assets/assets_tiket/'); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/assets_tiket/'); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/assets_tiket/'); ?>assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?= base_url('assets/assets_tiket/'); ?>assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= base_url('assets/assets_tiket/'); ?>assets/vendor/venobox/venobox.min.js"></script>
  <script src="<?= base_url('assets/assets_tiket/'); ?>assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?= base_url('assets/assets_tiket/'); ?>assets/vendor/superfish/superfish.min.js"></script>
  <script src="<?= base_url('assets/assets_tiket/'); ?>assets/vendor/hoverIntent/hoverIntent.js"></script>
  <script src="<?= base_url('assets/assets_tiket/'); ?>assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/assets_tiket/'); ?>assets/js/main.js"></script>

</body>

</html>