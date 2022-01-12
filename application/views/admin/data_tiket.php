<div class="main-content">
 <section class="section">
   <div class="section-header">
    <h1>Data Tiket</h1>
   </div>

   <a href="<?= base_url('admin/tiket/tambah_tiket'); ?>" class="btn btn-primary mb-3">Tambah Data</a>
   <?= $this->session->flashdata('pesan');  ?>
   <table class="table table-hover table-striped table-bordered" id="table-1">
    <thead>
      <tr>
        <th width="40px">No</th>
        <th>Nama Tiket</th>
        <th>Harga</th>
        <th>Gambar</th>
        <th width="160px">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1; foreach ($tiket as $tk) : ?>
      <tr>
       <td><?= $no++; ?></td>
       <td><?= $tk->nama_tiket; ?></td>
        <td><?= $tk->harga; ?></td>
       <td><img src="<?= base_url('img/') . $tk->gambar; ?>" width="120px"></td>
       <td align="center">
        <a href="<?= base_url('admin/tiket/update_tiket/') . $tk->id_tiket; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
        <a href="<?= base_url('admin/tiket/delete_tiket/') . $tk->id_tiket; ?>" class="btn btn-danger" onClick="return confirm('Yakin?');"><i class="fa fa-trash"></i></a>
      </td>
    </tr>
  <?php endforeach; ?>
</tbody>

</table>
</section>
</div>