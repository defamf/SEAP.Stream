<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Form Update Transaksi</h1>
		</div>

		<div class="card">
			<div class="card-body">

				<?php foreach ($transaksi as $tr) : ?>

					<form method="post" action="<?= base_url('admin/transaksi/update_transaksi_aksi/') . $tr->id_transaksi; ?>">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Token</label>
									<input type="hidden" name="id_transaksi" value="<?= $tr->id_transaksi; ?>">
									<input type="text" name="token" class="form-control" value="<?= $tr->token; ?>" readonly>
									<?= form_error('token', '<div class="text-small text-danger">', '</div>') ?>
								</div>
								<div class="form-group">
									<label>Jumlah Tiket</label>
									<input type="text" name="jumlah_tiket" class="form-control" value="<?= $tr->jumlah_tiket; ?>">
									<?= form_error('jumlah_tiket', '<div class="text-small text-danger">', '</div>') ?>
								</div>
								<div class="form-group">
									<label>Total Harga</label>
									<input type="text" name="total_harga" class="form-control" value="<?= $tr->total_harga; ?>">
									<?= form_error('total_harga', '<div class="text-small text-danger">', '</div>') ?>
								</div>
								<div class="form-group">
									<label>Status Pembayaran</label>
									<select name="status_bayar" class="form-control">
										<option value="<?= $tr->status_bayar; ?>"><?= $tr->status_bayar; ?></option>
										<option value="Lunas">Lunas</option>
										<option value="Belum Lunas">Belum Lunas</option>
									</select>
									<?= form_error('status_bayar', '<div class="text-small text-danger">', '</div>') ?>
								</div>
								<button type="submit" class="btn btn-primary">Update</button>
							</div>
						</div>
					</form>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</div>