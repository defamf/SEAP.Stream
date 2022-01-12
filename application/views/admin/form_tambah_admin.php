<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Form Tambah Data Admin</h1>
		</div>

		<div class="card">
			<div class="card-body">
				<form method="post" action="<?= base_url('admin/data_admin/tambah_admin_aksi'); ?>" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Nama Admin</label>
							<input type="text" name="nama_user" class="form-control">
							<?= form_error('nama_user', '<div class="text-small text-danger">','</div>') ?>
						</div>
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" class="form-control">
							<?= form_error('username', '<div class="text-small text-danger">','</div>') ?>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control">
							<?= form_error('password', '<div class="text-small text-danger">','</div>') ?>
						</div>
						<button type="submit" class="btn btn-primary mt-4">Simpan</button>
						<button type="reset" class="btn btn-danger mt-4">Reset</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</section>
</div>