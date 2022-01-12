<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Form Tambah Data Tiket</h1>
		</div>

		<div class="card">
			<div class="card-body">
				<form method="post" action="<?= base_url('admin/tiket/tambah_tiket_aksi'); ?>" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Nama Tiket</label>
								<input type="text" name="nama_tiket" class="form-control">
								<?= form_error('nama_tiket', '<div class="text-small text-danger">','</div>') ?>
							</div>
							<div class="form-group">
								<label>Harga</label>
								<input type="text" name="harga" class="form-control">
								<?= form_error('harga', '<div class="text-small text-danger">','</div>') ?>
							</div>
							<div class="form-group">
								<label>Gambar</label>
								<input type="file" name="gambar" class="form-control">
								<?= form_error('gambar', '<div class="text-small text-danger">','</div>') ?>
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