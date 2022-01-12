<div class="main-content">
 <section class="section">
   <div class="section-header">
     <h1>About</h1>
   </div>

   <a href="<?= base_url('admin/about/tambah_about'); ?>" class="btn btn-primary mb-3">Tambah Data</a>
   <?= $this->session->flashdata('pesan');  ?>
   <div class="table-responsive">
    <table class="table table-hover table-striped table-bordered" id="table-1">
      <thead>
        <tr>
          <th>No</th>
          <th>Dimana</th>
          <th>Kapan</th>
          <th>Keterangan</th>
          <th width="160px">Aksi</th>
        </tr>
          </thead>
          <tbody>
          <?php $no=1; foreach ($about as $ab) : ?>
           <tr>
             <td><?= $no++; ?></td>
             <td><?= $ab->dimana; ?></td>
             <td><?= $ab->kapan; ?></td>
             <td><?= $ab->keterangan; ?></td>
             <td align="center">
              <a href="<?= base_url('admin/about/update_about/') . $ab->id_about; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
              <a href="<?= base_url('admin/about/delete_about/') . $ab->id_about; ?>" class="btn btn-danger" onClick="return confirm('Yakin?');"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
      <?php endforeach; ?>
        </tbody>

    </table>
  </div>
</section>
</div>