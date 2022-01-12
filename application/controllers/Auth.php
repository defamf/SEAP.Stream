<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login(){

		if ($this->session->userdata('hak_akses') == 'Admin'){
			redirect('admin/dashboard');
		} elseif ($this->session->userdata('hak_akses') == 'User'){
			redirect('home');
			
		}

		$data['judul'] = 'Login';
		$this->_rules();

		if ($this->form_validation->run() == FALSE){
			$this->load->view('templates_admin/header', $data);
			$this->load->view('form_login');
			$this->load->view('templates_admin/footer');
		} else{
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));

			$cek = $this->Tiket_model->cekLogin($username, $password);

			if ($cek == FALSE){
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					Username atau password salah!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
				redirect('auth/login');
			} else{
				$this->session->set_userdata('nama_user', $cek->nama_user);
				$this->session->set_userdata('username', $cek->username);
				$this->session->set_userdata('id_user', $cek->id_user);
				$this->session->set_userdata('hak_akses', $cek->hak_akses);

				if ($cek->hak_akses == 'Admin'){
					redirect('admin/dashboard');
				} elseif ($cek->hak_akses == 'User'){
					redirect('home');
					
				}
				
			}
		}
	}

	public function _rules(){
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('home');
		
	}
}