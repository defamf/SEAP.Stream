<!-- Favicons -->
<link href="<?= base_url('assets/assets_tiket/'); ?>assets/img/favicon2.png" rel="icon">
  <link href="<?= base_url('assets/assets_tiket/'); ?>assets/img/apple-touch-icon2.png" rel="apple-touch-icon">
  
<div id="app">
  <section class="section">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <div class="login-brand">
            <img src="<?= base_url('assets/assets_stisla/'); ?>/assets/img/logo2.png" alt="logo" width="300" class="">
          </div>

          <div class="card card-primary">
            <div class="card-header">
              <h4>Register</h4>
            </div>

            <div class="card-body">
              <form method="POST" action="<?= base_url('register'); ?>">
                <div class="form-group">
                  <label for="nama_user">Nama</label>
                  <input id="nama_user" type="text" class="form-control" name="nama_user">
                  <?= form_error('nama_user', '<span class="text-small text-danger">', '</span>') ?>
                  <div class="invalid-feedback">
                  </div>
                </div>

                <div class="form-group">
                  <label for="username">Email</label>
                  <input id="username" type="text" class="form-control" name="username">
                  <?= form_error('username', '<span class="text-small text-danger">', '</span>') ?>
                  <div class="invalid-feedback">
                  </div>
                </div>

                <div class="form-group">
                  <label for="password">Password</label>
                  <input id="password" type="password" class="form-control" name="password">
                  <?= form_error('password', '<span class="text-small text-danger">', '</span>') ?>
                  <div class="invalid-feedback">
                  </div>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Register
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>