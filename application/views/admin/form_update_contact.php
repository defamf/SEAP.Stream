<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Form Tambah Contact</h1>
		</div>

		<div class="card">
			<div class="card-body">
				<?php foreach($contact as $ct) : ?>
				<form method="post" action="<?= base_url('admin/contact/update_contact_aksi/') . $ct->id_contact; ?>">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Alamat</label>
							<input type="hidden" name="id_contact" class="form-control" value="<?= $ct->id_contact; ?>">
							<input type="text" name="alamat" class="form-control" value="<?= $ct->alamat; ?>">
							<?= form_error('alamat', '<div class="text-small text-danger">','</div>') ?>
						</div>
						<div class="form-group">
							<label>No.Telepon</label>
							<input type="text" name="no_telepon" class="form-control" value="<?= $ct->no_telepon; ?>">
							<?= form_error('no_telepon', '<div class="text-small text-danger">','</div>') ?>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" class="form-control" value="<?= $ct->email; ?>">
							<?= form_error('email', '<div class="text-small text-danger">','</div>') ?>
						</div>
						<button type="submit" class="btn btn-primary mt-4">Update</button>
						<button type="reset" class="btn btn-danger mt-4">Reset</button>
					</div>
				</div>
				</form>
			<?php endforeach; ?>
			</div>
		</div>
	</section>
</div>