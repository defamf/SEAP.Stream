<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '/xampp/htdocs/ci-seminarapp/application/third_party/PHPMailer-master/src/Exception.php';
require '/xampp/htdocs/ci-seminarapp/application/third_party/PHPMailer-master/src/PHPMailer.php';
require '/xampp/htdocs/ci-seminarapp/application/third_party/PHPMailer-master/src/SMTP.php';

define('GUSER', 'defaa.business@gmail.com');
define('GPWD', 'business362958!');

class Transaksi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if (empty($this->session->userdata('hak_akses'))) {
			redirect('auth/login');
		} elseif ($this->session->userdata('hak_akses') == 'User') {
			redirect('block');
		}
	}

	public function index()
	{
		$data['judul'] = 'Transaksi';
		$data['transaksi'] = $this->db->query("SELECT * FROM transaksi JOIN users ON transaksi.id_user=users.id_user")->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/transaksi', $data);
		$this->load->view('templates_admin/footer');
	}

	public function update_transaksi($id)
	{
		$data['judul'] = 'Update Transaksi';

		$data['transaksi'] = $this->db->query("SELECT * FROM transaksi WHERE id_transaksi=" . $id)->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_update_transaksi', $data);
		$this->load->view('templates_admin/footer');
	}

	public function update_transaksi_aksi($id)
	{
		$userId = $this->db->query("SELECT * FROM transaksi WHERE id_transaksi=" . $id)->result();
		$user = $this->db->query("SELECT * FROM users WHERE id_user=" . $userId[0]->id_user)->result();
		$this->form_validation->set_rules('token', 'Token', 'required');
		$this->form_validation->set_rules('jumlah_tiket', 'Jumlah Tiket', 'required');
		$this->form_validation->set_rules('total_harga', 'Total Harga', 'required');
		$this->form_validation->set_rules('status_bayar', 'Status Pembayaran', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->update_transaksi($id);
		} else {
			$id = $this->input->post('id_transaksi');
			$token = $this->input->post('token');
			$jumlah_tiket = $this->input->post('jumlah_tiket');
			$total_harga = $this->input->post('total_harga');
			$status_bayar = $this->input->post('status_bayar');

			$data = array(
				'token' => $token,
				'jumlah_tiket' => $jumlah_tiket,
				'total_harga' => $total_harga,
				'status_bayar' => $status_bayar
			);

			$where = array(
				'id_transaksi' => $id
			);

			$this->Tiket_model->updateData('transaksi', $data, $where);
			$this->session->set_flashdata('pesan', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
				Transaksi berhasil diupdate.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');

			if ($status_bayar == 'Lunas') {
				$mail = new PHPMailer(true);

				try {
					//Server settings
					$mail->isSMTP();
					$mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
					$mail->SMTPAuth = true;  // authentication enabled
					$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
					$mail->SMTPAutoTLS = false;                                  //Send using SMTP
					$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
					$mail->Username   = GUSER;                     //SMTP username
					$mail->Password   = GPWD;                               //SMTP password
					$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

					//Recipients
					$mail->setFrom('defaa.business@gmail.com', 'Seap.stream');
					$mail->addAddress($user[0]->username, $user[0]->nama_user);

					//Content
					$mail->isHTML(true);                                  //Set email format to HTML
					$mail->Subject = 'Pesanan dengan token ' . $token . '';
					$mail->Body    = '<h1>Selamat, pembayaran Anda berhasil!</h1><br>
						Token: ' . $token . '<br>
						Jumlah Tiket: ' . $jumlah_tiket . '<br>
						Total Harga: ' . $total_harga . '<br>
						Status Bayar: ' . $status_bayar . '<br>
						';
					$mail->send();
				} catch (Exception $e) {
					echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}
			}

			redirect('admin/transaksi');
		}
	}

	public function delete_transaksi($id)
	{
		$where = array(
			'id_transaksi' => $id
		);

		$this->Tiket_model->deleteData($where, 'transaksi');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Transaksi berhasil dihapus.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/transaksi');
	}
}
