<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Print_tiket extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

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

	public function index($id)
	{
		$data['judul'] = 'Print Tiket';

		$data['transaksi'] = $this->db->query("SELECT * FROM transaksi WHERE id_transaksi=$id AND id_user=" . $this->session->userdata('id_user'))->result();

		$this->load->view('print', $data);
	}
}

/* End of file Print.php */
/* Location: ./application/controllers/Print.php */