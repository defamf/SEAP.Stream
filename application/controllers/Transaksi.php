<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use Midtrans\Config;
use Midtrans\Snap;

require_once dirname(__FILE__) . '/../third_party/Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = 'SB-Mid-server-lW45ewX5vjtF2jHw-sbo8f01';

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
		define("NL", "\r\n");
		if (empty($this->session->userdata('hak_akses'))) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				Anda harus login terlebih dahulu!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('auth/login');
		} elseif ($this->session->userdata('hak_akses') == 'Admin') {
			redirect('block');
		}
	}

	public function index()
	{
		$data['judul'] = 'Transaksi';

		$data['transaksi'] = $this->db->query("SELECT * FROM transaksi WHERE id_user=" . $this->session->userdata('id_user'))->result();

		$data['contact'] = $this->Tiket_model->getData('contact')->result();

		$data['about'] = $this->Tiket_model->getData('about')->result();
		echo '<script type="text/javascript">' . NL;
		echo 'console.log("' . $this->input->get('id_transaction', TRUE) . '");' . NL;
		echo '</script>' . NL;
		$id_transaction = $this->input->get('id_transaction', TRUE);
		if ($this->input->get('status') == 'pending') {
			echo '<script type="text/javascript">' . NL;
			echo 'console.log("' . $this->input->get('status', TRUE) . '");' . NL;
			echo '</script>' . NL;
			$arrData = array(
				"status_bayar" => 'Lunas',
			);
			$this->db->update('transaksi', $arrData, 'id_transaksi=' . $id_transaction);
			redirect('transaksi');
		} elseif ($this->input->get('status') == 'success') {
			echo '<script type="text/javascript">' . NL;
			echo 'console.log("' . $this->input->get('status', TRUE) . '");' . NL;
			echo '</script>' . NL;
			$arrData = array(
				"status_bayar" => 'Lunas',
			);
			$this->db->update('transaksi', $arrData, 'id_transaksi=' . $id_transaction);
			redirect('transaksi');
		}  elseif ($this->input->get('status') == 'error') {
			echo '<script type="text/javascript">' . NL;
			echo 'console.log("' . $this->input->get('status', TRUE) . '");' . NL;
			echo '</script>' . NL;
			$arrData = array(
				"status_bayar" => 'Belum Lunas',
			);
			$this->db->update('transaksi', $arrData, 'id_transaksi=' . $id_transaction);
			redirect('transaksi');
		}

		$this->load->view('transaksi', $data);
	}



	public function payment($id)
	{
		$data = $this->db->query("SELECT * FROM transaksi WHERE id_transaksi=" . $id)->result()[0];
		$userData =  $this->db->query("SELECT * FROM users WHERE id_user=" . $this->session->userdata('id_user'))->result()[0];
		echo '<script type="text/javascript">' . NL;
		echo 'console.log("' . $this->input->get('id_transaction', TRUE) . 'asdasd");' . NL;
		echo '</script>' . NL;
		// Required

		$transaction_details = array(
			'order_id' => $data->id_transaksi,
			'gross_amount' => $data->total_harga, // no decimal allowed for creditcard
		);

		$customer_details = array(
			"nama_user" => $userData->nama_user,
			"username" => $userData->username,
		);

		// Fill SNAP API parameter
		$params = array(
			'transaction_details' => $transaction_details,
			'customer_details' => $customer_details,
		);


		try {
			// Get Snap Payment Page URL
			// $paymentUrl = Snap::createTransaction($params)->redirect_url;
			$snapToken = Midtrans\Snap::getSnapToken($params);
			// Redirect to Snap Payment Page
			// header('Location: ' . $paymentUrl);
			redirect('payment?snapToken=' . $snapToken . '&id_transaction=' . $data->id_transaksi);

			// echo '<script type="text/javascript">' . NL;
			// echo 'console.log("' . $userData->id_user . 'asdasd");' . NL;
			// echo '</script>' . NL;
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}

	public function tambah_transaksi_aksi()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$data['judul'] = 'Home';

			$data['tiket'] = $this->Tiket_model->getData('tiket')->result();

			$this->load->view('home', $data);
			// header("refresh: 3;");
		} else {
			$id_tiket = $this->input->post('id_tiket');
			$token = rand(10, 100000);
			$jenis_tiket = $this->input->post('jenis_tiket');
			$jumlah_tiket = $this->input->post('jumlah_tiket');
			$harga = $this->input->post('harga');
			$total_harga = $jumlah_tiket * $harga;
			$status_bayar = 'Belum Lunas';
			$id_user = $this->session->userdata('id_user');

			$data = array(
				'id_tiket' => $id_tiket,
				'token' => $token,
				'jenis_tiket' => $jenis_tiket,
				'jumlah_tiket' => $jumlah_tiket,
				'total_harga' => $total_harga,
				'status_bayar' => $status_bayar,
				'id_user' => $id_user
			);

			$this->Tiket_model->insertData($data, 'transaksi');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Transaksi berhasil. Silahkan melakukan pembayaran.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');

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
				$mail->addAddress($this->session->userdata('username'), $this->session->userdata('nama_user'));

				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = 'Selesaikan pembayaran Anda';
				$mail->Body    = '<h1>Tinggal sedikit lagi. Yuk, selesaikan pembayaranmu!</h1><br>
					Token: ' . $token . '<br>
					Jenis Tiket: ' . $jenis_tiket . '<br>
					Jumlah Tiket: ' . $jumlah_tiket . '<br>
					Total Harga: ' . $total_harga . '<br>
					Status Bayar: ' . $status_bayar . '<br>
					';

				$mail->send();
			} catch (Exception $e) {
				echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
			redirect('transaksi');
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('id_tiket', 'Jenis Tiket', 'required', ['required' => '%s tidak boleh kosong. Silahkan refresh halaman!']);
		$this->form_validation->set_rules('jumlah_tiket', 'jumlah_tiket', 'required', ['required' => '%s tidak boleh kosong. Silahkan refresh halaman!']);
	}
}
