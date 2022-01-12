<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Form Update About</h1>
		</div>

		<div class="card">
			<div class="card-body">
				<?php foreach($about as $ab) : ?>
				<form method="post" action="<?= base_url('admin/about/update_about_aksi/') . $ab->id_about; ?>">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Dimana</label>
							<input type="hidden" name="id_about" value="<?= $ab->id_about; ?>">
							<input type="text" name="dimana" class="form-control" value="<?= $ab->dimana; ?>">
							<?= form_error('dimana', '<div class="text-small text-danger">','</div>') ?>
						</div>
						<div class="form-group">
							<label>Kapan</label>
							<input type="date" name="kapan" class="form-control" value="<?= $ab->kapan; ?>">
							<?= form_error('kapan', '<div class="text-small text-danger">','</div>') ?>
						</div>
						<div class="form-group">
							<label>Keterangan</label>
							<textarea class="form-control" name="keterangan"><?= $ab->keterangan; ?></textarea>
							<?= form_error('keterangan', '<div class="text-small text-danger">','</div>') ?>
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