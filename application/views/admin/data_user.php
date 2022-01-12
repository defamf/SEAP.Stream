<div class="main-content">
 <section class="section">
   <div class="section-header">
     <h1>Data User</h1>
   </div>

   <a href="<?= base_url('admin/data_user/tambah_user'); ?>" class="btn btn-primary mb-3">Tambah Data</a>
   <?= $this->session->flashdata('pesan');  ?>
   <div class="table-responsive">
    <table class="table table-hover table-striped table-bordered" id="table-1">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama User</th>
          <th>Username</th>
          <th width="160px">Aksi</th>
        </tr>
          </thead>
          <tbody>
          <?php $no=1; foreach ($user as $us) : ?>
           <tr>
             <td><?= $no++; ?></td>
             <td><?= $us->nama_user; ?></td>
             <td><?= $us->username; ?></td>
             <td align="center">
              <a href="<?= base_url('admin/data_user/update_user/') . $us->id_user; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
              <a href="<?= base_url('admin/data_user/delete_user/') . $us->id_user; ?>" class="btn btn-danger" onClick="return confirm('Yakin?');"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
      <?php endforeach; ?>
        </tbody>

    </table>
  </div>
</section>
</div>