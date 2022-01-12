<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

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
		$data['judul'] = 'Contact';	
		$data['contact'] = $this->db->query("SELECT * FROM contact")->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/contact', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambah_contact(){
		$data['judul'] = 'Tambah Contact';

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_tambah_contact', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambah_contact_aksi(){
		$this->_rules();

		if($this->form_validation->run() == FALSE){
			$this->tambah_contact();
		} else{
			$alamat = $this->input->post('alamat');
			$no_telepon = $this->input->post('no_telepon');
			$email = $this->input->post('email');

			$data = array(
				'alamat' => $alamat,
				'no_telepon' => $no_telepon,
				'email' => $email
			);

			$this->Tiket_model->insertData($data, 'contact');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Contact berhasil ditambahkan.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/contact');
		}
	}

	public function update_contact($id){
		$data['judul'] = 'Update Contact';
		$where = ['id_contact' => $id];

		$data['contact'] = $this->Tiket_model->getWhere($where, 'contact')->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_update_contact', $data);
		$this->load->view('templates_admin/footer');
		
	}

	public function update_contact_aksi($id){
		$this->_rules();

		if($this->form_validation->run() == FALSE){
			$this->update_contact($id);
		} else{
			$id = $this->input->post('id_contact');
			$alamat = $this->input->post('alamat');
			$no_telepon = $this->input->post('no_telepon');
			$email = $this->input->post('email');

			$data = array(
				'alamat' => $alamat,
				'no_telepon' => $no_telepon,
				'email' => $email
			);

			$where = array(
				'id_contact' => $id
			);

			$this->Tiket_model->updateData('contact', $data, $where);
			$this->session->set_flashdata('pesan', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
				Contact berhasil diupdate.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/contact');

		}
	}

	public function _rules(){
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('no_telepon', 'No. Telepon', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
	}

	public function delete_about($id){
		$where = array(
			'id_contact' => $id
		);

		$this->Tiket_model->deleteData($where, 'contact');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Contact berhasil dihapus.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/contact');

	}
}