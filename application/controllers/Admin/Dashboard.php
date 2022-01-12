<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if (empty($this->session->userdata('hak_akses'))){
			redirect('auth/login');
		} elseif ($this->session->userdata('hak_akses') == 'User') {
			redirect('block');
		}
	}

	public function index()
	{
		$data['judul'] = 'Dashboard';

		$users = $this->db->query("SELECT * FROM users");
		$admin = $this->db->query("SELECT * FROM users WHERE hak_akses='Admin' ");
		$transaksi = $this->db->query("SELECT * FROM transaksi WHERE status_bayar='Lunas' ");
		$transaksi2 = $this->db->query("SELECT * FROM transaksi WHERE status_bayar='Belum Lunas' ");
		$data['users'] = $users->num_rows();
		$data['admin'] = $admin->num_rows();
		$data['transaksi'] = $transaksi->num_rows();
		$data['transaksi2'] = $transaksi2->num_rows();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('templates_admin/footer');
	}
}
