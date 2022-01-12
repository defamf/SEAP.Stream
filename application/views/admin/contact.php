<div class="main-content">
 <section class="section">
   <div class="section-header">
     <h1>Contact</h1>
   </div>

   <a href="<?= base_url('admin/contact/tambah_contact'); ?>" class="btn btn-primary mb-3">Tambah Data</a>
   <?= $this->session->flashdata('pesan');  ?>
   <div class="table-responsive">
    <table class="table table-hover table-striped table-bordered" id="table-1">
      <thead>
        <tr>
          <th>No</th>
          <th>Alamat</th>
          <th>No. Telepon</th>
          <th>Email</th>
          <th width="160px">Aksi</th>
        </tr>
          </thead>
          <tbody>
          <?php $no=1; foreach ($contact as $ct) : ?>
           <tr>
             <td><?= $no++; ?></td>
             <td><?= $ct->alamat; ?></td>
             <td><?= $ct->no_telepon; ?></td>
             <td><?= $ct->email; ?></td>
             <td align="center">
              <a href="<?= base_url('admin/contact/update_contact/') . $ct->id_contact; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
              <a href="<?= base_url('admin/contact/delete_contact/') . $ct->id_contact; ?>" class="btn btn-danger" onClick="return confirm('Yakin?');"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
      <?php endforeach; ?>
        </tbody>

    </table>
  </div>
</section>
</div>