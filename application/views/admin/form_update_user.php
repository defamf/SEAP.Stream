<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Form Update Data User</h1>
		</div>

		<div class="card">
			<div class="card-body">
				<?php foreach($user as $us) : ?>
					<form method="post" action="<?= base_url('admin/data_user/update_user_aksi/') . $us->id_user; ?>" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Nama User</label>
									<input type="hidden" name="id_user" value="<?= $us->id_user; ?>">
									<input type="text" name="nama_user" class="form-control" value="<?= $us->nama_user; ?>">
									<?= form_error('nama_user', '<div class="text-small text-danger">','</div>') ?>
								</div>
								<div class="form-group">
									<label>Username</label>
									<input type="text" name="username" class="form-control" value="<?= $us->username; ?>">
									<?= form_error('username', '<div class="text-small text-danger">','</div>') ?>
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password" class="form-control" value="<?= $us->password; ?>">
									<?= form_error('password', '<div class="text-small text-danger">','</div>') ?>
								</div>
								<button type="submit" class="btn btn-primary mt-4">Update</button>
							</div>
						<?php endforeach; ?>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>