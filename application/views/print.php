<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title><?= $judul; ?></title>
</head>

<body style="background-color: white; color:wheat;margin: 40px; text-align: center; display: flex;height: 100vh; flex-direction:column; justify-content:space-between">

  <div style="display: flex;flex: 1;flex-direction: column">
    <h1 style="margin-bottom: 50px;">E-Sertifikat Seminar</h1>
    <h3>E-Sertifikat ini dipersembahkan untuk:</h3>
    <h1 style="color:goldenrod; font-weight: bolder">
      <?= $this->db->query("SELECT * FROM users WHERE id_user=" . $transaksi[0]->id_user)->result()[0]->nama_user ?></h1>
    <img src="<?php echo base_url('assets/assets_stisla/assets/img/logo2.png'); ?>" style="object-fit:contain" alt="logo" />
  </div>
  <div style="display: flex;flex: 1 ; flex-direction: column">
    <div style="display: flex;flex: 1;flex-direction: column; justify-content:center">
      <h3>Karena telah mengikuti seminar</h3>
      <h1 style="color:goldenrod"><?= $this->db->query("SELECT * FROM tiket WHERE id_tiket=" . $transaksi[0]->id_tiket)->result()[0]->nama_tiket ?></h1>
    </div>
    <br>
    <div>
      <img src="<?php echo base_url('assets/img/ceo-signature.png'); ?>" style="object-fit:contain" alt="logo" />
      <h2 style="color: black">Jeff Bezos</h2>
    </div>
    <br>
    <div style="display: flex;flex: 1; align-items:flex-end; justify-content: center; margin-bottom: 80px">
      <h2>Terima kasih telah mengikuti seminar ini,<br>semoga ilmu yang diberikan bermanfaat</h2>
    </div>
  </div>
  <!-- <table class="table table-bordered table-striped">
  <tr>
    <th>No</th>
    <th>Token</th>
    <th>Jenis Tiket</th>
    <th>Jumlah Tiket</th>
    <th>Total Harga</th>
    <th width="220px">Status Bayar</th>
  </tr>
  <?php $no = 1;
  foreach ($transaksi as $tr) : ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= $tr->token; ?></td>
    <td><?= $tr->jenis_tiket; ?></td>
    <td><?= $tr->jumlah_tiket; ?></td>
    <td><?= $tr->total_harga; ?></td>
    <td><?= $tr->status_bayar; ?></span>
    </td>
  </tr>
<?php endforeach; ?>
</table> -->

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
<script type="text/javascript">
  window.print();
</script>

</html>