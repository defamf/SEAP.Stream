<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiket extends CI_Controller {

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
		$data['judul'] = 'Data Tiket';	
		$data['tiket'] = $this->Tiket_model->getData('tiket')->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/data_tiket', $data);
		$this->load->view('templates_admin/footer');
	}

	public function tambah_tiket(){
		$data['judul'] = 'Tambah Data Tiket';
		$data['tiket'] = $this->Tiket_model->getData('tiket')->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_tambah_tiket', $data);
		$this->load->view('templates_admin/footer');
	}
	public function tambah_tiket_aksi(){
		$this->form_validation->set_rules('nama_tiket', 'Nama Tiket', 'required');
		$this->form_validation->set_rules('harga', 'Harga', 'required');

		if($this->form_validation->run() == FALSE){
			$this->tambah_tiket();
		} else{
			$nama_tiket = $this->input->post('nama_tiket');
			$harga = $this->input->post('harga');
			$gambar = $_FILES['gambar']['name'];

			if($gambar=''){

			} else{
				$config['upload_path'] = './img/';
				$config['allowed_types'] = 'jpg|jpeg|png|tiff';

				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('gambar')){
					echo "Gambar gagal diupload";
				} else{
					$gambar = $this->upload->data('file_name');
				}
			}

			$data = array(
				'nama_tiket' => $nama_tiket,
				'harga' => $harga,
				'gambar' => $gambar
			);

			$this->Tiket_model->insertData($data, 'tiket');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Data tiket berhasil ditambahkan.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/tiket');
		}
	}

	public function update_tiket($id){
		$data['judul'] = 'Update Data tiket';

		$where = ['id_tiket' => $id];

		$data['tiket'] = $this->Tiket_model->getWhere($where, 'tiket')->result();

		$this->load->view('templates_admin/header', $data);
		$this->load->view('templates_admin/sidebar');
		$this->load->view('admin/form_update_tiket', $data);
		$this->load->view('templates_admin/footer');
		
	}

	public function update_tiket_aksi($id){
		$this->form_validation->set_rules('nama_tiket', 'Nama Tiket', 'required');
		$this->form_validation->set_rules('harga', 'Harga', 'required');

		if($this->form_validation->run() == FALSE){
			$this->update_tiket($id);
		} else{
			$id_tiket = $this->input->post('id_tiket');
			$nama_tiket = $this->input->post('nama_tiket');
			$harga = $this->input->post('harga');
			$gambar = $_FILES['gambar']['name'];


			if($gambar){
				$config['upload_path'] = './img';
				$config['allowed_types'] = 'jpg|jpeg|png|tiff';

				$this->load->library('upload', $config);

				if($this->upload->do_upload('gambar')){
					$gambar = $this->upload->data('file_name');
					$this->db->set('gambar', $gambar);
				} else{
					echo $this->upload->display->errors();
				}
			}

			$data = array(
				'nama_tiket' => $nama_tiket,
				'harga' => $harga
			);

			$where = array(
				'id_tiket' => $id_tiket
			);

			$this->Tiket_model->updateData('tiket', $data, $where);
			$this->session->set_flashdata('pesan', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
				Data tiket berhasil diupdate.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/tiket');

		}
	}

	// public function _rules(){
	// 	$this->form_validation->set_rules('judul', 'Judul', 'required');
	// 	$this->form_validation->set_rules('gambar', 'Gambar', 'required');
	// }

	public function delete_tiket($id){
		$where = array(
			'id_tiket' => $id
		);

		$this->Tiket_model->deleteData($where, 'tiket');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Data tiket berhasil dihapus.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
		redirect('admin/tiket');

	}
}