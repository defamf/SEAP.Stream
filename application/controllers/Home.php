<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	// public function __construct(){
	// 	parent::__construct();

	// 	if (empty($this->session->userdata('hak_akses'))){
	// 		redirect('home');
	// 	} elseif ($this->session->userdata('hak_akses') == 'Admin') {
	// 		redirect('block');
	// 	}
	// }

	public function index()
	{
		$data['judul'] = 'Home';

		$data['tiket'] = $this->Tiket_model->getData('tiket')->result();

		$data['contact'] = $this->Tiket_model->getData('contact')->result();

		$data['about'] = $this->Tiket_model->getData('about')->result();

		$this->load->view('home', $data);
	}
}
