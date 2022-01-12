<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

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
		$data['judul'] = 'About';	
		$data['about'] = $this->db->query("SELECT * FROM about")->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/about', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambah_about(){
		$data['judul'] = 'Tambah About';

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_tambah_about', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambah_about_aksi(){
		$this->_rules();

		if($this->form_validation->run() == FALSE){
			$this->tambah_about();
		} else{
			$dimana = $this->input->post('dimana');
			$kapan = $this->input->post('kapan');
			$keterangan = $this->input->post('keterangan');

			$data = array(
				'dimana' => $dimana,
				'kapan' => $kapan,
				'keterangan' => $keterangan
			);

			$this->Tiket_model->insertData($data, 'about');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				About berhasil ditambahkan.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/about');
		}
	}

	public function update_about($id){
		$data['judul'] = 'Update About';
		$where = ['id_about' => $id];

		$data['about'] = $this->Tiket_model->getWhere($where, 'about')->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_update_about', $data);
		$this->load->view('templates_admin/footer');
		
	}

	public function update_about_aksi($id){
		$this->_rules();

		if($this->form_validation->run() == FALSE){
			$this->update_about($id);
		} else{
			$id = $this->input->post('id_about');
			$dimana = $this->input->post('dimana');
			$kapan = $this->input->post('kapan');
			$keterangan = $this->input->post('keterangan');

			$data = array(
				'dimana' => $dimana,
				'kapan' => $kapan,
				'keterangan' => $keterangan
			);

			$where = array(
				'id_about' => $id
			);

			$this->Tiket_model->updateData('about', $data, $where);
			$this->session->set_flashdata('pesan', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
				About berhasil diupdate.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/about');

		}
	}

	public function _rules(){
		$this->form_validation->set_rules('dimana', 'Dimana', 'required');
		$this->form_validation->set_rules('kapan', 'Kapan', 'required');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
	}

	public function delete_about($id){
		$where = array(
			'id_about' => $id
		);

		$this->Tiket_model->deleteData($where, 'about');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			About berhasil dihapus.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/data_admin');

	}
}