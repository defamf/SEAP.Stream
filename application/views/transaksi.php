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
  <?php
  function debug_to_console($data)
  {
    $output = $data;
    if (is_array($output))
      $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
  }
  ?>
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


        <a href="#" class="scrollto"><img src="<?= base_url('assets/assets_tiket/'); ?>assets/img/logo2.png" alt="" title=""></a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="<?= base_url('home'); ?>">Home</a></li>
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


  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about">
      <div class="container" data-aos="fade-up">
      </div>
    </section><!-- End About Section -->

    <!-- ======= Buy Ticket Section ======= -->
    <section id="buy-tickets" class="section-with-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Transaksi Anda</h2>
        </div>

        <div class="row">
          <!-- Pro Tier -->
          <div class="col-lg-12" data-aos="fade-up" data-aos-delay="300">
            <div class="card">
              <div class="card-body" style="min-height: 400px">
                <table class="table table-bordered table-striped">
                  <tr>
                    <th>No</th>
                    <th>Token</th>
                    <th>Jenis Tiket</th>
                    <th>Jumlah Tiket</th>
                    <th>Total Harga</th>
                    <th width="220px">Status Bayar</th>
                  </tr>
                  <?php $no = 1;
                  foreach ($transaksi as $tr) : ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $tr->token; ?></td>
                      <td><?= $tr->jenis_tiket; ?></td>
                      <td><?= $tr->jumlah_tiket; ?></td>
                      <td><?= $tr->total_harga; ?></td>
                      <td>
                        <?php if ($tr->status_bayar == 'Lunas') { ?>
                          <span class="btn-success"><?= $tr->status_bayar; ?></span>
                          <a class="btn-primary" href="<?= base_url('print_tiket/index/') . $tr->id_transaksi; ?>">Print E-Sertifikat</a>
                        <?php } else { ?>
                          <span class="btn-danger"><?= $tr->status_bayar; ?></span>
                          <form method="POST" action="<?= base_url('transaksi/payment/') . $tr->id_transaksi; ?>">
                            <input class="btn-primary m-2"  type="submit" style=" border: 4px solid #1C6DD0;
     border-radius: 5px; background-color: #1C6DD0" value="Bayar" />
                          </form>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Modal Order Form -->
      <div id="buy-ticket-modal" class="modal fade">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Seminar</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="<?= base_url('home/transaksi'); ?>">
                <div class="form-group">
                  <label>Nama Pembeli</label>
                  <input type="text" class="form-control" name="nama_pembeli">
                </div>
                <div class="form-group">
                  <label>Jenis Tiket</label>
                  <select id="ticket-type" name="ticket-type" class="form-control">
                    <option value="reguler">Reguler</option>
                    <option value="premium">Premium</option>
                    <option value="vip">VIP</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Jumlah Tiket</label>
                  <input type="text" class="form-control" name="jumlah">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn">Beli Sekarang</button>
                </div>
              </form>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

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
                <p><a href="tel:+155895548855"><?= $ct->no_telepon; ?></a></p>
              </div>
            </div>

            <div class="col-md-4">
              <div class="contact-email">
                <i class="ion-ios-email-outline"></i>
                <h3>Email</h3>
                <p><a href="mailto:info@example.com"><?= $ct->email; ?></a></p>
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
        &copy; Copyright <?= date('Y'); ?>
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