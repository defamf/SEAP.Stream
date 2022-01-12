<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Transaksi</h1>
		</div>

		<?= $this->session->flashdata('pesan'); ?>
		<table class="table-responsive table table-bordered table-striped" id="table-1">
			<thead>
				<tr>
					<th>No</th>
					<th width="160px">Token</th>
					<th width="180px">Nama Pembeli</th>
					<th width="160px">Jumlah Tiket</th>
					<th>Total Harga</th>
					<th>Status Pembayaran</th>
					<th width="120px">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $no=1; foreach($transaksi as $tr) : ?>
				<tr>
					<td><?= $no++; ?></td>
					<td><?= $tr->token; ?></td>
					<td><?= $tr->nama_user; ?></td>
					<td><?= $tr->jumlah_tiket; ?></td>
					<td><?= $tr->total_harga; ?></td>
					<td><?= $tr->status_bayar; ?></td>
					<td align="center">
						<a href="<?= base_url('admin/transaksi/update_transaksi/') . $tr->id_transaksi; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
						<a href="<?= base_url('admin/transaksi/delete_transaksi/') . $tr->id_transaksi; ?>" class="btn btn-danger" onClick="return confirm('Yakin?');"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>			
	</table>

</section>
</div>