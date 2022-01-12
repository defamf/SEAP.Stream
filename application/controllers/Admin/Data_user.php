<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_user extends CI_Controller {

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
		$data['judul'] = 'Data User';	
		$data['user'] = $this->db->query("SELECT * FROM users WHERE hak_akses='User'")->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/data_user', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambah_user(){
		$data['judul'] = 'Tambah Data User';

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_tambah_user', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambah_user_aksi(){
		$this->_rules();

		if($this->form_validation->run() == FALSE){
			$this->tambah_user();
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

			$this->Tiket_model->insertData($data, 'users');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data user berhasil ditambahkan.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_user');
		}
	}

	public function update_user($id){
		$data['judul'] = 'Update Data User';
		$where = ['id_user' => $id];

		$data['user'] = $this->Tiket_model->getWhere($where, 'users')->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_update_user',$data);
		$this->load->view('templates_admin/footer');
		
	}

	public function update_user_aksi($id){
		$this->_rules();

		if($this->form_validation->run() == FALSE){
			$this->update_user($id);
		} else{
			$id = $this->input->post('id_user');
			$nama_user = $this->input->post('nama_user');
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));

			$data = array(
				'nama_user' => $nama_user,
				'username' => $username,
				'password' => $password
			);

			$where = array(
				'id_user' => $id
			);

			$this->Tiket_model->updateData('users', $data, $where);
			$this->session->set_flashdata('pesan', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
				Data user berhasil diupdate.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_user');

		}
	}

	public function _rules(){
		$this->form_validation->set_rules('nama_user', 'Nama Admin', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
	}

	public function delete_user($id){
		$where = array(
			'id_user' => $id
		);

		$this->Tiket_model->deleteData($where, 'users');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Data admin berhasil dihapus.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/data_user');

	}
}