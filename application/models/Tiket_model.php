<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiket_model extends CI_Model {

	public function getData($table)
	{
		return $this->db->get($table);
	}

	public function getWhere($where, $table){
		return $this->db->get_where($table, $where);
	}

	public function insertData($data, $table){
		$this->db->insert($table, $data);
	}

	public function updateData($table, $data, $where){
		$this->db->update($table, $data, $where);
	}

	public function deleteData($where, $table){
		$this->db->where($where);
		$this->db->delete($table);
	}

	public function cekLogin(){
		$username = set_value('username');
		$password = set_value('password');

			$hasil = $this->db
						->where('username', $username)
						->where('password', md5($password))
						->limit(1) //datanya yang diambil 1
						->get('users');

		if($hasil->num_rows() > 0){
			return $hasil->row();
		} else{
			return FALSE;
		}
	}
}
