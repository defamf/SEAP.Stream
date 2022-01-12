<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function index(){
		$data['judul'] = 'Registrasi';

		$this->_rules();

		if($this->form_validation->run() == FALSE){
			$this->load->view('templates_admin/header', $data);
			$this->load->view('register_form');
			$this->load->view('templates_admin/footer');
		} else{
			$nama_user = $this->input->post('nama_user');
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$hak_akses = 'User';

			$data = array(
				'nama_user' => $nama_user,
				'username' => $username,
				'password' => $password,
				'hak_akses' => $hak_akses
			);

			$this->Tiket_model->insertData($data,'users');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Berhasil Register, Silahkan Login!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('auth/login');
		}
	}

	public function _rules(){
		$this->form_validation->set_rules('nama_user', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
	}
}