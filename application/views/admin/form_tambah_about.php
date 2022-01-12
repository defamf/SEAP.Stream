<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Form Tambah About</h1>
		</div>

		<div class="card">
			<div class="card-body">
				<form method="post" action="<?= base_url('admin/about/tambah_about_aksi'); ?>">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Dimana</label>
							<input type="text" name="dimana" class="form-control">
							<?= form_error('dimana', '<div class="text-small text-danger">','</div>') ?>
						</div>
						<div class="form-group">
							<label>Kapan</label>
							<input type="date" name="kapan" class="form-control">
							<?= form_error('kapan', '<div class="text-small text-danger">','</div>') ?>
						</div>
						<div class="form-group">
							<label>Keterangan</label>
							<textarea class="form-control" name="keterangan"></textarea>
							<?= form_error('keterangan', '<div class="text-small text-danger">','</div>') ?>
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